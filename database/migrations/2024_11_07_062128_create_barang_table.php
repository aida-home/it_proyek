<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->string('id_barang')->primary(); // Menjadikan id_barang sebagai primary key
            $table->string('nama_barang'); // Kolom untuk menyimpan nama barang
            $table->string('kategori'); // Kolom untuk menyimpan kategori barang
            $table->integer('stok_barang'); // Kolom untuk menyimpan jumlah stok barang
            $table->decimal('harga_jual', 10, 2); // Kolom untuk menyimpan harga jual barang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
