<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Models\Supplier; 
use App\Models\Barang;

class BarangMasukController extends Controller
{
    // Metode index untuk menampilkan seluruh data barang masuk.
    public function index()
    {
        // Mengambil semua data barang masuk dengan relasi supplier
        $barangMasuk = BarangMasuk::with('supplier', 'kategori', 'barang')->get();
        $kategori = Kategori::all(); // Mengambil semua kategori
        $suppliers = Supplier::all(); // Ambil semua supplier
        $barang = Barang::all();
    
        // Mengirim data barangMasuk dan suppliers ke view 'barangmasuk'
        return view('barangmasuk', compact('kategori','barangMasuk', 'suppliers', 'barang'));
    }
    

    // Metode create untuk menampilkan form tambah barang masuk.
    public function create()
    {
        $suppliers = Supplier::all(); // Ambil semua supplier
        $kategori = Kategori::all(); 
        $barang = Barang::all();
        return view('tambah-barangmasuk', compact('kategori','suppliers', 'barang')); // Arahkan ke tampilan tambah-barangmasuk
    }
    
    // Metode store untuk menambah barang masuk baru ke database.
    public function store(Request $request)
    {
        // Validasi data yang dimasukkan oleh user sebelum menyimpannya.
        $request->validate([
            'supplier' => 'required|exists:suppliers,id_supplier', // Pastikan supplier yang dipilih ada di database
            'kategori' => 'required',
            'nama_barang' => 'required|string|max:255',
            'tgl_masuk' => 'required|date|before_or_equal:today',
            'jumlah_masuk' => 'required|integer',
            'kategori' => 'required',
            'harga_beli' => 'required|numeric',
        ], [
            'tgl_masuk.before_or_equal'       
        ]);
    
        // Mengambil data ID barang terakhir
        $lastBarang = BarangMasuk::orderBy('id_barangmasuk', 'desc')->first();
        
        // Logika untuk membuat ID baru
        if ($lastBarang) {
            $lastIdNumber = (int) substr($lastBarang->id_barangmasuk, 2); // Ambil nomor dari ID terakhir
            $newIdNumber = $lastIdNumber + 1; // Tambah 1 untuk ID baru
        } else {
            $newIdNumber = 1; // Jika belum ada data, mulai dari 1
        }
    
        // Format ID baru menjadi BM01, BM02, dst.
        $newId = 'BM' . str_pad($newIdNumber, 6, '0', STR_PAD_LEFT);
    
        // Menyimpan data barang masuk yang valid ke database.
        BarangMasuk::create([
            'id_barangmasuk' => $newId,  // Set ID kustom
            'supplier' => $request->supplier, // Simpan ID supplier
            'kategori' => $request->kategori, // Simpan ID supplier
            'nama_barang' => $request->nama_barang,
            'tgl_masuk' => $request->tgl_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'harga_beli' => $request->harga_beli,
        ]);
    
        // Mengarahkan kembali ke halaman daftar barang masuk dengan pesan sukses.
        return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil ditambahkan.');
    }
    
    // Metode edit untuk menampilkan data barang yang akan diedit berdasarkan id.
    public function edit($id)
    {
        // Mengambil satu data barang masuk berdasarkan id
        $barangMasuk = BarangMasuk::where('id_barangmasuk', $id)->firstOrFail();
    
        // Ambil semua data pendukung lainnya
        $suppliers = Supplier::all();
        $kategori = Kategori::all();
        $barang = Barang::all();
    
        // Mengarahkan ke view dengan data
        return view('ubah-barangmasuk', compact('barangMasuk', 'suppliers', 'kategori', 'barang'));
    }
    

    // Metode update untuk memperbarui data barang masuk yang sudah ada di database.
    public function update(Request $request, $id)
    {
        // Validasi data yang diperbarui oleh user sebelum menyimpannya.
        $request->validate([
            'supplier' => 'required|exists:suppliers,id_supplier',        // Supplier harus valid
            'kategori' => 'required',
            'nama_barang' => 'required|string|max:255',                   // Nama barang harus valid
            'tgl_masuk' => 'required|date',                               // Tanggal masuk harus valid
            'jumlah_masuk' => 'required|integer',                         // Jumlah masuk harus valid
            'harga_beli' => 'required|numeric',                           // Harga beli harus valid
        ]);

        // Mengambil data barang berdasarkan id.
        $barangMasuk = BarangMasuk::findOrFail($id);

        // Memperbarui data barang dengan data baru dari request.
        $barangMasuk->update([
            'supplier' => $request->supplier,
            'kategori' => $request->kategori,
            'nama_barang' => $request->nama_barang,
            'tgl_masuk' => $request->tgl_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'harga_beli' => $request->harga_beli,
        ]);

        // Mengarahkan kembali ke halaman daftar barang masuk dengan pesan sukses.
        return redirect()->route('barangmasuk.index')->with('success', 'Barang berhasil diperbarui.');
    }

    // Metode destroy untuk menghapus data barang masuk dari database.
    public function destroy($id)
    {
        // Mengambil data barang berdasarkan id, atau mengembalikan error 404 jika tidak ditemukan.
        $barangMasuk = BarangMasuk::findOrFail($id);

        // Menghapus data barang dari database.
        $barangMasuk->delete();

        // Mengarahkan kembali ke halaman daftar barang masuk dengan pesan sukses.
        return redirect()->route('barangmasuk.index')->with('success', 'Barang berhasil dihapus.');
    }
}
