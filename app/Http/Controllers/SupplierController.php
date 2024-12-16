<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // Method untuk menampilkan semua data supplier
    public function index()
    {
        $suppliers = Supplier::all(); // Mengambil semua data supplier
        return view('supplier', compact('suppliers')); // Menampilkan view 'supplier' dengan data supplier
    }

    // Method untuk menampilkan form tambah supplier
    public function create()
    {
        return view('tambah-supplier'); // Mengarahkan ke view untuk menambah supplier
    }

    // Method untuk menyimpan data supplier baru
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

            $lastSupplier = Supplier::orderBy('id_supplier', 'desc')->first();
    
            if ($lastSupplier) {
                $lastIdNumber = (int) substr($lastSupplier->id_supplier, 1);
                $newIdNumber = $lastIdNumber + 1;
            } else {
                $newIdNumber = 1;
            }
    
            $newId = 'S' . str_pad($newIdNumber, 6, '0', STR_PAD_LEFT);

        // Membuat supplier baru dengan ID yang baru dibuat
        Supplier::create([
            'id_supplier' => $newId,
            'nama_supplier' => $request->nama_supplier,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    // Method untuk menampilkan form edit supplier
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id); // Mencari supplier berdasarkan ID
        return view('edit-supplier', compact('supplier')); // Menampilkan form edit supplier
    }

    // Method untuk memperbarui data supplier
    public function update(Request $request, $id)
    {
        // Validasi data yang diperbarui
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        // Mencari supplier berdasarkan ID dan memperbarui datanya
        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all()); // Update semua data yang di-request

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    // Method untuk menghapus supplier
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id); // Mencari supplier berdasarkan ID
        $supplier->delete(); // Menghapus data supplier

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
