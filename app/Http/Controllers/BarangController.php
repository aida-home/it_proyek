<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk; // Pastikan ini di-import
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Menyimpan barang baru
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $validatedData = $request->validate([
            'id_barang_masuk' => 'required|exists:barang_masuks,id_barang_masuk', // Validasi ID barang masuk
            'harga_jual' => 'required|numeric|min:0',
        ]);

        // Ambil data barang masuk berdasarkan ID yang dipilih
        $barangMasuk = BarangMasuk::find($validatedData['id_barang_masuk']);

        // Mendapatkan ID barang baru dengan prefix 'DB'
        $lastBarang = Barang::orderBy('id_barang', 'desc')->first();
        $newIdNumber = $lastBarang ? intval(substr($lastBarang->id_barang, 2)) + 1 : 1;
        $newId = 'DB' . str_pad($newIdNumber, 2, '0', STR_PAD_LEFT);

        // Buat data baru menggunakan model Barang
        $barang = new Barang();
        $barang->id_barang = $newId; // Tambahkan id_barang
        $barang->nama_barang = $barangMasuk->nama_barang; // Ambil nama barang dari barang masuk
        $barang->kategori = $barangMasuk->kategori; // Ambil kategori dari barang masuk
        $barang->stok_barang = $barangMasuk->stok_barang; // Ambil stok dari barang masuk
        $barang->harga_jual = $validatedData['harga_jual']; // Ambil harga jual dari form
        $barang->save(); // Simpan ke database

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    // Menampilkan daftar barang (Index)
    public function index() 
    {
        $barang = Barang::all(); // Mengambil semua barang
        return view('barang', compact('barang')); // Mengirimkan data ke view
    }

    // Menampilkan form untuk membuat barang baru
    public function create()
    {
        $barangMasuk = BarangMasuk::all(); // Ambil semua barang masuk
        return view('tambah-barang', compact('barangMasuk')); // Kirim data barang masuk ke view
    }

    // Menampilkan form edit barang
    public function edit($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        return view('edit-barang', compact('barang'));
    }

    // Mengupdate barang
    public function update(Request $request, $id_barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stok_barang' => 'required|integer|min:0',
            'harga_jual' => 'required|numeric|min:0'
        ]);
        
        $barang = Barang::findOrFail($id_barang);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'stok_barang' => $request->stok_barang,
            'harga_jual' => $request->harga_jual,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    // Menghapus barang
    public function destroy($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
