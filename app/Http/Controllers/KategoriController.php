<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function deleteKategori(Kategori $kategori) {
        //hapus kategori
        $kategori->delete();
        return redirect('/kategori');
    }
    public function actuallyUpdateKategori(Kategori $kategori, Request $request) {
            // Validasi input
            $request->validate([
                'nama_kategori' => 'required'
            ]);

            if (Kategori::where('nama_kategori', $request->nama_kategori)->exists()) {
                return back()->withErrors(['nama_kategori' => 'Nama kategori sudah ada.']);
               }
    
            // Update nama kategori
            $kategori->update([
                'nama_kategori' => $request->nama_kategori,
            ]);

            return redirect('/kategori')->with('success', 'Kategori berhasil diubah.');    
    }
    public function showEditScreen(Kategori $kategori) {
        return view('edit-kategori', ['kategori'=>$kategori]);
    }

    public function showCreateForm() {
        // Tampilkan form untuk menambah kategori baru
        return view('create-kategori');
    }
    
    public function createKategori(Request $request) {
            // Validasi input
            $request->validate([
                'nama_kategori' => 'required'
            ]);
    
                // Cek apakah nama_kategori sudah ada
            if (Kategori::where('nama_kategori', $request->nama_kategori)->exists()) {
             return back()->withErrors(['nama_kategori' => 'Nama kategori sudah ada.']);
            }

            // Ambil ID kategori terakhir
            $lastKategori = Kategori::orderBy('id_kategori', 'desc')->first();
    
            // Buat ID baru dengan format KT1, KT2, dan seterusnya
            if ($lastKategori) {
                // Ambil nomor dari ID terakhir (misal KT1 menjadi 1)
                $lastIdNumber = (int) substr($lastKategori->id_kategori, 2);
                // Tambahkan 1 untuk ID baru
                $newIdNumber = $lastIdNumber + 1;
            } else {
                // Jika belum ada data, mulai dari 1
                $newIdNumber = 1;
            }
    
            // Format ID baru menjadi KT1, KT2, dst.
            $newId = 'KT' . $newIdNumber;
    
            // Buat kategori baru
            Kategori::create([
                'id_kategori' => $newId,  // Set ID kustom
                'nama_kategori' => $request->nama_kategori,
            ]);
    
            return redirect('/kategori')->with('success', 'Kategori berhasil ditambahkan dengan ID: ' . $newId);
        }
    }
