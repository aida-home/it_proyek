<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier; // Import Supplier model

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuks';
    protected $primaryKey = 'id_barangmasuk';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_barangmasuk',
        'nama_barang',
        'tgl_masuk',
        'jumlah_masuk',
        'harga_beli',
        'supplier'
    ];

    // Definisikan relasi dengan Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier', 'id_supplier');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
}