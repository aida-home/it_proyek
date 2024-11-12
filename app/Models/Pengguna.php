<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pengguna';
    
    // Jika 'id_pengguna' adalah string, tambahkan juga
    protected $keyType = 'string';
    public $incrementing = false; // Jika primary key tidak auto-increment
    protected $table = 'pengguna'; // pastikan ini sesuai dengan nama tabel di database
    protected $fillable = [
        'id_pengguna',
        'nama_pengguna',
        'no_telepon',
        'username',
        'password',
    ];
}
