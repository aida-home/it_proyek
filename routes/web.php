<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DataBarangController;

// Rute untuk DataBarangController
Route::get('databarang', [DataBarangController::class, 'index'])->name('databarang.index'); // Menampilkan semua barang
Route::get('databarang/create', [DataBarangController::class, 'create'])->name('databarang.create'); // Form untuk membuat barang baru
Route::post('databarang', [DataBarangController::class, 'store'])->name('databarang.store'); // Menyimpan barang baru
Route::get('databarang/{id}', [DataBarangController::class, 'show'])->name('databarang.show'); // Menampilkan detail barang
Route::get('databarang/{id_databarang}/edit', [DataBarangController::class, 'edit'])->name('databarang.edit'); // Form untuk mengedit barang
Route::put('databarang/{id}', [DataBarangController::class, 'update'])->name('databarang.update'); // Memperbarui data barang
Route::delete('databarang/{id}', [DataBarangController::class, 'destroy'])->name('databarang.destroy'); // Menghapus barang

// Rute untuk PenggunaController
Route::get('penggunas', [PenggunaController::class, 'index'])->name('penggunas.index'); // Menampilkan semua pengguna
Route::get('penggunas/create', [PenggunaController::class, 'create'])->name('penggunas.create'); // Form untuk membuat pengguna baru
Route::post('penggunas', [PenggunaController::class, 'store'])->name('penggunas.store'); // Menyimpan pengguna baru
Route::get('penggunas/{id}', [PenggunaController::class, 'show'])->name('penggunas.show'); // Menampilkan detail pengguna
Route::get('penggunas/{id_pengguna}/edit', [PenggunaController::class, 'edit'])->name('penggunas.edit'); // Form untuk mengedit pengguna
Route::put('penggunas/{id}', [PenggunaController::class, 'update'])->name('penggunas.update'); // Memperbarui data pengguna
Route::delete('penggunas/{id}', [PenggunaController::class, 'destroy'])->name('penggunas.destroy'); // Menghapus pengguna