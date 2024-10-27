<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use Illuminate\Http\Request;

class DataBarangController extends Controller
{
    // Menyimpan barang baru
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stok_barang' => 'required|integer|min:0',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        // Mendapatkan ID barang terakhir untuk membuat ID baru dengan prefix 'DB'
        $lastDataBarang = DataBarang::orderBy('id_databarang', 'desc')->first();
        $newIdNumber = $lastDataBarang ? intval(substr($lastDataBarang->id_databarang, 2)) + 1 : 1;
        $newId = 'DB' . str_pad($newIdNumber, 2, '0', STR_PAD_LEFT);

        // Buat data baru menggunakan model DataBarang
        $barang = new DataBarang();
        $barang->id_databarang = $newId; // Tambahkan id_databarang
        $barang->nama_barang = $validatedData['nama_barang'];
        $barang->kategori = $validatedData['kategori'];
        $barang->stok_barang = $validatedData['stok_barang'];
        $barang->harga_jual = $validatedData['harga_jual'];
        $barang->save(); // Simpan ke database

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('databarang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    // Menampilkan daftar barang (Index)
    public function index() 
    {
    $databarang = DataBarang::all(); // Mengambil semua data barang
    return view('databarang', compact('databarang')); // Mengirimkan data ke view
    }


    // Menampilkan form untuk membuat barang baru
    public function create()
    {
        return view('tambah-databarang');
    }

    // Menampilkan form edit barang
    public function edit($id_databarang)
    {
        $databarang = DataBarang::findOrFail($id_databarang);
        return view('edit-databarang', compact('databarang'));
    }

    // Mengupdate barang
    public function update(Request $request, $id_databarang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stok_barang' => 'required|integer|min:0',
            'harga_jual' => 'required|numeric|min:0'
        ]);
        
        $databarang = DataBarang::findOrFail($id_databarang);

        $databarang->update([
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'stok_barang' => $request->stok_barang,
            'harga_jual' => $request->harga_jual,
        ]);

        return redirect()->route('databarang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    // Menghapus barang
    public function destroy($id_databarang)
    {
        $databarang = DataBarang::findOrFail($id_databarang);
        $databarang->delete();

        return redirect()->route('databarang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
