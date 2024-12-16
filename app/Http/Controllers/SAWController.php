<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SAWController extends Controller
{
    public function hitungBarangTerbaik(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Ambil data barang dengan join dan filter tanggal pada transaksi
        $barangDataQuery = DB::table('barang')
            ->join('detail_transaksi', 'barang.id_barang', '=', 'detail_transaksi.id_barang')
            ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi') // Join ke tabel transaksi
            ->join('barang_masuk', 'barang.nama_barang', '=', 'barang_masuk.nama_barang')
            ->select(
                'barang.id_barang',
                'barang.nama_barang',
                DB::raw('SUM(detail_transaksi.jumlah_beli) as jumlah_terjual'),
                'barang.harga_jual',
                DB::raw('(barang.harga_jual - barang_masuk.harga_beli) as profit')
            )
            ->groupBy('barang.id_barang', 'barang.nama_barang', 'barang.harga_jual', 'barang_masuk.harga_beli');
    
        if ($startDate && $endDate) {
            $barangDataQuery->whereBetween('transaksi.tanggal_transaksi', [$startDate, $endDate]);
        }
    
        $barangData = $barangDataQuery->get();
    
        // Langkah normalisasi dan perhitungan preferensi (sama seperti sebelumnya)
        $maxJumlahTerjual = $barangData->max('jumlah_terjual');
        $maxProfit = $barangData->max('profit');
        $minHargaJual = $barangData->min('harga_jual');
    
        $barangNormalisasi = $barangData->map(function ($item) use ($maxJumlahTerjual, $maxProfit, $minHargaJual) {
            return [
                'id_barang' => $item->id_barang,
                'nama_barang' => $item->nama_barang,
                'jumlah_terjual' => $item->jumlah_terjual / $maxJumlahTerjual,
                'harga_jual' => $minHargaJual / $item->harga_jual,
                'profit' => $item->profit / $maxProfit,
            ];
        });
    
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
    
        $barangTerbaik = $barangPreferensi->sortByDesc('nilai_preferensi');
    
        return view('barang-terbaik', [
            'barangData' => $barangData,
            'barangNormalisasi' => $barangNormalisasi,
            'barangTerbaik' => $barangTerbaik,
            'bobot' => $bobot,
            'tanggal_awal' => $startDate ? date('d/m/Y', strtotime($startDate)) : null,
            'tanggal_akhir' => $endDate ? date('d/m/Y', strtotime($endDate)) : null,
        ]);
    }
}    