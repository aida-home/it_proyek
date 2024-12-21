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
            $startDate = now()->startOfMonth()->format('Y-m-d');
            $endDate = now()->endOfMonth()->format('Y-m-d');
        }

        // Ambil data langsung dari detail_transaksi tanpa join tabel barang
        $query = DetailTransaksi::join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
        ->join('barang_masuk', 'detail_transaksi.nama_barang', '=', 'barang_masuk.nama_barang') // Join dengan barang_masuk
        ->select(
            'transaksi.tanggal_transaksi',
            'detail_transaksi.nama_barang',
            'detail_transaksi.jumlah_beli',
            'detail_transaksi.harga_jual',
            'barang_masuk.harga_beli', // Ambil harga_beli dari barang_masuk
            DB::raw('detail_transaksi.jumlah_beli * detail_transaksi.harga_jual as total_pendapatan'),
            DB::raw('(detail_transaksi.harga_jual - barang_masuk.harga_beli) * detail_transaksi.jumlah_beli as profit') // Hitung profit
        );
    
    if ($startDate && $endDate) {
        $query->whereBetween('transaksi.tanggal_transaksi', [$startDate, $endDate]);
    }
    
    $laporanPenjualan = $query->get();
    
    // Hitung total penjualan dan profit
    $totalPendapatan = $laporanPenjualan->sum('total_pendapatan');
    $totalProfit = $laporanPenjualan->sum('profit');
    
    return view('laporan-penjualan', compact('laporanPenjualan', 'totalPendapatan', 'totalProfit', 'startDate', 'endDate'));
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
