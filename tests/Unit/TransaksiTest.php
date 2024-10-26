<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransaksiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_transaksi_list()
    {
        $response = $this->get(route('transaksi.index'));

        $response->assertStatus(200);
        $response->assertViewIs('transaksi');
    }

    /** @test */
    public function it_displays_create_transaksi_form()
    {
        $response = $this->get(route('transaksi.create'));

        $response->assertStatus(200);
        $response->assertViewIs('create-transaksi');
    }

    /** @test */
    public function it_stores_new_transaksi()
    {
        // Buat data barang sebagai referensi
        $barang = Barang::factory()->create(['harga_jual' => 10000, 'stok' => 10]);

        // Data transaksi
        $transactionData = [
            'tanggal_transaksi' => now()->format('Y-m-d'),
            'barang' => [
                [
                    'id_barang' => $barang->id_barang,
                    'jumlah_beli' => 2,
                ]
            ]
        ];

        $response = $this->post(route('transaksi.store'), $transactionData);

        $response->assertRedirect(route('transaksi.index'));
        $this->assertDatabaseHas('transaksi', [
            'tanggal_transaksi' => $transactionData['tanggal_transaksi']
        ]);
    }

    /** @test */
    public function it_displays_transaksi_details()
    {
        // Buat transaksi baru untuk pengujian
        $transaksi = Transaksi::factory()->create();

        $response = $this->get(route('transaksi.show', $transaksi->id_transaksi));

        $response->assertStatus(200);
        $response->assertViewIs('detail-transaksi');
        $response->assertViewHas('transaksi', $transaksi);
    }
}
