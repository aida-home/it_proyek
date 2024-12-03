<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Barang;
use Illuminate\Support\Facades\Http;

class CekStokBarang extends Command
{
    protected $signature = 'stok:cek';
    protected $description = 'Cek stok barang dan kirim notifikasi jika stok menipis';

    public function handle()
    {
        // Ambang batas stok
        $threshold = 10; 

        // Barang dengan stok di bawah threshold
        $barangMenipis = Barang::where('stok_barang', '<', $threshold)->get();

        foreach ($barangMenipis as $barang) {
            $this->kirimNotifikasi($barang);
        }

        $this->info('Pengecekan stok selesai.');
    }

    private function kirimNotifikasi($barang)
    {
        $apiKey = "eV5dYotqwXQvvykMfvv9"; // Ganti dengan API Key Fonnte
        $url = "https://api.fonnte.com/send";
        $target = "6283824320186"; // Ganti dengan nomor tujuan

        $message = "Stok barang '{$barang->nama_barang}' menipis!\n" .
                   "Kategori: {$barang->kategori}\n" .
                   "Sisa stok: {$barang->stok_barang}\n" .
                   "Harga jual: Rp " . number_format($barang->harga_jual, 0, ',', '.');

        $response = Http::withHeaders(['Authorization' => $apiKey])
            ->post($url, [
                'target' => $target,
                'message' => $message,
            ]);

        if ($response->successful()) {
            $this->info("Notifikasi untuk '{$barang->nama_barang}' berhasil dikirim.");
        } else {
            $this->error("Gagal mengirim notifikasi untuk '{$barang->nama_barang}'.");
        }
    }
}
