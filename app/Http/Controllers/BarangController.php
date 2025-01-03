<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Kategori; 

class BarangController extends Controller
{
    // Menampilkan daftar barang (Index)
    public function index()
    {
        $barang = Barang::with('kategori')->get(); // Muat relasi kategori
        return view('barang', compact('barang'));
    }
    
    // Menampilkan form untuk membuat barang baru
    public function create()
    {
        $kategori = Kategori::all();  // Ambil semua kategori
        return view('tambah-barang', compact('kategori'));  // Kirim ke view
    }
    
    public function store(Request $request)
    {
        // Validasi input dari pengguna
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori', // Validasi kategori yang dipilih
            'stok_barang' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0', // Validasi harga beli
            'harga_jual' => 'required|numeric|min:0', // Validasi harga jual
        ]);
    
        // Ambil ID barang terakhir
        $lastBarang = Barang::orderBy('id_barang', 'desc')->first();
    
        // Tentukan nomor ID berikutnya berdasarkan ID terakhir
        $newIdNumber = $lastBarang ? ((int) substr($lastBarang->id_barang, 2) + 1) : 1;
    
        // Format ID barang baru
        $newId = 'DB' . str_pad($newIdNumber, 6, '0', STR_PAD_LEFT);
    
        // Cek apakah ID barang yang dihasilkan sudah ada (meskipun ini kecil kemungkinannya)
        if (Barang::where('id_barang', $newId)->exists()) {
            return back()->withErrors(['id_barang' => 'Terjadi konflik dengan ID barang yang ada. Coba lagi.']);
        }
    
        // Simpan data barang baru
        Barang::create([
            'id_barang' => $newId,
            'nama_barang' => $validatedData['nama_barang'],
            'id_kategori' => $validatedData['id_kategori'], // ID kategori yang valid
            'stok_barang' => $validatedData['stok_barang'], // Stok barang
            'harga_beli' => $validatedData['harga_beli'], // Harga beli
            'harga_jual' => $validatedData['harga_jual'], // Harga jual
        ]);
    
        // Redirect ke halaman index barang dengan pesan sukses
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
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori', // Validasi kategori
            'stok_barang' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0', // Validasi harga_beli
            'harga_jual' => 'required|numeric|min:0'
        ]);

        $barang = Barang::findOrFail($id_barang);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'id_kategori' => $request->id_kategori, // Update kategori
            'stok_barang' => $request->stok_barang,
            'harga_beli' => $request->harga_beli, // Update harga_beli
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
