<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaTable extends Migration
{
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('id_pengguna');  // Gunakan auto-increment
            $table->string('username')->unique();
            $table->string('no_telepon');
            $table->string('password');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
}
