<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateLaporanPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_penjualan', function (Blueprint $table) {
            // Primary key berupa kode laporan seperti LP0001, LP0002
            $table->string('id_laporan_penjualan')->primary(); 
            
            // Kolom untuk tanggal awal dan akhir laporan
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            
            // Total penjualan dalam periode laporan
            $table->decimal('total_penjualan', 15, 2);
            
            $table->timestamps(); // Untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_penjualan');
    }
}

