<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    public $incrementing = false; // Disable auto-increment for id_barang
    protected $fillable = ['id_barang', 'nama_barang', 'stok', 'harga_jual'];

    public function transaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_barang');
    }

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class, 'nama_barang', 'nama_barang');
    }
}