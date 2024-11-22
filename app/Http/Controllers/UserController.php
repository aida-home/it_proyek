<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'username' => ['required', 'min:3', 'max:10'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'max:10'],
        ]);
    
        // Menyimpan data user baru
        User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'user', // Default role
        ]);
    
        // Arahkan ke halaman login setelah registrasi
        return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
    
    // Menampilkan form login
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
