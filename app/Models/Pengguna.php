<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $fillable = [
        'id_pengguna',
        'username',
        'nama_pengguna',
        'no_telepon',
        'password',
    ];

    // Jika ingin memastikan ID ditampilkan dalam format yang benar
    public function getIdPenggunaAttribute($value)
    {
        return $value; // Mengembalikan nilai ID tanpa modifikasi
    }

    // Menambahkan kolom yang digunakan untuk login
    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}


