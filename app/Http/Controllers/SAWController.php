<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SAWController extends Controller
{
    public function exportDataSAW()
    {
        $data = DB::table('barang')
            ->join('detail_transaksi', 'barang.id_barang', '=', 'detail_transaksi.id_barang')
            ->join('barang_masuk', 'barang.nama_barang', '=', 'barang_masuk.nama_barang')
            ->select(
                'barang.id_barang',
                'barang.nama_barang',
                DB::raw('SUM(detail_transaksi.jumlah_beli) as jumlah_terjual'),
                'barang.harga_jual',
                'barang_masuk.harga_beli',
                DB::raw('(barang.harga_jual - barang_masuk.harga_beli) as profit')
            )
            ->groupBy('barang.id_barang', 'barang.nama_barang', 'barang.harga_jual', 'barang_masuk.harga_beli')
            ->get();
    
        $filePath = storage_path('app/public/data_saw.csv');
        $handle = fopen($filePath, 'w');
        fputcsv($handle, ['id_barang', 'nama_barang', 'jumlah_terjual', 'harga_jual', 'harga_beli', 'profit']);
    
        foreach ($data as $row) {
            fputcsv($handle, (array) $row);
        }
    
        fclose($handle);
    
        return response()->json(['message' => 'Data berhasil diekspor ke CSV']);
    }
    
}
