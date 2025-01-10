<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksiTable extends Migration
{
    public function up()
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->string('id_detail_transaksi')->primary(); 
            $table->string('id_transaksi');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi')->onUpdate('cascade')->onDelete('cascade');
            $table->string('id_barang')->nullable();
            $table->foreign('id_barang')->references('id_barang')->on('barang')->onUpdate('cascade')->onDelete('set null');
            $table->string('nama_barang');
            $table->decimal('harga_jual', 15, 2);
            $table->decimal('harga_beli', 15, 2);
            $table->integer('jumlah_beli');
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_transaksi');
    }
}
