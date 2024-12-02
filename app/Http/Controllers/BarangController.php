<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\NotifikasiLog;

class BarangController extends Controller
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
        $lastBarang = Barang::orderBy('id_barang', 'desc')->first();
        $newIdNumber = $lastBarang ? intval(substr($lastBarang->id_barang, 2)) + 1 : 1;
        $newId = 'DB' . str_pad($newIdNumber, 2, '0', STR_PAD_LEFT);

        // Buat data baru menggunakan model Barang
        $barang = new Barang();
        $barang->id_barang = $newId; // Tambahkan id_barang
        $barang->nama_barang = $validatedData['nama_barang'];
        $barang->kategori = $validatedData['kategori'];
        $barang->stok_barang = $validatedData['stok_barang'];
        $barang->harga_jual = $validatedData['harga_jual'];
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
        return view('tambah-barang');
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

    public function updateStok(Request $request, $id)
{
    $barang = Barang::findOrFail($id);
    $barang->stok_barang = $request->input('stok_barang');
    $barang->save();

    // Hapus log untuk barang ini
    NotifikasiLog::where('id_barang', $barang->id_barang)->delete();

    return response()->json(['message' => 'Stok berhasil diperbarui.']);
}

}

