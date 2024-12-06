<?php
namespace App\Models;

use App\Http\Controllers\BarangController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang'; // Nama tabel di database

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

    protected static function boot()
    {
        parent::boot();
    
        static::updated(function ($barang) {
            // Pastikan menggunakan nama kolom yang benar: stok_barang
            if ($barang->stok_barang < 10) {
                (new BarangController())->kirimNotifikasiWhatsApp($barang);
            }
        });
    }
} 

