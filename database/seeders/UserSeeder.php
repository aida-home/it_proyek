<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        Pengguna::create([
            'id_pengguna' => 'admin001',  // ID Pengguna (pastikan sesuai format)
            'nama_pengguna' => 'Administrator',
            'no_telepon' => '08123456789',
            'username' => 'Admin',  // Username yang digunakan untuk login
            'password' => Hash::make('admin123'),  // Password di-hash dengan bcrypt
        ]);
    }
}


