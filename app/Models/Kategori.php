<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
        protected $table = 'kategori';  // Nama tabel
        protected $primaryKey = 'id_kategori';  // Kolom primary key
        public $incrementing = false;  // Karena id_kategori bukan auto-increment
        protected $keyType = 'string';  // Tipe data id_kategori adalah string
    
        protected $fillable = ['id_kategori', 'nama_kategori'];  // Kolom yang bisa diisi
    }