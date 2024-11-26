<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Transaksi;

class PenggunaController extends Controller
{

    // Menampilkan semua pengguna
    public function index()
    {
        $pengguna = Pengguna::all(); // Mengambil semua data pengguna
        return view('pengguna', compact('pengguna')); // Mengirim data ke view
    }

    // Menampilkan formulir untuk menambah pengguna
    public function create()
    {
        return view('tambah-pengguna'); // Mengirim tampilan untuk menambah pengguna
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:pengguna,username'],
            'nama_pengguna' => 'required|string|max:255',
            'no_telepon' => 'required|integer|max:15',
            'password' => 'required|string|min:8',
        ]);

        // Membuat ID pengguna baru dengan prefix 'P'
        $lastPengguna = Pengguna::orderBy('id_pengguna', 'desc')->first();
        $newIdNumber = $lastPengguna ? intval(substr($lastPengguna->id_pengguna, 1)) + 1 : 1;
        $newId = 'P' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT); // Menghasilkan ID seperti P001, P002, dst.

        // Membuat pengguna baru
        Pengguna::create([
            'id_pengguna' => $newId,
            'nama_pengguna' => $request->nama_pengguna,
            'no_telepon' => $request->no_telepon,
            'username' => $request->username,
            'password' => bcrypt($request->password), // Hash password
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // Menampilkan formulir untuk mengedit pengguna
    public function edit($id_pengguna)
    {
        $pengguna = Pengguna::findOrFail($id_pengguna); // Ambil data berdasarkan ID
        return view('edit-pengguna', compact('pengguna'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id_pengguna)
    {
        // Validasi data
        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'no_telepon' => 'required|integer|max:15',
            'username' => 'required|string|max:255|unique:pengguna,username,' . $id_pengguna . ',id_pengguna',
        ]);

        $pengguna = Pengguna::findOrFail($id_pengguna);
        $pengguna->update($request->except('password'));

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $pengguna->update(['password' => bcrypt($request->password)]);
        }

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    // Menghapus pengguna
    public function destroy($id_pengguna)
    {
        $pengguna = Pengguna::findOrFail($id_pengguna);
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (Auth::attempt($credentials)) {
            // Login berhasil
            return redirect()->route('dashboard');
        }

        // Login gagal
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    // Proses logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function dashboard()
    {
        // Hitung data dari model
        $penggunaCount = Pengguna::count();
        $barangCount = Barang::count();
        $barangMasukCount = BarangMasuk::count();
        $kategoriCount = Kategori::count();
        $supplierCount = Supplier::count();
        $transaksiCount = Transaksi::count();
        $laporanPenjualanCount = Transaksi::distinct('id')->count(); // Contoh logika laporan

        // Kirim data ke view
        return view('dashboard', compact(
            'penggunaCount',
            'barangCount',
            'barangMasukCount',
            'kategoriCount',
            'supplierCount',
            'transaksiCount',
            'laporanPenjualanCount'
        ));
    }
}
