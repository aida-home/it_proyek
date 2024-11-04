<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Models\Supplier; // Import Supplier model
=======
use App\Models\Supplier;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
>>>>>>> main

class BarangMasukController extends Controller
{
    // Metode index untuk menampilkan seluruh data barang masuk.
    public function index()
    {
<<<<<<< HEAD
        // Mengambil semua data barang masuk dengan relasi supplier
        $barangMasuk = BarangMasuk::with('supplier')->get();
        $suppliers = Supplier::all(); // Ambil semua supplier
    
        // Mengirim data barangMasuk dan suppliers ke view 'barangmasuk'
        return view('barangmasuk', compact('barangMasuk', 'suppliers'));
    }
    

    // Metode create untuk menampilkan form tambah barang masuk.
    public function create()
    {
        $suppliers = Supplier::all(); // Ambil semua supplier
        return view('tambah-barangmasuk', compact('suppliers')); // Arahkan ke tampilan tambah-barangmasuk
    }

    // Metode store untuk menambah barang masuk baru ke database.
    public function store(Request $request)
    {
        // Validasi data yang dimasukkan oleh user sebelum menyimpannya.
        $request->validate([
            'supplier' => 'required|exists:suppliers,id_supplier', // Pastikan supplier yang dipilih ada di database
            'nama_barang' => 'required|string|max:255',
            'tgl_masuk' => 'required|date|before_or_equal:today',
            'jumlah_masuk' => 'required|integer',
            'harga_beli' => 'required|numeric',
        ], [
            'tgl_masuk.before_or_equal'       
=======
        // Mengambil semua data BarangMasuk dengan relasi Kategori dan Supplier
        $barangMasuk = BarangMasuk::with('supplier')->get(); 
        $suppliers = Supplier::all();
    
        // Mengirim data ke view
        return view('barangmasuk', compact('barangMasuk', 'suppliers'));
    }
    
    


    // Metode create untuk menambah barang masuk baru ke database.
    public function create(Request $request)
    {
        // Validasi data yang dimasukkan oleh user sebelum menyimpannya.
        $request->validate([
            'nama_barang'=>'required',
            'tgl_masuk' => 'required|date',
            'jumlah_masuk' => 'required|integer',
            'harga_beli' => 'required|integer',
            'supplier' => 'required|exists:suppliers,id_supplier', // Pastikan supplier yang dipilih ada di database
>>>>>>> main
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
        $newId = 'BM' . str_pad($newIdNumber, 2, '0', STR_PAD_LEFT);
    
        // Menyimpan data barang masuk yang valid ke database.
        BarangMasuk::create([
            'id_barangmasuk' => $newId,  // Set ID kustom
<<<<<<< HEAD
            'supplier' => $request->supplier, // Simpan ID supplier
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
        // Mengambil data barang berdasarkan id
        $barang = BarangMasuk::findOrFail($id);
        $suppliers = Supplier::all(); // Ambil semua supplier
    
        // Mengirim data barang dan suppliers ke view 'ubah-barangmasuk'
        return view('ubah-barangmasuk', compact('barang', 'suppliers'));
    }
=======
            'nama_barang'=>$request->nama_barang,
            'tgl_masuk' => $request->tgl_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'harga_beli' => $request->harga_beli,
            'supplier' => $request->supplier, // Simpan ID supplier
        ]);
    
        // Mengarahkan kembali ke halaman daftar barang masuk dengan pesan sukses.
        return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil ditambahkan dengan ID: ' . $newId);
    }
    
// Metode edit untuk menampilkan data barang yang akan diedit berdasarkan id.
public function edit($id)
{
    // Mengambil data barang berdasarkan id
    $barang = BarangMasuk::findOrFail($id);
    $suppliers = Supplier::all(); // Ambil semua supplier

    // Mengirim data barang dan suppliers ke view 'ubah-barangmasuk'
    return view('ubah-barangmasuk', [
        'barang' => $barang,
        'suppliers' => $suppliers,
    ]);
}
    
>>>>>>> main

    // Metode update untuk memperbarui data barang masuk yang sudah ada di database.
    public function update(Request $request, $id)
    {
        // Validasi data yang diperbarui oleh user sebelum menyimpannya.
        $request->validate([
<<<<<<< HEAD
            'supplier' => 'required|exists:suppliers,id_supplier',        // Supplier harus valid
            'nama_barang' => 'required|string|max:255',                   // Nama barang harus valid
            'tgl_masuk' => 'required|date',                               // Tanggal masuk harus valid
            'jumlah_masuk' => 'required|integer',                         // Jumlah masuk harus valid
            'harga_beli' => 'required|numeric',                           // Harga beli harus valid
=======
            'supplier' => 'required|string|max:255',        // Supplier harus berupa string dan diisi.
            'kategori'=>'required',
            'nama_barang'=>'required',
            'tgl_masuk' => 'required|date',                 // Tanggal masuk harus berupa format tanggal dan diisi.
            'jumlah_masuk' => 'required|integer',           // Jumlah masuk harus berupa bilangan bulat dan diisi.
            'harga_beli' => 'required|numeric',             // Harga beli harus berupa angka dan diisi.
>>>>>>> main
        ]);

        // Mengambil data barang berdasarkan id.
        $barang = BarangMasuk::findOrFail($id);

        // Memperbarui data barang dengan data baru dari request.
<<<<<<< HEAD
        $barang->update([
            'supplier' => $request->supplier,
            'nama_barang' => $request->nama_barang,
            'tgl_masuk' => $request->tgl_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'harga_beli' => $request->harga_beli,
        ]);
=======
        $barang->update($request->all());
>>>>>>> main

        // Mengarahkan kembali ke halaman daftar barang masuk dengan pesan sukses.
        return redirect()->route('barangmasuk.index')->with('success', 'Barang berhasil diperbarui.');
    }

    // Metode destroy untuk menghapus data barang masuk dari database.
    public function destroy($id)
    {
        // Mengambil data barang berdasarkan id, atau mengembalikan error 404 jika tidak ditemukan.
        $barang = BarangMasuk::findOrFail($id);

        // Menghapus data barang dari database.
        $barang->delete();

        // Mengarahkan kembali ke halaman daftar barang masuk dengan pesan sukses.
        return redirect()->route('barangmasuk.index')->with('success', 'Barang berhasil dihapus.');
    }
}
