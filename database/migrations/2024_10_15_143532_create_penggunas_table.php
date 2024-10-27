<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunasTable extends Migration
{
    public function up()
    {
        Schema::create('penggunas', function (Blueprint $table) {
            $table->string('id_pengguna')->primary(); // Teks dengan primary key
            $table->string('nama_pengguna');
            $table->string('no_telepon');
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('penggunas');
    }
}