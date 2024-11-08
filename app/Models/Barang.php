<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs'; // Nama tabel di database

    protected $primaryKey = 'id_barang'; // Menentukan primary key

    public $incrementing = false; // Karena id_barang tidak auto-increment

    protected $keyType = 'string'; // Jenis dari primary key adalah string
    
    // Kolom-kolom yang dapat diisi massal
    protected $fillable = [
        'id_barang',
        'nama_barang',
        'kategori',
        'stok_barang',
        'harga_jual'
    ];
}
