<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Models\Barang;

class BarangMasukController extends Controller
{
    // Menampilkan semua data barang masuk
    public function index()
    {
        $barangMasuk = BarangMasuk::with('kategori', 'barang')->get();
        $kategori = Kategori::all();
        $barang = Barang::all();

        return view('barangmasuk', compact('kategori', 'barangMasuk', 'barang'));
    }

    // Menampilkan form tambah barang masuk
    public function create()
    {
        $kategori = Kategori::all();
        $barang = Barang::all();
        return view('tambah-barangmasuk', compact('kategori', 'barang'));
    }

    // Menyimpan data barang masuk baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_barang' => 'required|exists:barang,id_barang', 
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'tgl_masuk' => 'required|date|before_or_equal:today',
            'jumlah_masuk' => 'required|integer|min:1',
            'harga_beli' => 'required|numeric|min:0',
        ]);

        // Membuat ID barang masuk baru
        $lastBarang = BarangMasuk::orderBy('id_barangmasuk', 'desc')->first();
        $newId = $lastBarang ? 'BM' . str_pad((int)substr($lastBarang->id_barangmasuk, 2) + 1, 6, '0', STR_PAD_LEFT) : 'BM000001';

        // Menyimpan data barang masuk
        $barangMasuk = BarangMasuk::create([
            'id_barangmasuk' => $newId,
            'id_barang' => $request->id_barang,
            'id_kategori' => $request->id_kategori,
            'tgl_masuk' => $request->tgl_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'harga_beli' => $request->harga_beli,
        ]);

        // Update stok barang
        $barang = Barang::findOrFail($request->id_barang);
        $barang->stok_barang += $request->jumlah_masuk;
        $barang->harga_beli = $request->harga_beli; // Update harga beli
        $barang->save();

        // Redirect ke halaman barang masuk dengan pesan sukses
        return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil ditambahkan dan stok diperbarui.');
    }

    // Menampilkan form edit barang masuk
    public function edit($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $kategori = Kategori::all();
        $barang = Barang::all();

        return view('ubah-barangmasuk', compact('barangMasuk', 'kategori', 'barang'));
    }

    // Memperbarui data barang masuk
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'id_barang' => 'required|exists:barang,id_barang', 
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'tgl_masuk' => 'required|date',
            'jumlah_masuk' => 'required|integer|min:1',
            'harga_beli' => 'required|numeric|min:0',
        ]);

        $barangMasuk = BarangMasuk::findOrFail($id);
        $barang = Barang::findOrFail($barangMasuk->id_barang);

        // Update stok barang sebelum perubahan (kembalikan stok sebelumnya)
        $barang->stok_barang -= $barangMasuk->jumlah_masuk;

        // Update barang masuk dan stok baru
        $barangMasuk->update([
            'id_barang' => $request->id_barang,
            'id_kategori' => $request->id_kategori,
            'tgl_masuk' => $request->tgl_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'harga_beli' => $request->harga_beli,
        ]);

        // Tambahkan stok baru dan update harga beli
        $barang->stok_barang += $request->jumlah_masuk;
        $barang->harga_beli = $request->harga_beli;
        $barang->save();

        return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil diperbarui dan stok diperbarui.');
    }

    // Menghapus data barang masuk
    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);

        // Update stok barang sebelum menghapus barang masuk
        $barang = Barang::findOrFail($barangMasuk->id_barang);
        $barang->stok_barang -= $barangMasuk->jumlah_masuk;
        $barang->save();

        // Hapus data barang masuk
        $barangMasuk->delete();

        return redirect()->route('barangmasuk.index')->with('success', 'Data barang masuk berhasil dihapus.');
    }

    // Mendapatkan kategori berdasarkan barang (untuk pengisian otomatis kategori)
    public function getKategori($id)
    {
        $barang = Barang::with('kategori')->find($id);
    
        // Jika barang ditemukan dan kategori ada
        if ($barang && $barang->kategori) {
            return response()->json([
                'nama_kategori' => $barang->kategori->nama_kategori,
            ]);
        }
    
        // Jika kategori tidak ditemukan
        return response()->json(['error' => 'Kategori tidak ditemukan'], 404);
    }
}

