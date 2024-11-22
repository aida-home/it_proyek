<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        // Menghapus semua data pengguna sebelumnya (opsional)
        Pengguna::truncate(); 

        // Menambahkan data pengguna baru
        Pengguna::create([
            'id_pengguna' => 'admin001', // Ganti dengan ID yang unik
            'username' => 'sayaadmin',
            'nama_pengguna' => 'Administrator',
            'no_telepon' => '08123456789',
            'password' => Hash::make('12345678'),
        ]);
    }
}


