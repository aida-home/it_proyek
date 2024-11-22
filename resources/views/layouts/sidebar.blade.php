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
        <nav>
            <ul>
                <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('/pengguna') }}">Pengguna</a></li>
                <li><a href="{{ url('/suppliers') }}">Supplier</a></li>
                <li><a href="{{ url('/kategori') }}">Kategori</a></li>
                <li><a href="{{ url('/barang') }}">Barang</a></li>
                <li><a href="{{ url('/barangmasuk') }}">Barang Masuk</a></li>
                <li><a href="{{ url('/transaksi') }}">Transaksi</a></li>
                <li><a href="{{ url('/laporan-penjualan') }}">Laporan</a></li>
            </ul>
        </nav>
    </div>

    <!-- Konten Utama -->
    <div class="content">
        @yield('content')
    </div>
</body>
</html>
