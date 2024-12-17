<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPenjualanExport;


class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

                // Jika tanggal kosong, set default untuk 1 bulan terakhir
        if (!$startDate || !$endDate) {
            $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
            $endDate = $request->input('end_date', now()->endOfMonth()->format('Y-m-d'));
            
        }

        // Ambil data langsung dari detail_transaksi tanpa join tabel barang
        $query = DetailTransaksi::join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
            ->select(
                'transaksi.tanggal_transaksi',
                'detail_transaksi.nama_barang', // Menggunakan nama_barang dari detail_transaksi
                'detail_transaksi.jumlah_beli',
                'detail_transaksi.harga_jual', // Menggunakan harga_jual dari detail_transaksi
                DB::raw('detail_transaksi.jumlah_beli * detail_transaksi.harga_jual as total_pendapatan')
            );

        if ($startDate && $endDate) {
            $query->whereBetween('transaksi.tanggal_transaksi', [$startDate, $endDate]);
        }

        $laporanPenjualan = $query->get();

        // Hitung total penjualan
        $totalPendapatan = $laporanPenjualan->sum('total_pendapatan');

        return view('laporan-penjualan', compact('laporanPenjualan', 'totalPendapatan', 'startDate', 'endDate'));
    }

    public function export(Request $request)
    {
        // Default tanggal awal dan akhir bulan jika tidak ada input
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->endOfMonth()->format('Y-m-d'));

        // Nama file unduhan
        $fileName = 'Laporan_Penjualan_' . $startDate . '_to_' . $endDate . '.xlsx';

        // Download file Excel
        return Excel::download(new LaporanPenjualanExport($startDate, $endDate), $fileName);
    }
}
