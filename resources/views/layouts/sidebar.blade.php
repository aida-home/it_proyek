<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard', 'Pengguna', 'Kategori', 'Supplier', 'Barang', 'Barang Masuk', 'Transaksi', 'Laporan Penjualan', 'Tambah Pengguna', 'Ubah Pengguna', 'Tambah Supplier', 'Ubah Supplier', 'Tambah Kategori', 'Ubah Kategori', 'Tambah Barang', 'Ubah Barang', 'Tambah Barang Masuk', 'Ubah Barang Masuk', 'Tambah Transaksi', 'Detail Transaksi', 'Barang Terbaik')</title>
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
            <li><a href="/dashboard" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
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
            <li class="has-submenu">
                <a href="#" class="submenu-toggle"><i class="fas fa-star"></i> Barang Terbaik</a>
                <ul class="submenu">
                    <li><a href="/barang-terbaik"><i class="fas fa-calculator"></i> Perhitungan</a></li>
                    <li><a href="/barang-rekomendasi"><i class="fas fa-thumbs-up"></i>Rekomendasi</a></li>
                </ul>
            </li>
    </div>

    <!-- Header -->
    <div class="header">
        <h1>@yield('header', 'Dashboard', 'Pengguna', 'Kategori', 'Supplier', 'Barang', 'Barang Masuk', 'Transaksi', 'Laporan Penjualan', 'Tambah Pengguna', 'Ubah Pengguna', 'Tambah Supplier', 'Ubah Supplier', 'Tambah Kategori', 'Ubah Kategori', 'Tambah Barang', 'Ubah Barang', 'Tambah Barang Masuk', 'Ubah Barang Masuk', 'Tambah Transaksi', 'Detail Transaksi', 'Perhituangan SAW', 'Rekomendasi Barang')</h1>
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
            // Menangani toggle submenu
            const submenuToggles = document.querySelectorAll(".submenu-toggle");

            submenuToggles.forEach(toggle => {
                toggle.addEventListener("click", function(e) {
                    e.preventDefault();
                    const parent = this.parentElement;

                    // Tutup semua submenu lain
                    document.querySelectorAll('.has-submenu').forEach(item => {
                        if (item !== parent) item.classList.remove('open');
                    });

                    // Toggle submenu saat ini
                    parent.classList.toggle('open');
                });
            });

            // Menangani state menu aktif
            const menuLinks = document.querySelectorAll(".sidebar ul li a");
            menuLinks.forEach(link => {
                link.addEventListener("click", function() {
                    // Hapus class active dari semua link
                    menuLinks.forEach(item => item.classList.remove("active"));

                    // Tambahkan class active ke menu yang diklik
                    this.classList.add("active");
                });
            });
        });
    </script>
</body>

</html>
