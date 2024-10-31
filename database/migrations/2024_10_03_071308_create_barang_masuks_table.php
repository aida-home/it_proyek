<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangMasuksTable extends Migration
{
    public function up()//mendefinisikan perubahan apa yang harus diterapkan
    {
        Schema::create('barang_masuks', function (Blueprint $table) { //schema untuk mendefinisikan struktur tabel dalam database, memungkinkan untuk crud
            $table->string('id_barangmasuk')->primary(); // BM01, BM02, etc
            $table->string('nama_barang');
            $table->date('tgl_masuk');
            $table->integer('jumlah_masuk');
            $table->decimal('harga_beli', 15, 2);
            $table->string('supplier'); // Tambahkan kolom supplier_id
            $table->foreign('supplier')->references('id_supplier')->on('suppliers')->onDelete('cascade')->onUpdate('cascade'); // Foreign key ke suppliers
            $table->timestamps();
        });
    }    

    public function down()
    {
        Schema::dropIfExists('barang_masuks');
    }
}
