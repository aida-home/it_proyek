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
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'id_barang' => 'required|exists:barang,id_barang', // pastikan 'id_barang' adalah id_barang
            'tgl_masuk' => 'required|date|before_or_equal:today',
            'jumlah_masuk' => 'required|integer',
            'harga_beli' => 'required|numeric',
        ]);

        // Membuat ID barang masuk baru
        $lastBarang = BarangMasuk::orderBy('id_barangmasuk', 'desc')->first();
        $newId = $lastBarang ? 'BM' . str_pad((int)substr($lastBarang->id_barangmasuk, 2) + 1, 6, '0', STR_PAD_LEFT) : 'BM000001';

        // Menyimpan data barang masuk
        $barangMasuk = BarangMasuk::create([
            'id_barangmasuk' => $newId,
            'id_kategori' => $request->id_kategori,
            'id_barang' => $request->id_barang,
            'tgl_masuk' => $request->tgl_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'harga_beli' => $request->harga_beli,
        ]);

        // Update stok barang
        $barang = Barang::findOrFail($request->id_barang); // Menggunakan id_barang
        $barang->stok_barang += $request->jumlah_masuk;   // Menambahkan jumlah masuk ke stok barang

        // Jika harga beli berbeda, perbarui harga beli
        if ($barang->harga_beli != $request->harga_beli) {
            $barang->harga_beli = $request->harga_beli;
        }

        // Simpan perubahan stok barang
        $barang->save();

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
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'id_barang' => 'required|exists:barang,id_barang', // pastikan 'id_barang' adalah id_barang
            'tgl_masuk' => 'required|date',
            'jumlah_masuk' => 'required|integer',
            'harga_beli' => 'required|numeric',
        ]);

        $barangMasuk = BarangMasuk::findOrFail($id);

        // Update stok barang
        $barang = Barang::findOrFail($barangMasuk->id_barang); // Menggunakan id_barang yang benar
        $barang->stok_barang += $request->jumlah_masuk;     // Tambahkan stok baru

        // Update harga beli jika berbeda
        if ($barang->harga_beli != $request->harga_beli) {
            $barang->harga_beli = $request->harga_beli;
        }

        $barang->save();

        // Update data barang masuk
        $barangMasuk->update([
            'id_kategori' => $request->id_kategori,
            'id_barang' => $request->id_barang,
            'tgl_masuk' => $request->tgl_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'harga_beli' => $request->harga_beli,
        ]);

        return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil diperbarui dan stok diperbarui.');
    }

    // Menghapus data barang masuk
    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);

        // Update stok barang sebelum menghapus barang masuk
        $barang = Barang::findOrFail($barangMasuk->id_barang); // Menggunakan id_barang yang benar
        $barang->stok_barang -= $barangMasuk->jumlah_masuk; // Kurangi stok barang yang dihapus
        $barang->save();

        // Hapus data barang masuk
        $barangMasuk->delete();

        return redirect()->route('barangmasuk.index')->with('success', 'Data barang masuk berhasil dihapus.');
    }
}
