<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Dashboard')
    
    @section('header', 'Dashboard')
    
    @section('content')
    
    <div class="dashboard-cards">
        <div class="card">
            <div class="card-content">
                <div class="text">
                    <h3>Pengguna</h3>
                    <p>{{ $penggunaCount }}</p>
                </div>
                <div class="icon"></div>
            </div>
            <a href="/pengguna" class="more-info">More info</a>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="text">
                    <h3>Barang</h3>
                    <p>{{ $barangCount }}</p>
                </div>
                <div class="icon"></div>
            </div>
            <a href="/barang" class="more-info">More info</a>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="text">
                    <h3>Barang Masuk</h3>
                    <p>{{ $barangMasukCount }}</p>
                </div>
                <div class="icon"></div>
            </div>
            <a href="/barangmasuk" class="more-info">More info</a>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="text">
                    <h3>Kategori</h3>
                    <p>{{ $kategoriCount }}</p>
                </div>
                <div class="icon"></div>
            </div>
            <a href="/kategori" class="more-info">More info</a>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="text">
                    <h3>Supplier</h3>
                    <p>{{ $supplierCount }}</p>
                </div>
                <div class="icon"></div>
            </div>
            <a href="/Supplier" class="more-info">More info</a>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="text">
                    <h3>Transaksi</h3>
                    <p>{{ $transaksiCount }}</p>
                </div>
                <div class="icon"></div>
            </div>
            <a href="/transaksi" class="more-info">More info</a>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="text">
                    <h3>Laporan Penjualan</h3>
                    <p>{{ $laporanPenjualanCount }}</p>
                </div>
                <div class="icon"></div>
            </div>
            <a href="/laporan-penjualan" class="more-info">More info</a>
        </div>
    </div>
    
    @endsection    
</body>
</html>
