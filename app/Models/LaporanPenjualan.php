<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPenjualan extends Model
{
    protected $table = 'laporan_penjualan';
    protected $primaryKey = 'id_laporan_penjualan';
    public $incrementing = false; // Karena kita menggunakan ID manual
    protected $fillable = ['id_laporan_penjualan', 'tanggal_mulai', 'tanggal_selesai', 'total_penjualan'];

    // Fungsi untuk generate ID otomatis
    public static function generateIdLaporan()
    {
        // Ambil laporan penjualan terakhir
        $lastReport = self::orderBy('id_laporan_penjualan', 'desc')->first();

        // Jika belum ada laporan, mulai dari LP0001
        if (!$lastReport) {
            return 'LP0001';
        }

        // Ambil angka dari ID terakhir dan increment
        $lastIdNumber = intval(substr($lastReport->id_laporan_penjualan, 2)); // Ambil bagian numerik dari ID
        $newIdNumber = str_pad($lastIdNumber + 1, 4, '0', STR_PAD_LEFT); // Tambahkan 1 dan format menjadi 4 digit

        return 'LP' . $newIdNumber;
    }
}

