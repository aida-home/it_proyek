<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard','Pengguna', 'Kategori', 'Supplier', 'Barang', 'Barang Masuk', 'Transaksi', 'Laporan Penjualan', 'Tambah Pengguna', 'Ubah Pengguna', 'Tambah Supplier', 
        'Ubah Supplier', 'Tambah Kategori', 'Ubah Kategori', 'Tambah Barang', 'Ubah Barang', 'Tambah Barang Masuk', 'Ubah Barang Masuk', 'Tambah Transaksi', 'Detail Transaksi')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ time() }}">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <a href="/dashboard">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Dashboard">
            </a>
        </div>
    
        <ul>
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/pengguna">Pengguna</a></li>
            <li><a href="/suppliers">Supplier</a></li>
            <li><a href="/kategori">Kategori</a></li>
            <li><a href="/barang">Barang</a></li>
            <li><a href="/barangmasuk">Barang Masuk</a></li>
            <li><a href="/transaksi">Transaksi</a></li>
            <li><a href="/laporan-penjualan">Laporan</a></li>
        </ul>
    </div>

    <!-- Header -->
    <div class="header">
        <h1>@yield('header', 'Dashboard', 'Pengguna', 'Kategori', 'Supplier', 'Barang', 'Barang Masuk', 'Transaksi', 'Laporan Penjualan', 'Tambah Pengguna', 'Ubah Pengguna', 'Tambah Supplier', 
        'Ubah Supplier', 'Tambah Kategori', 'Ubah Kategori', 'Tambah Barang', 'Ubah Barang', 'Tambah Barang Masuk', 'Ubah Barang Masuk', 'Tambah Transaksi', 'Detail Transaksi')</h1>
        <button class="logout-btn" onclick="document.getElementById('logout-form').submit();">Logout</button>
        <form id="logout-form" action="{{ route('logout.submit') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Konten Utama -->
    <div class="content">
        @yield('content')
    </div>
</body>
</html>
