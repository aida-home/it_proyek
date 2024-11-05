<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Fungsi untuk menampilkan daftar barang
// Fungsi untuk menampilkan daftar barang
public function index()
{
    $barang = Barang::with('barang_masuk')->get();
    $barang_masuks = BarangMasuk::all(); // Ambil semua barang masuk
    return view('barang', compact('barang','kategori'));
}

// Fungsi untuk menampilkan form penambahan barang baru
public function create()
{
    $barang_masuks = BarangMasuk::all(); // Ambil semua barang masuk
    return view('create-barang', compact('barang_masuk')); // Kirim kedua variabel
}

    // Fungsi untuk menyimpan barang baru ke database
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_barang' => 'required',
            'harga_jual' => 'required|numeric',
        ]);

        // Membuat id_barang secara otomatis dalam format 001, 002, 003, dst.
        $latestBarang = Barang::orderBy('id_barang', 'desc')->first();
        if (!$latestBarang) {
            $newId = '001';
        } else {
            $lastIdNumber = (int) substr($latestBarang->id_barang, -3);
            $newId = str_pad($lastIdNumber + 1, 3, '0', STR_PAD_LEFT);
        }
        
        $totalStok = BarangMasuk::where('nama_barang', $request->nama_barang)->sum('jumlah_masuk');
        // Simpan data barang ke database
        $barang = new Barang();
        $barang->id_barang = $newId;
        $barang->nama_barang = $request->nama_barang;
        $barang->stok = $totalStok; // Set stok berdasarkan total barang masuk
        $barang->harga_jual = $request->harga_jual; // Pastikan harga_jual disimpan
        $barang->kategori = $request->kategori;
        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    // Fungsi untuk menampilkan form edit barang
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    // Fungsi untuk menyimpan perubahan data barang
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|integer',
            'harga_jual' => 'required|numeric',
        ]);

        // Update data barang di database
        $barang = Barang::findOrFail($id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'harga_jual' => $request->harga_jual,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate.');
    }

    // Fungsi untuk menghapus barang
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
