<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ time() }}">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Logo</h2>
        <a href="/dashboard">Dashboard</a>
        <a href="/pengguna">Pengguna</a>
        <a href="/suppliers">Supplier</a>
        <a href="/kategori">Kategori</a>
        <a href="/barang">Barang</a>
        <a href="/barangmasuk">Barang Masuk</a>
        <a href="/transaksi">Transaksi</a>
        <a href="/laporan-penjualan">Laporan</a>
    </div>

    <div class="header">
        <h1>Dashboard</h1>
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
