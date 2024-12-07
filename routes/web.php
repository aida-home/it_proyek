<?php

use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\BarangController;



Route::get('/cek-stok', [BarangController::class, 'cekStok']);

// Rute untuk BarangController
Route::get('barang', [BarangController::class, 'index'])->name('barang.index'); // Menampilkan semua barang
Route::get('barang/create', [BarangController::class, 'create'])->name('barang.create'); // Form untuk membuat barang baru
Route::post('barang', [BarangController::class, 'store'])->name('barang.store'); // Menyimpan barang baru
Route::get('barang/{id}', [BarangController::class, 'show'])->name('barang.show'); // Menampilkan detail barang
Route::get('barang/{id_barang}/edit', [BarangController::class, 'edit'])->name('barang.edit'); // Form untuk mengedit barang
Route::put('barang/{id}', [BarangController::class, 'update'])->name('barang.update'); // Memperbarui data barang
Route::delete('barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy'); // Menghapus barang

// Rute untuk PenggunaController
Route::get('pengguna', [PenggunaController::class, 'index'])->name('pengguna.index'); // Menampilkan semua pengguna
Route::get('pengguna/create', [PenggunaController::class, 'create'])->name('pengguna.create'); // Form untuk membuat pengguna baru
Route::post('pengguna', [PenggunaController::class, 'store'])->name('pengguna.store'); // Menyimpan pengguna baru
Route::get('pengguna/{id_pengguna}', [PenggunaController::class, 'show'])->name('pengguna.show'); // Menampilkan detail pengguna
Route::get('pengguna/{id_pengguna}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit'); // Form untuk mengedit pengguna
Route::put('pengguna/{id_pengguna}', [PenggunaController::class, 'update'])->name('pengguna.update'); // Memperbarui data pengguna
Route::delete('pengguna/{id_pengguna}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy'); // Menghapus pengguna


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


// Route untuk login
Route::middleware('guest')->get('/login', [PenggunaController::class, 'showLoginForm'])->name('login');
Route::post('/login', [PenggunaController::class, 'login'])->name('login.submit');

// Route untuk logout
Route::post('/logout', [PenggunaController::class, 'logout'])->name('logout.submit')->middleware('auth');

Route::middleware('auth')->group(function() {
    // Rute untuk dashboard
    Route::get('/dashboard', [PenggunaController::class, 'dashboard'])->name('dashboard');
});

// Route home
Route::get('/', function () {
    return view('welcome');
});

Route::get('/laporan-penjualan', function () {
    return view('laporan-penjualan');
});
Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan-penjualan.index');
Route::get('/laporan-penjualan/export', [LaporanPenjualanController::class, 'export'])->name('laporan-penjualan.export');

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
