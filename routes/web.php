<?php

use App\Models\Post;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\BarangController;

Route::get('barang', [BarangController::class, 'index'])->name('barang.index'); // Menampilkan semua barang
Route::get('barang/create', [BarangController::class, 'create'])->name('barang.create'); // Form untuk membuat barang baru
Route::post('barang', [BarangController::class, 'store'])->name('barang.store'); // Menyimpan barang baru
Route::get('barang/{id}', [BarangController::class, 'show'])->name('barang.show'); // Menampilkan detail barang
Route::get('barang/{id_barang}/edit', [BarangController::class, 'edit'])->name('barang.edit'); // Form untuk mengedit barang
Route::put('barang/{id}', [BarangController::class, 'update'])->name('barang.update'); // Memperbarui data barang
Route::delete('barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy'); // Menghapus barang

// Rute untuk PenggunaController
Route::get('penggunas', [PenggunaController::class, 'index'])->name('penggunas.index'); // Menampilkan semua pengguna
Route::get('penggunas/create', [PenggunaController::class, 'create'])->name('penggunas.create'); // Form untuk membuat pengguna baru
Route::post('penggunas', [PenggunaController::class, 'store'])->name('penggunas.store'); // Menyimpan pengguna baru
Route::get('penggunas/{id}', [PenggunaController::class, 'show'])->name('penggunas.show'); // Menampilkan detail pengguna
Route::get('penggunas/{id_pengguna}/edit', [PenggunaController::class, 'edit'])->name('penggunas.edit'); // Form untuk mengedit pengguna
Route::put('penggunas/{id}', [PenggunaController::class, 'update'])->name('penggunas.update'); // Memperbarui data pengguna
Route::delete('penggunas/{id}', [PenggunaController::class, 'destroy'])->name('penggunas.destroy'); // Menghapus pengguna

Route::resource('suppliers', SupplierController::class);

// Routing untuk Barang Masuk
Route::get('/barangmasuk', [BarangMasukController::class, 'index'])->name('barangmasuk.index');
// Route untuk menampilkan form tambah barangmasuk (metode GET)
Route::get('/barangmasuk/create', [BarangMasukController::class, 'create'])->name('barangmasuk.create');
// Route untuk menyimpan data barang masuk (metode POST)
Route::post('/barangmasuk/create', [BarangMasukController::class, 'store'])->name('barangmasuk.store');
Route::get('/barangmasuk/{id}/edit', [BarangMasukController::class, 'edit'])->name('barangmasuk.edit');
Route::put('/barangmasuk/{id}', [BarangMasukController::class, 'update'])->name('barangmasuk.update');
Route::delete('/barangmasuk/{id}', [BarangMasukController::class, 'destroy'])->name('barangmasuk.destroy');

// Route untuk Dashboard
Route::get('/beranda', function () {
    $posts = Post::all();
    return view('beranda', ['posts'=> $posts]);
});

Route::post('/register', [UserController::class,'register']);

Route::post('/login', [UserController::class,'login']);

Route::post('/logout', [UserController::class,'logout']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/laporan-penjualan', function () {
    return view('laporan-penjualan');
});
Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan-penjualan.index');

Route::resource('transaksi', TransaksiController::class);


Route::get('/home', function () {
    $posts = Post::all();//menampilkan semua artikel
    return view('home', ['posts'=> $posts]);
});

Route::post('/create-post', [PostController::class,'createPost']);
Route::get('/edit-post/{post}', [PostController::class,'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class,'actuallyUpdatePost']);
Route::delete('/delete-post/{post}', [PostController::class,'deletePost']);

Route::get('/kategori', function () {
    $kategori = Kategori::all();
    return view('kategori', ['kategori'=> $kategori]);
});

Route::post('/create-kategori', [KategoriController::class, 'createKategori']);
Route::get('/create-kategori', [KategoriController::class, 'showCreateForm']);
Route::get('/edit-kategori/{kategori}', [KategoriController::class,'showEditScreen']);
Route::put('/edit-kategori/{kategori}', [KategoriController::class,'actuallyUpdateKategori']);
Route::delete('/delete-kategori/{kategori}', [KategoriController::class,'deleteKategori']);
