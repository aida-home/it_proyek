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
        $tanggalTransaksi = $request->tanggal_transaksi;
        $day = date('d', strtotime($tanggalTransaksi)); 
        $month = date('m', strtotime($tanggalTransaksi)); 
        $year = date('y', strtotime($tanggalTransaksi)); 

        if ($lastTransaksi) {
            $lastIdNumber = (int) substr($lastTransaksi->id_transaksi, 2, 2);
            $newIdNumber = str_pad($lastIdNumber + 1, 2, '0', STR_PAD_LEFT);
        } else {
            $newIdNumber = '01';
        }
        $newId = 'TR' . $newIdNumber . $day . $month . $year;

        // Simpan transaksi
        $transaksi = new Transaksi;
        $transaksi->id_transaksi = $newId;
        $transaksi->tanggal_transaksi = $tanggalTransaksi;
        $transaksi->total_pembayaran = 0; // Total pembayaran akan di-update nanti
        $transaksi->save();

        // Simpan detail transaksi
        foreach ($request->barang as $item) {
            $barang = Barang::where('id_barang', $item['id_barang'])->first();

            // Pastikan data barang ditemukan
            if ($barang) {
                $detailTransaksi = new DetailTransaksi;
                $detailTransaksi->id_detail_transaksi = $this->generateNewIdDetailTransaksi();
                $detailTransaksi->id_transaksi = $newId;
                $detailTransaksi->id_barang = $barang->id_barang;
                $detailTransaksi->nama_barang = $barang->nama_barang;
                $detailTransaksi->harga_jual = $barang->harga_jual;
                
                // Pastikan jumlah_beli valid
                if (isset($item['jumlah_beli']) && $item['jumlah_beli'] > 0) {
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
        }

        // Simpan total transaksi
        $transaksi->save();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    // Menampilkan Semua Data Transaksi
    public function index()
    {
        $transaksi = Transaksi::with('detailTransaksi')->get();
        return view('transaksi', compact('transaksi'));
    }

    // Fungsi untuk membuat ID detail transaksi baru
    private function generateNewIdDetailTransaksi()
    {
        $lastDetail = DetailTransaksi::orderBy('id_detail_transaksi', 'desc')->first();
        if ($lastDetail) {
            $lastIdNumber = (int) substr($lastDetail->id_detail_transaksi, 2, 2);
            $newIdNumber = str_pad($lastIdNumber + 1, 2, '0', STR_PAD_LEFT);
        } else {
            $newIdNumber = '01';
        }

        return 'DT' . $newIdNumber;
    }

    // Menampilkan Detail Transaksi
    public function show($id)
    {
        // Mengambil transaksi beserta detail transaksi
        $transaksi = Transaksi::with('detailTransaksi')->find($id);

        // Cek apakah transaksi ditemukan
        if (!$transaksi) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi tidak ditemukan');
        }

        // Menampilkan halaman detail transaksi
        return view('detail-transaksi', compact('transaksi'));
    }
}
