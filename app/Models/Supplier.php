<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_supplier';
    public $incrementing = false; // Custom primary key (string)

    protected $fillable = [
        'id_supplier',
        'nama_supplier',
        'no_telp',  // Ganti 'no_telepon' menjadi 'no_telp'
        'alamat',
    ];
}
