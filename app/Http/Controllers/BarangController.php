<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Setting;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BarangController extends Controller
{
    // Menampilkan daftar barang
    public function index()
    {
        $barang = Barang::with('kategori')->orderBy('id_barang', 'desc')->get();
        return view('barang', compact('barang'));
    }

    // Menampilkan form untuk menambah barang
    public function create()
    {
        $kategori = Kategori::all();
        return view('tambah-barang', compact('kategori'));
    }

    // Menyimpan barang baru
    public function store(Request $request)
    {
        // Validasi input dari pengguna
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        // Cek apakah nama barang sudah ada
        if (Barang::where('nama_barang', $validatedData['nama_barang'])->exists()) {
            return back()->withErrors(['nama_barang' => 'Nama barang sudah ada.']);
        }

        // Ambil ID barang terakhir
        $lastBarang = Barang::orderBy('id_barang', 'desc')->first();
        $newIdNumber = $lastBarang ? ((int) substr($lastBarang->id_barang, 2) + 1) : 1;
        $newId = 'DB' . str_pad($newIdNumber, 6, '0', STR_PAD_LEFT);

        // Simpan barang baru
        Barang::create([
            'id_barang' => $newId,
            'nama_barang' => $validatedData['nama_barang'],
            'id_kategori' => $validatedData['id_kategori'],
            'stok_barang' => 0,
            'harga_beli' => $validatedData['harga_beli'],
            'harga_jual' => $validatedData['harga_jual'],
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit barang
    public function edit($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $kategori = Kategori::all();
        return view('edit-barang', compact('barang', 'kategori'));
    }

    // Memperbarui barang
    public function update(Request $request, $id_barang)
    {
        // Validasi input dari pengguna
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        $barang = Barang::findOrFail($id_barang);

        // Cek apakah nama barang sudah ada, kecuali barang yang sedang diupdate
        if (Barang::where('nama_barang', $request->nama_barang)
            ->where('id_barang', '!=', $barang->id_barang)
            ->exists()) {
            return back()->withErrors(['nama_barang' => 'Nama barang sudah ada.']);
        }

        // Perbarui data barang
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'id_kategori' => $request->id_kategori,
            'harga_beli' => $request->harga_beli,
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

    // Mengecek stok barang
    public function cekStok()
    {
        $stokHampirHabis = Barang::where('stok_barang', '<', 10)->get();

        foreach ($stokHampirHabis as $barang) {
            $this->kirimNotifikasiWhatsApp($barang);
        }
    }

    // Fungsi pencarian barang
    public function searchBarang(Request $request)
    {
        $term = $request->get('term');
        $barang = Barang::where('nama_barang', 'LIKE', '%' . $term . '%')
            ->get(['id_barang', 'nama_barang']);
        
        return response()->json($barang);
    }

    // Fungsi untuk mengirim notifikasi WhatsApp
    public function kirimNotifikasiWhatsApp($barang)
    {
        $apiKey = "eV5dYotqwXQvvykMfvv9";
        $setting = Setting::first(); 

        $nomorTarget = $setting->whatsapp_number; 

        $pesan = "⚠️ Stok Barang Hampir Habis ⚠️\n\n" .
            "Nama Barang: {$barang->nama_barang}\n" .
            "Sisa Stok: {$barang->stok_barang}\n" .
            "Segera lakukan pemesanan ulang.";

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->post('https://api.fonnte.com/send', [
            'target' => $nomorTarget,
            'message' => $pesan,
            'countryCode' => '62',
        ]);

        if ($response->successful()) {
            echo "Notifikasi berhasil dikirim untuk barang {$barang->nama_barang}.\n";
        } else {
            $errorMessage = $response->json()['message'] ?? 'Tidak ada pesan error.';
            echo "Gagal mengirim notifikasi untuk barang {$barang->nama_barang}. Error: {$errorMessage}\n";
        }
    }
}
