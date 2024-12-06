<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\CekStokCommand;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Menambahkan command dengan signature dan closure
Artisan::command('cek:stok', function () {
    $this->call(CekStokCommand::class);
})->everyMinute();  // Atur interval penjadwalan di sini
