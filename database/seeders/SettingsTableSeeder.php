<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan data default untuk nomor WhatsApp
        DB::table('settings')->insert([
            'whatsapp_number' => '6283824320186', // Nomor WhatsApp default
        ]);
    }
}
