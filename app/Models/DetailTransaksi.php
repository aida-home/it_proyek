<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id_detail_transaksi';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id_detail_transaksi', 'id_transaksi', 'id_barang', 'nama_barang', 'harga_jual', 'jumlah_beli', 'subtotal'];

    // Relasi ke Transaksi (Many-to-One)
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang')->withDefault();
    }
}

