<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard','Pengguna', 'Kategori', 'Supplier', 'Barang', 'Barang Masuk', 'Transaksi', 'Laporan Penjualan', 'Tambah Pengguna', 'Ubah Pengguna', 'Tambah Supplier', 
        'Ubah Supplier', 'Tambah Kategori', 'Ubah Kategori', 'Tambah Barang', 'Ubah Barang', 'Tambah Barang Masuk', 'Ubah Barang Masuk', 'Tambah Transaksi', 'Detail Transaksi')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/font/css/all.min.css') }}">
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
            <li><a href="/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="/pengguna"><i class="fas fa-users"></i> Pengguna</a></li>

            <!-- Data Master -->
            <li class="has-submenu">
                <a href="#" class="submenu-toggle"><i class="fas fa-cogs"></i> Data Master</a>
                <ul class="submenu">
                    <li><a href="/suppliers"><i class="fas fa-truck"></i> Supplier</a></li>
                    <li><a href="/kategori"><i class="fas fa-tags"></i> Kategori</a></li>
                    <li><a href="/barangmasuk"><i class="fas fa-box"></i> Barang Masuk</a></li>
                </ul>
            </li>
            <li><a href="/barang"><i class="fas fa-cube"></i> Barang</a></li>
            <li><a href="/transaksi"><i class="fas fa-exchange-alt"></i> Transaksi</a></li>
            <li><a href="/laporan-penjualan"><i class="fas fa-chart-line"></i> Laporan</a></li>
        </ul>
    </div>

    <!-- Header -->
    <div class="header">
        <h1>@yield('header', 'Dashboard', 'Pengguna', 'Kategori', 'Supplier', 'Barang', 'Barang Masuk', 'Transaksi', 'Laporan Penjualan', 'Tambah Pengguna', 'Ubah Pengguna', 'Tambah Supplier', 
        'Ubah Supplier', 'Tambah Kategori', 'Ubah Kategori', 'Tambah Barang', 'Ubah Barang', 'Tambah Barang Masuk', 'Ubah Barang Masuk', 'Tambah Transaksi', 'Detail Transaksi')</h1>
        <button class="logout-btn" onclick="document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
        <form id="logout-form" action="{{ route('logout.submit') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Konten Utama -->
    <div class="content">
        @yield('content')
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const submenuToggles = document.querySelectorAll('.submenu-toggle');
    
            submenuToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const parent = this.parentElement;
                    parent.classList.toggle('open');
                });
            });
        });
    </script>
</body>
</html>
