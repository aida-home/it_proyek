<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{
    // Menampilkan Form Tambah Transaksi
    public function create()
    {
        $barang = Barang::all();
        return view('create-transaksi', compact('barang'));
    }

    // Menyimpan Transaksi
    public function store(Request $request)
    {
        // Validasi input termasuk validasi tanggal
        $request->validate([
            'tanggal_transaksi' => 'required|date|before_or_equal:today',
            'barang.*.jumlah_beli' => 'required|integer|min:1',
        ], [
            'tanggal_transaksi.before_or_equal' => 'Tanggal transaksi tidak boleh lebih dari hari ini.',
            'barang.*.jumlah_beli.required' => 'Jumlah beli harus diisi.',
            'barang.*.jumlah_beli.min' => 'Jumlah beli harus lebih dari 0.',
        ]);

        // Generate ID Transaksi
        $lastTransaksi = Transaksi::orderBy('id_transaksi', 'desc')->first();

        $newIdNumber = $lastTransaksi 
            ? ((int) substr($lastTransaksi->id_transaksi, 2) + 1) 
            : 1;

        // Generate ID transaksi dengan format TR000001, TR000002, ...
        $newId = 'TR' . str_pad($newIdNumber, 6, '0', STR_PAD_LEFT);

        // Simpan transaksi
        $transaksi = new Transaksi;
        $transaksi->id_transaksi = $newId;
        $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
        $transaksi->total_pembayaran = 0; // Total pembayaran akan di-update nanti
        $transaksi->save();

        // Simpan detail transaksi
        foreach ($request->barang as $item) {
            $barang = Barang::find($item['id_barang']);

            if ($barang) {
                $detailTransaksi = new DetailTransaksi;
                // Generate ID detail transaksi dengan format DT000001, DT000002, ...
                $detailTransaksi->id_detail_transaksi = $this->generateNewIdDetailTransaksi();
                $detailTransaksi->id_transaksi = $newId;
                $detailTransaksi->id_barang = $barang->id_barang; // Simpan referensi
                $detailTransaksi->nama_barang = $barang->nama_barang; // Tetap tersimpan meskipun barang dihapus
                $detailTransaksi->harga_jual = $barang->harga_jual;
                $detailTransaksi->harga_beli = $barang->harga_beli;
                $detailTransaksi->jumlah_beli = $item['jumlah_beli'];
                $detailTransaksi->subtotal = $item['jumlah_beli'] * $barang->harga_jual;
                $detailTransaksi->save();

                // Kurangi stok barang
                $barang->stok_barang -= $detailTransaksi->jumlah_beli;
                $barang->save();

                // Update total transaksi
                $transaksi->total_pembayaran += $detailTransaksi->subtotal;
            }
        }

        // Simpan total transaksi
        $transaksi->save();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    // Menampilkan Semua Data Transaksi
    public function index()
    {
        $transaksi = Transaksi::with('detailTransaksi')->orderBy('tanggal_transaksi', 'desc')->get();
        return view('transaksi', compact('transaksi'));
    }

    // Menampilkan Detail Transaksi
    public function show($id)
    {
        $transaksi = Transaksi::with('detailTransaksi')->find($id);

        if (!$transaksi) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi tidak ditemukan.');
        }

        return view('detail-transaksi', compact('transaksi'));
    }

    // Fungsi untuk membuat ID detail transaksi baru
    private function generateNewIdDetailTransaksi()
    {
        $lastDetail = DetailTransaksi::orderBy('id_detail_transaksi', 'desc')->first();

        $newIdNumber = $lastDetail 
            ? ((int) substr($lastDetail->id_detail_transaksi, 2) + 1) 
            : 1;

        // Generate ID detail transaksi dengan format DT000001, DT000002, ...
        return 'DT' . str_pad($newIdNumber, 6, '0', STR_PAD_LEFT);
    }
}
