<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaTable extends Migration
{
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->string('id_pengguna')->primary();
            $table->string('nama_pengguna');
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }
    
    

    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
}
