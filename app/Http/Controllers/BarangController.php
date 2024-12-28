<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Menampilkan daftar barang (Index)
    public function index()
    {
        // Mengambil semua barang beserta relasi kategori
        $barang = Barang::with('kategori')->get();
        return view('barang', compact('barang'));
    }

    // Menampilkan form untuk membuat barang baru
    public function create()
    {
        // Mengambil semua kategori untuk dropdown
        $kategori = Kategori::all();
        return view('tambah-barang', compact('kategori'));
    }

    // Menyimpan barang baru
    public function store(Request $request)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori', // Validasi kategori
            'stok_barang' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        // Membuat barang baru
        Barang::create([
            'id_barang' => 'DB' . str_pad(Barang::count() + 1, 6, '0', STR_PAD_LEFT), // Format ID otomatis
            'nama_barang' => $request->nama_barang,
            'id_kategori' => $request->id_kategori,
            'stok_barang' => $request->stok_barang,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    // Menampilkan form edit barang
    public function edit($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $kategori = Kategori::all(); // Ambil data kategori untuk dropdown
        return view('edit-barang', compact('barang', 'kategori'));
    }

    // Mengupdate barang
    public function update(Request $request, $id_barang)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori', // Validasi kategori
            'stok_barang' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        // Update barang berdasarkan ID
        $barang = Barang::findOrFail($id_barang);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'id_kategori' => $request->id_kategori,
            'stok_barang' => $request->stok_barang,
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
        // Menggunakan stok_barang untuk query yang benar
        $stokHampirHabis = Barang::where('stok_barang', '<', 10)->get();
    
        foreach ($stokHampirHabis as $barang) {
            $this->kirimNotifikasiWhatsApp($barang);
        }
    }

    // Fungsi pencarian barang
    public function searchBarang(Request $request)
    {
        $term = $request->get('term'); // Ambil kata kunci pencarian
        $barang = Barang::where('nama_barang', 'LIKE', '%' . $term . '%') // Cari berdasarkan nama_barang
                        ->get(['id_barang', 'nama_barang']); // Ambil ID dan nama
        
        return response()->json($barang); // Kirim data dalam format JSON
    }

    // Fungsi untuk mengirim notifikasi WhatsApp
    public function kirimNotifikasiWhatsApp($barang)
    {
        $apiKey = "eV5dYotqwXQvvykMfvv9"; // API key Fonnte
        $nomorTarget = "6283824320186"; // Nomor WhatsApp tujuan
    
        // Memastikan penggunaan nama kolom yang tepat
        $pesan = "⚠️ Stok Barang Hampir Habis ⚠️\n\n" .
                 "Nama Barang: {$barang->nama_barang}\n" .  // Gunakan nama_barang, bukan nama
                 "Sisa Stok: {$barang->stok_barang}\n" .   // Gunakan stok_barang, bukan stok
                "Segera lakukan pemesanan ulang.";
    
        // Mengirim request ke API Fonnte untuk mengirimkan WhatsApp
        $response = Http::withHeaders([
            'Authorization' => $apiKey
        ])->post('https://api.fonnte.com/send', [
            'target' => $nomorTarget,
            'message' => $pesan,
            'countryCode' => '62',
        ]);
    
        // Menangani hasil response dari API
        if ($response->successful()) {
            echo "Notifikasi berhasil dikirim untuk barang {$barang->nama_barang}.\n";
        } else {
            // Menampilkan pesan error jika gagal mengirim
            $errorMessage = $response->json()['message'] ?? 'Tidak ada pesan error.';
            echo "Gagal mengirim notifikasi untuk barang {$barang->nama_barang}. Error: {$errorMessage}\n";
        }
    }
}
