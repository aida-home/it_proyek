<?php

use App\Models\Post;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;

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


Route::get('/barang', function () {
    $barang = Barang::all();
    return view('barang', ['barang'=> $barang]);
});
Route::resource('barang', BarangController::class);
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');


Route::get('/transaksi', function () {
    $transaksi = Transaksi::all();
    return view('transaksi', ['transaksi'=> $transaksi]);
});
// Route untuk menampilkan daftar transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');

// Route untuk menampilkan form tambah transaksi
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/{id}/detail', [TransaksiController::class, 'show'])->name('transaksi.show');

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

Route::get('/suppliers', function () {
    return view('suppliers');
});
