<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // Menampilkan form pengaturan nomor WhatsApp
    public function index()
    {
        $setting = Setting::first(); // Mengambil setting pertama
        return view('settings', compact('setting'));
    }

    // Memperbarui nomor WhatsApp
    public function update(Request $request)
    {
        $request->validate([
            'whatsapp_number' => 'required|numeric|min:10',
        ]);

        $setting = Setting::first(); // Mengambil setting pertama
        $setting->update([
            'whatsapp_number' => $request->whatsapp_number,
        ]);

        return redirect()->route('dashboard')->with('success', 'Nomor Target Notifikasi berhasil diperbarui.');
    }
}

