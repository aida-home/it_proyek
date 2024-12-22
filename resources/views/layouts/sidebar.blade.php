<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/font/css/all.min.css') }}">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Logo -->
        <div class="logo">
            <a href="/dashboard" class="logo-link">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Dashboard">
            </a>
        </div>

        <!-- Menu Navigasi -->
        <ul>
            <li><a href="/dashboard" class="menu-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="/pengguna" class="menu-link"><i class="fas fa-users"></i> Pengguna</a></li>

            <!-- Data Master -->
            <li class="has-submenu">
                <a href="#" class="submenu-toggle"><i class="fas fa-cogs"></i> Data Master</a>
                <ul class="submenu">
                    <li><a href="/suppliers" class="menu-link"><i class="fas fa-truck"></i> Supplier</a></li>
                    <li><a href="/kategori" class="menu-link"><i class="fas fa-tags"></i> Kategori</a></li>
                    <li><a href="/barangmasuk" class="menu-link"><i class="fas fa-box"></i> Barang Masuk</a></li>
                </ul>
            </li>
            <li><a href="/barang" class="menu-link"><i class="fas fa-cube"></i> Barang</a></li>
            <li><a href="/transaksi" class="menu-link"><i class="fas fa-exchange-alt"></i> Transaksi</a></li>
            <li><a href="/laporan-penjualan" class="menu-link"><i class="fas fa-chart-line"></i> Laporan</a></li>
            <li class="has-submenu">
                <a href="#" class="submenu-toggle"><i class="fas fa-star"></i> Barang Terbaik</a>
                <ul class="submenu">
                    <li><a href="/barang-terbaik" class="menu-link"><i class="fas fa-calculator"></i> Perhitungan</a></li>
                    <li><a href="/barang-rekomendasi" class="menu-link"><i class="fas fa-thumbs-up"></i> Rekomendasi</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- Header -->
    <div class="header">
        <h1>@yield('header', 'Dashboard')</h1>
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

    <!-- Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Menangani toggle submenu
            const submenuToggles = document.querySelectorAll(".submenu-toggle");

            submenuToggles.forEach(toggle => {
                toggle.addEventListener("click", function (e) {
                    e.preventDefault();
                    const parent = this.parentElement;

                    // Tutup semua submenu lainnya
                    document.querySelectorAll('.has-submenu').forEach(item => {
                        if (item !== parent) item.classList.remove('open');
                    });

                    // Toggle submenu saat ini
                    parent.classList.toggle('open');
                });
            });

            // Menandai menu aktif
            const menuLinks = document.querySelectorAll(".menu-link");
            const currentUrl = window.location.href;

            menuLinks.forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.add("active");

                    // Jika menu ini dalam submenu, buka parent-nya
                    const parent = link.closest('.has-submenu');
                    if (parent) parent.classList.add("open");
                }
            });
        });
    </script>
</body>

</html>
