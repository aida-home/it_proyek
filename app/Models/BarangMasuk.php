<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier; // Import Supplier model

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';
    protected $primaryKey = 'id_barangmasuk';
    public $incrementing = false; // Set to false because the id is string
    protected $keyType = 'string'; // The type of the primary key is string

    // Tambahkan id_barangmasuk ke fillable fields
    protected $fillable = [
        'id_barangmasuk',  // <-- Pastikan ini ada
        'nama_barang',
        'supplier',
        'kategori',
        'tgl_masuk',
        'jumlah_masuk',
        'harga_beli',
    ];


    // Definisikan relasi dengan Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier', 'id_supplier');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori', 'id_kategori');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
}
