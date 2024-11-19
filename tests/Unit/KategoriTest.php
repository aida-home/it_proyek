<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KategoriTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_delete_a_category()
    {
        // Buat kategori contoh
        $kategori = Kategori::create([
            'id_kategori' => 'KT1',
            'nama_kategori' => 'Baju',
        ]);

        // Panggil fungsi delete
        $response = $this->delete("/delete-kategori/{$kategori->id_kategori}");

        // Pastikan kategori terhapus
        $this->assertDatabaseMissing('kategori', ['id_kategori' => 'KT1']);
        $response->assertRedirect('/kategori');
    }

    /** @test */
    public function it_can_update_a_category()
    {
        // Buat kategori contoh
        $kategori = Kategori::create([
            'id_kategori' => 'KT1',
            'nama_kategori' => 'Celana',
        ]);

        // Update kategori
        $response = $this->put("/edit-kategori/{$kategori->id_kategori}", [
            'nama_kategori' => 'Jaket',
        ]);

        // Pastikan kategori terupdate
        $this->assertDatabaseHas('kategori', [
            'id_kategori' => 'KT1',
            'nama_kategori' => 'Jaket',
        ]);
        $response->assertRedirect('/kategori')->assertSessionHas('success', 'Kategori berhasil diupdate.');
    }

    /** @test */
    public function it_can_create_a_category_with_custom_id()
    {
        // Buat kategori baru
        $response = $this->post('/create-kategori', [
            'nama_kategori' => 'Jaket',
        ]);

        // Pastikan kategori baru ada di database
        $this->assertDatabaseHas('kategori', ['nama_kategori' => 'Jaket']);
        $response->assertRedirect('/kategori');
        $this->assertEquals('KT1', Kategori::first()->id_kategori);
    }

    /** @test */
    public function it_displays_the_edit_screen()
    {
        // Buat kategori contoh
        $kategori = Kategori::create([
            'id_kategori' => 'KT1',
            'nama_kategori' => 'Baju',
        ]);

        // Buka halaman edit
        $response = $this->get("/edit-kategori/{$kategori->id_kategori}");

        // Pastikan halaman menampilkan data kategori
        $response->assertStatus(200);
        $response->assertViewIs('edit-kategori');
        $response->assertViewHas('kategori', $kategori);
    }

    /** @test */
    public function it_displays_the_create_form()
    {
        // Buka halaman create
        $response = $this->get('/create-kategori');

        // Pastikan halaman menampilkan form create
        $response->assertStatus(200);
        $response->assertViewIs('create-kategori');
    }
}
