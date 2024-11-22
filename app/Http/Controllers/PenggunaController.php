<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

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
            'nama_pengguna' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'username' => 'required|string|max:255|unique:pengguna',
            'password' => 'required|string|min:8',
        ]);

        // Mendapatkan ID supplier terakhir untuk membuat ID baru dengan prefix 'SP'
        $lastPengguna = Pengguna::orderBy('id_pengguna', 'desc')->first();
        $newIdNumber = $lastPengguna ? intval(substr($lastPengguna->id_pengguna, 2)) + 1 : 1;
        $newId = 'P' . str_pad($newIdNumber, 2, '0', STR_PAD_LEFT);
        // Membuat pengguna baru
        Pengguna::create([
            'id_pengguna' => $newId,
            'nama_pengguna' => $request->nama_pengguna,
            'no_telepon' => $request->no_telepon,
            'username' => $request->username,
            'password' => bcrypt($request->password), // Meng-hash password
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.'); // Redirect dengan pesan sukses
    }

    // Menampilkan formulir untuk mengedit pengguna
    public function edit($id_pengguna)
    {
        $pengguna = Pengguna::findOrFail($id_pengguna);
        return view('edit-pengguna', compact('pengguna')); // Mengirim data pengguna ke view
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id_pengguna)
    {

        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'username' => 'required|string|max:255|unique:pengguna,username,' . $id_pengguna . ',id_pengguna', // tambahkan ID
        ]);
        

        $pengguna = Pengguna::findOrFail($id_pengguna); // Mengambil pengguna berdasarkan ID
        $pengguna->update($request->except('password')); // Memperbarui pengguna kecuali password

        // Mengupdate password jika diberikan
        if ($request->filled('password')) {
            $pengguna->update(['password' => bcrypt($request->password)]); // Meng-hash password
        }

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diperbarui.'); // Redirect dengan pesan sukses
    }

    // Menghapus pengguna
    public function destroy($id_pengguna)
    {
        $pengguna = Pengguna::findOrFail($id_pengguna); // Mengambil pengguna berdasarkan ID
        $pengguna->delete(); // Menghapus pengguna

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus.'); // Redirect dengan pesan sukses
    }
    public function showLoginForm()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'max:10'],
        ]);

        // Cek kredensial dan login
        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email yang anda masukkan salah.',
        ]);
    }

    // Proses logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // Menampilkan halaman dashboard
    public function dashboard()
    {
        // Pastikan bahwa hanya user yang sudah login yang bisa mengakses dashboard
        $user = Auth::user();
        return view('dashboard', [
            'username' => $user->username,
            'role' => $user->role,
        ]);
    }
}
