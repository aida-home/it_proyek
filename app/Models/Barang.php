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

    // Relasi dengan model Kategori (Many to One)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori', 'id_kategori');
    }
    

    protected static function boot()
    {
        parent::boot();
    
        // Ketika data Barang diupdate, cek stok dan kirim notifikasi jika diperlukan
        static::updated(function ($barang) {
            if ($barang->stok_barang < 10) {
                // Menggunakan controller untuk kirim notifikasi jika stok kurang dari 10
                (new BarangController())->kirimNotifikasiWhatsApp($barang);
            }
        });
    }
}

