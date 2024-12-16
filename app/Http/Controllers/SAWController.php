<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SAWController extends Controller
{
    public function hitungBarangTerbaik()
    {
        // 1. Ambil data barang dengan join
        $barangData = DB::table('barang')
            ->join('detail_transaksi', 'barang.id_barang', '=', 'detail_transaksi.id_barang')
            ->join('barang_masuk', 'barang.nama_barang', '=', 'barang_masuk.nama_barang')
            ->select(
                'barang.id_barang',
                'barang.nama_barang',
                DB::raw('SUM(detail_transaksi.jumlah_beli) as jumlah_terjual'),
                'barang.harga_jual',
                DB::raw('(barang.harga_jual - barang_masuk.harga_beli) as profit')
            )
            ->groupBy('barang.id_barang', 'barang.nama_barang', 'barang.harga_jual', 'barang_masuk.harga_beli')
            ->get();

        // 2. Normalisasi data
        $maxJumlahTerjual = $barangData->max('jumlah_terjual');
        $maxProfit = $barangData->max('profit');
        $minHargaJual = $barangData->min('harga_jual');

        // Normalisasi: Jumlah terjual (benefit), Harga jual (cost), Profit (benefit)
        $barangNormalisasi = $barangData->map(function ($item) use ($maxJumlahTerjual, $maxProfit, $minHargaJual) {
            return [
                'id_barang' => $item->id_barang,
                'nama_barang' => $item->nama_barang,
                'jumlah_terjual' => $item->jumlah_terjual / $maxJumlahTerjual, // Benefit
                'harga_jual' => $minHargaJual / $item->harga_jual, // Cost
                'profit' => $item->profit / $maxProfit, // Benefit
            ];
        });

        // 3. Hitung nilai preferensi
        $bobot = [
            'jumlah_terjual' => 0.2605,
            'harga_jual' => 0.1063,
            'profit' => 0.6333,
        ];

        $barangPreferensi = $barangNormalisasi->map(function ($item) use ($bobot) {
            return [
                'id_barang' => $item['id_barang'],
                'nama_barang' => $item['nama_barang'],
                'nilai_preferensi' => 
                    ($item['jumlah_terjual'] * $bobot['jumlah_terjual']) +
                    ($item['harga_jual'] * $bobot['harga_jual']) +
                    ($item['profit'] * $bobot['profit']),
            ];
        });

        // 4. Urutkan berdasarkan nilai preferensi
        $barangTerbaik = $barangPreferensi->sortByDesc('nilai_preferensi');

        // 5. Kirim data ke view
        return view('barang-terbaik', ['barangTerbaik' => $barangTerbaik]);
    }
}
