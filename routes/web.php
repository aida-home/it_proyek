<?php

use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SAWController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\LaporanPenjualanController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Login dan Logout
Route::middleware('guest')->group(function () {
    Route::get('/login', [PenggunaController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [PenggunaController::class, 'login'])->name('login.submit');
});

Route::post('/logout', [PenggunaController::class, 'logout'])->name('logout.submit')->middleware('auth');

// Grup middleware auth
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [PenggunaController::class, 'dashboard'])->name('dashboard');

    // Barang
    Route::resource('barang', BarangController::class);
    Route::get('/barang/search', [BarangController::class, 'getBarang'])->name('barang.search');

    // Barang Masuk
    Route::get('/barangmasuk', [BarangMasukController::class, 'index'])->name('barangmasuk.index');
    Route::get('/barangmasuk/create', [BarangMasukController::class, 'create'])->name('barangmasuk.create');
    Route::post('/barangmasuk', [BarangMasukController::class, 'store'])->name('barangmasuk.store');
    Route::get('/barangmasuk/{id}/edit', [BarangMasukController::class, 'edit'])->name('barangmasuk.edit');
    Route::put('/barangmasuk/{id}', [BarangMasukController::class, 'update'])->name('barangmasuk.update');
    Route::delete('/barangmasuk/{id}', [BarangMasukController::class, 'destroy'])->name('barangmasuk.destroy');

    // Transaksi
    Route::resource('transaksi', TransaksiController::class);
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');

    // Laporan Penjualan
    Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan-penjualan.index');
    Route::get('/laporan-penjualan/export', [LaporanPenjualanController::class, 'export'])->name('laporan-penjualan.export');

    // Pengguna
    Route::resource('pengguna', PenggunaController::class);

    // SAW Export
    Route::get('/export-saw', [SAWController::class, 'exportDataSAW'])->name('saw.export');

    // Cek Stok
    Route::get('/cek-stok', [BarangController::class, 'cekStok'])->name('barang.cekStok');
    
    Route::resource('kategori', KategoriController::class);

    // Route untuk menampilkan hasil perhitungan SAW
    Route::get('/barang-terbaik', [SAWController::class, 'hitungBarangTerbaik'])->name('barang-terbaik');
    Route::get('/barang-rekomendasi', [SAWController::class, 'rekomendasiBarang'])->name('barang-rekomendasi');
});

// Posts
Route::prefix('posts')->group(function () {
    Route::post('/create', [PostController::class, 'createPost'])->name('posts.create');
    Route::get('/edit/{post}', [PostController::class, 'showEditScreen'])->name('posts.edit');
    Route::put('/edit/{post}', [PostController::class, 'actuallyUpdatePost'])->name('posts.update');
    Route::delete('/delete/{post}', [PostController::class, 'deletePost'])->name('posts.delete');
    Route::get('/home', function () {
        $posts = Post::all();
        return view('home', ['posts' => $posts]);
    })->name('posts.home');
});