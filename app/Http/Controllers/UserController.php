<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth; // Perbaiki namespace Auth
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request) {
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required' // Perbaiki nama field
        ]);

        if (Auth::attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/beranda'); // Pindahkan redirect ke sini agar tidak terjadi redirect saat login gagal
        }

        return back()->withErrors([
            'loginname' => 'Login failed, please check your credentials.',
        ]);
    }

    public function logout() {
        Auth::logout();
        return redirect('/beranda');
    }

    public function register(Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:10'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'max:10'] // Pisahkan dengan benar
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        User::create($incomingFields); // Perbaiki metode menjadi create

        return 'Hello from my controller';
    }
}
