<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransaksiTest extends TestCase
{
    use RefreshDatabase; // Menggunakan trait untuk refresh database

    // Menguji apakah transaksi dapat disimpan dengan benar
    public function testStoreTransaksi()
    {
            // Buat kategori terlebih dahulu
    $kategori = Kategori::create([
        'id_kategori'=>'KT1',
        'nama_kategori' => 'Kategori 1'
    ]);

        // Buat beberapa data barang dengan kategori
        $barang = Barang::create([
            'id_barang' => 'B001',
            'nama_barang' => 'Barang 1',
            'harga_jual' => 10000,
            'stok' => 10,
            'kategori' => $kategori->id_kategori, // Tambahkan kategori di sini
        ]);

        // Data untuk transaksi yang akan disimpan
        $data = [
            'tanggal_transaksi' => now()->toDateString(),
            'barang' => [
                [
                    'id_barang' => $barang->id_barang,
                    'jumlah_beli' => 2,
                ]
            ],
        ];

        // Mengirim request untuk menyimpan transaksi
        $response = $this->post(route('transaksi.store'), $data);

        // Memastikan response berhasil
        $response->assertRedirect(route('transaksi.index'));
        $response->assertSessionHas('success', 'Transaksi berhasil disimpan.');

        // Memastikan transaksi tersimpan di database
        $this->assertDatabaseHas('transaksi', [
            'tanggal_transaksi' => $data['tanggal_transaksi'],
        ]);

        // Memastikan detail transaksi tersimpan dengan benar
        $this->assertDatabaseHas('detail_transaksi', [
            'id_barang' => $barang->id_barang,
            'jumlah_beli' => 2,
        ]);

        // Memastikan stok barang berkurang setelah transaksi
        $this->assertDatabaseHas('barang', [
            'id_barang' => $barang->id_barang,
            'stok' => 8, // 10 - 2
        ]);
    }

    // Menguji validasi saat menyimpan transaksi tanpa data yang diperlukan
    public function testStoreTransaksiValidation()
    {
        // Mengirim request untuk menyimpan transaksi tanpa tanggal
        $response = $this->post(route('transaksi.store'), [
            'barang' => [
                [
                    'id_barang' => 'B001',
                    'jumlah_beli' => 2,
                ],
            ],
        ]);

        // Memastikan response memiliki error yang diharapkan
        $response->assertSessionHasErrors('tanggal_transaksi');
    }

    // Menguji menampilkan semua transaksi
    public function testIndexTransaksi()
    {
        // Buat transaksi
        Transaksi::create([
            'id_transaksi' => 'TR01',
            'tanggal_transaksi' => now()->toDateString(),
            'total_pembayaran' => 20000,
        ]);

        // Mengirim request untuk menampilkan transaksi
        $response = $this->get(route('transaksi.index'));

        // Memastikan response berhasil
        $response->assertStatus(200);
        $response->assertViewIs('transaksi');
        $response->assertSee('TR01'); // Pastikan ID transaksi muncul di tampilan
    }

    // Menguji menampilkan detail transaksi
    public function testShowDetailTransaksi()
    {
        // Buat transaksi
        $transaksi = Transaksi::create([
            'id_transaksi' => 'TR01',
            'tanggal_transaksi' => now()->toDateString(),
            'total_pembayaran' => 20000,
        ]);

        // Mengirim request untuk menampilkan detail transaksi
        $response = $this->get(route('transaksi.show', $transaksi->id_transaksi));

        // Memastikan response berhasil
        $response->assertStatus(200);
        $response->assertViewIs('detail-transaksi');
        $response->assertSee('TR01'); // Pastikan ID transaksi muncul di tampilan
    }

    // Menguji jika transaksi tidak ditemukan
    public function testShowDetailTransaksiNotFound()
    {
        // Mengirim request untuk menampilkan detail transaksi yang tidak ada
        $response = $this->get(route('transaksi.show', 'TR999'));

        // Memastikan redirect dan pesan error
        $response->assertRedirect(route('transaksi.index'));
        $response->assertSessionHas('error', 'Transaksi tidak ditemukan');
    }
}
