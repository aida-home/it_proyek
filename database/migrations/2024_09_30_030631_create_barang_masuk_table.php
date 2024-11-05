<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangMasukTable extends Migration
{
    public function up()
    {
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->string('id_barangmasuk')->primary();
            $table->string('nama_barang');
            $table->string('supplier');
            $table->string('kategori');
            $table->foreign('kategori')->references('id_kategori')->on('kategori')->onUpdate('cascade')->onDelete('cascade');
            $table->date('tgl_masuk');
            $table->integer('jumlah_masuk');
            $table->integer('harga_beli');
            $table->timestamps();
        });
        
    }    

    public function down()
    {
        Schema::dropIfExists('barang_masuk');
    }
}

