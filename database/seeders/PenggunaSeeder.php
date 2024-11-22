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

        // Mengambil pengguna terakhir
        $lastPengguna = Pengguna::orderBy('id_pengguna', 'desc')->first();
        
        // Menentukan ID baru
        $newIdNumber = $lastPengguna ? (int) substr($lastPengguna->id_pengguna, 1) + 1 : 1;
        $newId = 'P' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT); // Format ID: P000, P001, dst.

        // Menambahkan data pengguna baru dengan ID otomatis
        Pengguna::create([
            'id_pengguna' => $newId, // ID baru yang dihitung otomatis
            'username' => 'sayaadmin',
            'nama_pengguna' => 'Administrator',
            'no_telepon' => '08123456789',
            'password' => Hash::make('12345678'),
        ]);
    }
}
