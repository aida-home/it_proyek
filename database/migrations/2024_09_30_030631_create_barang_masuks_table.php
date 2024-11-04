<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangMasuksTable extends Migration
{
    public function up()
    {
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->string('id_barangmasuk')->primary();
            $table->string('nama_barang');
            $table->string('supplier');
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

