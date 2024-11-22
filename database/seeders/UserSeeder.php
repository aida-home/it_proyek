<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Cek apakah admin sudah ada
        if (!Pengguna::where('username', 'Admin')->exists()) {
            Pengguna::create([
                'username' => 'Admin',
                'no_telepon' => '08123456789',
                'password' => Hash::make('admin123'),
            ]);
        }
    }
}

