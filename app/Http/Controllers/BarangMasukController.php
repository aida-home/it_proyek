<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    // Metode index untuk menampilkan seluruh data barang masuk.
    public function index()
    {
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
    

    // Metode update untuk memperbarui data barang masuk yang sudah ada di database.
    public function update(Request $request, $id)
    {
        // Validasi data yang diperbarui oleh user sebelum menyimpannya.
        $request->validate([
            'supplier' => 'required|string|max:255',        // Supplier harus berupa string dan diisi.
            'kategori'=>'required',
            'nama_barang'=>'required',
            'tgl_masuk' => 'required|date',                 // Tanggal masuk harus berupa format tanggal dan diisi.
            'jumlah_masuk' => 'required|integer',           // Jumlah masuk harus berupa bilangan bulat dan diisi.
            'harga_beli' => 'required|numeric',             // Harga beli harus berupa angka dan diisi.
        ]);

        // Mengambil data barang berdasarkan id.
        $barang = BarangMasuk::findOrFail($id);

        // Memperbarui data barang dengan data baru dari request.
        $barang->update($request->all());

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
