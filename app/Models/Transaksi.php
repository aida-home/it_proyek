<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id_transaksi', 'tanggal_transaksi', 'total_pembayaran'];

    // Relasi ke DetailTransaksi (One-to-Many)
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
