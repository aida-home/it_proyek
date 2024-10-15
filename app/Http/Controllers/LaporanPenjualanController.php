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

        // Ambil data detail transaksi dengan join ke tabel barang
        $query = DetailTransaksi::join('barang', 'detail_transaksi.id_barang', '=', 'barang.id_barang')
            ->select('detail_transaksi.created_at', 'barang.nama_barang', 'detail_transaksi.jumlah_beli', 'barang.harga_jual',
                DB::raw('detail_transaksi.jumlah_beli * barang.harga_jual as total_penjualan'));

        if ($startDate && $endDate) {
            $query->whereBetween('detail_transaksi.created_at', [$startDate, $endDate]);
        }

        $laporanPenjualan = $query->get();

        // Hitung total penjualan
        $totalPenjualan = $laporanPenjualan->sum('total_penjualan');

        return view('laporan-penjualan', compact('laporanPenjualan', 'totalPenjualan', 'startDate', 'endDate'));
    }
}
