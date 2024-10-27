<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;

    protected $table = 'databarangs'; // Nama tabel di database

    protected $primaryKey = 'id_databarang'; // Menentukan primary key

    public $incrementing = false; // Karena id_databarang tidak auto-increment

    protected $keyType = 'string'; // Jenis dari primary key adalah string
    
    // Kolom-kolom yang dapat diisi massal
    protected $fillable = [
        'id_databarang',
        'nama_barang',
        'kategori',
        'stok_barang',
        'harga_jual'
    ];
}
