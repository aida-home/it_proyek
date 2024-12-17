<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Carbon;

class SAWController extends Controller
{

    public function hitungBarangTerbaik(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Jika tanggal kosong, set default untuk 1 bulan terakhir
        if (!$startDate || !$endDate) {
            $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
            $endDate = $request->input('end_date', now()->endOfMonth()->format('Y-m-d'));
            
        }
    
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
            ->groupBy('barang.id_barang', 'barang.nama_barang', 'barang.harga_jual', 'barang_masuk.harga_beli')
            ->whereBetween('transaksi.tanggal_transaksi', [$startDate, $endDate]);
    
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
            'tanggal_awal' => date('d/m/Y', strtotime($startDate)),
            'tanggal_akhir' => date('d/m/Y', strtotime($endDate)),
        ]);
    }

    public function rekomendasiBarang(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    
    // Jika tanggal kosong, set default untuk 1 bulan terakhir
    if (!$startDate || !$endDate) {
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->endOfMonth()->format('Y-m-d'));
    }

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
        ->groupBy('barang.id_barang', 'barang.nama_barang', 'barang.harga_jual', 'barang_masuk.harga_beli')
        ->whereBetween('transaksi.tanggal_transaksi', [$startDate, $endDate]);

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

    // Urutkan berdasarkan nilai preferensi dan tambahkan ranking
    $barangTerbaik = $barangPreferensi->sortByDesc('nilai_preferensi')->values();
    
    // Tambahkan ranking
    $barangTerbaik = $barangTerbaik->map(function ($item, $index) {
        $item['ranking'] = $index + 1;  // Penambahan ranking
        return $item;
    });

    return view('barang-rekomendasi', [
        'barangTerbaik' => $barangTerbaik,
        'tanggal_awal' => date('d/m/Y', strtotime($startDate)),
        'tanggal_akhir' => date('d/m/Y', strtotime($endDate)),
    ]);
}


}    