<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\LaporanPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Pastikan ini ada

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Ambil data detail transaksi dengan join ke tabel barang
        $query = DetailTransaksi::join('barang', 'detail_transaksi.id_barang', '=', 'barang.id_barang')
            ->select('barang.nama_barang', 'detail_transaksi.jumlah_beli', 'barang.harga_jual',
                DB::raw('detail_transaksi.jumlah_beli * barang.harga_jual as total_penjualan')); // Menggunakan DB::raw
    
        if ($startDate && $endDate) {
            $query->whereBetween('detail_transaksi.created_at', [$startDate, $endDate]);
        }

        $laporanPenjualan = $query->get();

        // Hitung total penjualan
        $totalPenjualan = $laporanPenjualan->sum('total_penjualan');

        // Jika ingin menyimpan laporan penjualan ke tabel
        $laporan = new LaporanPenjualan();
        $laporan->id_laporan_penjualan = LaporanPenjualan::generateIdLaporan();
        $laporan->tanggal_mulai = $startDate;
        $laporan->tanggal_selesai = $endDate;
        $laporan->total_penjualan = $totalPenjualan;
        $laporan->save();

        return view('laporan_penjualan.index', compact('laporanPenjualan', 'totalPenjualan', 'startDate', 'endDate'));
    }
}

