<?php

namespace App\Exports;

use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanPenjualanExport implements FromCollection, WithHeadings, WithTitle, WithStyles, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $data = DetailTransaksi::join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
            ->select(
                'transaksi.tanggal_transaksi',
                'detail_transaksi.nama_barang',
                'detail_transaksi.jumlah_beli',
                'detail_transaksi.harga_jual',
                DB::raw('detail_transaksi.jumlah_beli * detail_transaksi.harga_jual as total_pendapatan')
            )
            ->whereBetween('transaksi.tanggal_transaksi', [$this->startDate, $this->endDate])
            ->get();

            // Pastikan tanggal dalam format Carbon
            $data->transform(function ($item) {
                $item->tanggal_transaksi = \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d-m-Y');
                return $item;
            });

        // Menambahkan total pendapatan ke koleksi data
        $totalPendapatan = $data->sum(function ($item) {
            return $item->total_pendapatan;
        });

        // Menambahkan baris dengan total pendapatan
        $data->push([
            'tanggal_transaksi' => '',
            'nama_barang' => 'Total Pendapatan',
            'jumlah_beli' => '',
            'harga_jual' => '',
            'total_pendapatan' => $totalPendapatan,
        ]);

        return $data;
    }

    public function headings(): array
    {
        // Format startDate dan endDate menjadi tanggal-bulan-tahun (DD-MM-YYYY)
        $startDateFormatted = \Carbon\Carbon::parse($this->startDate)->format('d-m-Y');
        $endDateFormatted = \Carbon\Carbon::parse($this->endDate)->format('d-m-Y');
    
        return [
            ['LAPORAN PENJUALAN RPS COLLECTION'],
            ['Tanggal: ' . $startDateFormatted . ' sampai ' . $endDateFormatted],
            [''],
            ['Tanggal Transaksi', 'Nama Produk', 'Jumlah Terjual', 'Harga Satuan', 'Total Pendapatan'],
        ];
    }
    

    public function title(): string
    {
        return 'Laporan Penjualan';
    }

    public function styles(Worksheet $sheet)
    {
        // Menyusun tampilan dan format tabel
        $sheet->mergeCells('A1:E1'); // Merge judul
        $sheet->mergeCells('A2:E2'); // Merge tanggal
        $sheet->getStyle('A1:E2')->getFont()->setBold(true)->setSize(14); // Format font judul dan tanggal
        $sheet->getStyle('A4:E4')->getFont()->setBold(true); // Format font header tabel
        $sheet->getStyle('A4:E4')->getAlignment()->setHorizontal('center'); // Center header tabel
        $sheet->getStyle('A4:E4')->getBorders()->getAllBorders()->setBorderStyle('thin'); // Tambah border pada header tabel
        $sheet->getStyle('A4:E4')->getFill()->setFillType('solid')->getStartColor()->setARGB('FFFF00'); // Set warna header tabel
        
        // Atur lebar kolom secara otomatis
        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(20);
        
        // Border seluruh tabel data
        $sheet->getStyle('A4:E' . (4 + $this->collection()->count()))->getBorders()->getAllBorders()->setBorderStyle('thin');
    
        // Format tanggal di kolom A (Tanggal Transaksi)
        $sheet->getStyle('A5:A' . (4 + $this->collection()->count()))
            ->getNumberFormat()
            ->setFormatCode('DD-MM-YYYY'); // Format tanggal: DD-MM-YYYY
    }
    
    
}
