<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Ambil data detail transaksi dengan join ke tabel barang dan transaksi
        $query = DetailTransaksi::join('barang', 'detail_transaksi.id_barang', '=', 'barang.id_barang')
            ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi') // Join dengan tabel transaksi
            ->select('transaksi.tanggal_transaksi', 'barang.nama_barang', 'detail_transaksi.jumlah_beli', 'barang.harga_jual',
                DB::raw('detail_transaksi.jumlah_beli * barang.harga_jual as total_pendapatan'));

        if ($startDate && $endDate) {
            $query->whereBetween('transaksi.tanggal_transaksi', [$startDate, $endDate]);
        }

        $laporanPenjualan = $query->get();

        // Hitung total penjualan
        $totalPendapatan = $laporanPenjualan->sum('total_pendapatan');

        return view('laporan-penjualan', compact('laporanPenjualan', 'totalPendapatan', 'startDate', 'endDate'));
    }
}
