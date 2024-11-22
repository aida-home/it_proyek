<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tentukan kolom yang digunakan untuk otentikasi
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $fillable = [
        'id_pengguna',
        'username',
        'nama_pengguna',
        'no_telepon',
        'password',
    ];

    // Menambahkan kolom yang digunakan untuk login
    public function getAuthIdentifierName()
    {
        return 'username'; // Menggunakan kolom username sebagai pengganti email
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}


