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

    public function store(Request $request)
    {
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
        $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
        $transaksi->total_pembayaran = 0; // Total pembayaran akan di-update nanti
        $transaksi->save();
        
        // Simpan detail transaksi
        foreach ($request->barang as $item) {
            // Ambil detail barangmasuk berdasarkan id_barang
            $barang = Barang::where('id_barang', $item['id_barang'])->first();
    
            // Pastikan data barang ditemukan
            if ($barang) {
                $detailTransaksi = new DetailTransaksi;
                $detailTransaksi->id_detail_transaksi = $this->generateNewIdDetailTransaksi();
                $detailTransaksi->id_transaksi = $newId;
                $detailTransaksi->id_barang = $barang->id_barang; // Pastikan ini mengacu pada objek barang
                $detailTransaksi->nama_barang = $barang->nama_barang; // Ambil nama_barang dari database
                $detailTransaksi->harga_jual = $barang->harga_jual; // Pastikan Anda menetapkan harga_jual
                // Pastikan 'jumlah_beli' ada
                if (isset($item['jumlah_beli']) && $item['jumlah_beli'] > 0) {
                    $detailTransaksi->jumlah_beli = $item['jumlah_beli'];
                    $detailTransaksi->subtotal = $item['jumlah_beli'] * $barang->harga_jual; // Hitung subtotal
                    $detailTransaksi->save();
                    
                    // Kurangi stok barang
                    $barang->stok -= $detailTransaksi->jumlah_beli;
                    $barang->save();
    
                    // Update total transaksi
                    $transaksi->total_pembayaran += $detailTransaksi->subtotal; // Update total pembayaran
                } else {
                    return back()->withErrors(['jumlah_beli' => 'Jumlah beli tidak valid.']);
                }
            }
        }
    
        $transaksi->save();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    // Menampilkan Semua Data Transaksi
    public function index()
    {
        $transaksi = Transaksi::with('detailTransaksi')->get();
        return view('transaksi', compact('transaksi')); // Ganti 'transaksi.index' dengan 'transaksi'
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
