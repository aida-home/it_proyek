<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class BarangController extends Controller
{
    // Menampilkan daftar barang (Index)
    public function index() 
    {
        $barang = Barang::all(); // Mengambil semua barang
        return view('barang', compact('barang')); // Mengirimkan data ke view
    }

    // Menampilkan form untuk membuat barang baru
    public function create()
    {
        $barangMasuk = BarangMasuk::all(); // Mengambil semua data Barang Masuk
        return view('tambah-barang', compact('barangMasuk')); // Mengirimkan data ke view
    }

    // Menyimpan barang baru dari Barang Masuk
    public function store(Request $request)
    {
        // Validasi ID Barang Masuk dan Harga Jual
        $validatedData = $request->validate([
            'id_barangmasuk' => 'required|exists:barang_masuk,id_barangmasuk',
            'harga_jual' => 'required|numeric|min:0', // Validasi harga jual
        ]);

        // Ambil data Barang Masuk berdasarkan ID
        $barangMasuk = BarangMasuk::findOrFail($validatedData['id_barangmasuk']);

        // Mendapatkan ID barang terakhir untuk membuat ID baru dengan prefix 'DB'
        $lastBarang = Barang::orderBy('id_barang', 'desc')->first();
        $newIdNumber = $lastBarang ? intval(substr($lastBarang->id_barang, 2)) + 1 : 1;
        $newId = 'DB' . str_pad($newIdNumber, 2, '0', STR_PAD_LEFT);

        // Buat data baru di tabel Barang
        $barang = new Barang();
        $barang->id_barang = $newId;
        $barang->nama_barang = $barangMasuk->nama_barang; // Mengambil dari Barang Masuk
        $barang->kategori = $barangMasuk->kategori; // Mengambil dari Barang Masuk
        $barang->stok_barang = $barangMasuk->jumlah_masuk; // Menggunakan jumlah masuk sebagai stok awal
        $barang->harga_jual = $validatedData['harga_jual']; // Mengambil dari input pengguna
        $barang->save();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan dari data Barang Masuk.');
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

        public function cekStok()
        {
            // Menggunakan stok_barang untuk query yang benar
            $stokHampirHabis = Barang::where('stok_barang', '<', 10)->get();
    
            foreach ($stokHampirHabis as $barang) {
                $this->kirimNotifikasiWhatsApp($barang);
            }
        }

        public function searchBarang(Request $request)
        {
            $term = $request->get('term'); // Ambil kata kunci pencarian
            $barang = Barang::where('nama_barang', 'LIKE', '%' . $term . '%') // Cari berdasarkan nama_barang
                            ->get(['id_barang', 'nama_barang']); // Ambil ID dan nama
        
            return response()->json($barang); // Kirim data dalam format JSON
        }
    
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



