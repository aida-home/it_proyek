<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\BarangController;

class CekStokCommand extends Command
{
    protected $signature = 'cek:stok';  // Nama command
    protected $description = 'Periksa stok barang dan kirim notifikasi';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        (new BarangController())->cekStok();
    }
}

