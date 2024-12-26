<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori', compact('kategori'));
    }

    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        return view('create-kategori');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        if (Kategori::where('nama_kategori', $request->nama_kategori)->exists()) {
            return back()->withErrors(['nama_kategori' => 'Nama kategori sudah ada.']);
        }

        $lastKategori = Kategori::orderBy('id_kategori', 'desc')->first();
        $newIdNumber = $lastKategori ? ((int) substr($lastKategori->id_kategori, 2) + 1) : 1;
        $newId = 'KT' . str_pad($newIdNumber, 6, '0', STR_PAD_LEFT);

        Kategori::create([
            'id_kategori' => $newId,
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit(Kategori $kategori)
    {
        return view('edit-kategori', compact('kategori'));
    }

    // Memperbarui data kategori
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required' . $kategori->id,
        ]);

        if (Kategori::where('nama_kategori', $request->nama_kategori)->exists()) {
            return back()->withErrors(['nama_kategori' => 'Nama kategori sudah ada.']);
        }

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Menghapus kategori
    public function destroy(Kategori $kategori)
    {
        //hapus kategori
        $nama_kategori = $kategori->nama_kategori;
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori ' . $nama_kategori . ' berhasil dihapus.');
    }
}
