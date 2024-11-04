<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->string('id_barang')->primary(); // 001, 002, etc
            $table->string('nama_barang');
            $table->integer('stok')->default(0); // Total stok dari barang_masuks
            $table->decimal('harga_jual', 15, 2);
            $table->string('kategori');
            $table->foreign('kategori')->references('id_kategori')->on('kategori')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('barang');
    }
}