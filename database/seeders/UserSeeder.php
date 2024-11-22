<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna; // Menggunakan model Pengguna

class UserSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan user default untuk admin
        Pengguna::create([ // Menggunakan model Pengguna
            'id_pengguna' => 'admin001', // Menetapkan ID unik jika id_pengguna bukan auto-increment
            'nama_pengguna' => 'Administrator', // Nama pengguna
            'no_telepon' => '08123456789', // Nomor telepon (bisa dikosongkan atau disesuaikan)
            'username' => 'Admin', // Username
            'password' => bcrypt('admin123'), // Password yang sudah dienkripsi
        ]);
    }
}
