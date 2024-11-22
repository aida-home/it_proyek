<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Styling dasar untuk layout */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Sidebar */
        .sidebar {
            height: 100%;
            width: 220px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #8A5E41;
            color: white;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 22px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            margin: 5px 0;
        }

        .sidebar a:hover {
            background-color: #a67450;
            border-radius: 5px;
        }

        /* Header */
        .header {
            background-color: #ffffff;
            height: 60px;
            margin-left: 220px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            border-bottom: 1px solid #ccc;
        }

        .header h1 {
            font-size: 18px;
            color: #8A5E41;
        }

        .logout-btn {
            background-color: transparent;
            border: none;
            color: #8A5E41;
            font-size: 16px;
            cursor: pointer;
        }

        .logout-btn:hover {
            color: red;
        }

        /* Content */
        .content {
            margin-left: 220px;
            padding: 20px;
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
            color: #8A5E41;
        }

        .card h3 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 16px;
            color: #555;
        }

        .card .more-info {
            margin-top: 10px;
            display: inline-block;
            color: #8A5E41;
            font-size: 14px;
            text-decoration: none;
            font-weight: bold;
        }

        .card .more-info:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Logo</h2>
        <a href="/dashboard">Dashboard</a>
        <a href="/pengguna">Pengguna</a>
        <a href="/supplier">Supplier</a>
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

    <div class="content">
        <div class="dashboard-cards">
            <div class="card">
                <h3>2</h3>
                <p>Pengguna</p>
                <a href="/pengguna" class="more-info">More info</a>
            </div>
            <div class="card">
                <h3>180</h3>
                <p>Data Barang</p>
                <a href="/barang" class="more-info">More info</a>
            </div>
            <div class="card">
                <h3>289</h3>
                <p>Barang Masuk</p>
                <a href="/barangmasuk" class="more-info">More info</a>
            </div>
            <div class="card">
                <h3>20</h3>
                <p>Kategori</p>
                <a href="/kategori" class="more-info">More info</a>
            </div>
            <div class="card">
                <h3>10</h3>
                <p>Supplier</p>
                <a href="/supplier" class="more-info">More info</a>
            </div>
            <div class="card">
                <h3>350</h3>
                <p>Transaksi</p>
                <a href="/transaksi" class="more-info">More info</a>
            </div>
            <div class="card">
                <h3>10</h3>
                <p>Laporan Penjualan</p>
                <a href="/laporan-penjualan" class="more-info">More info</a>
            </div>
        </div>
    </div>
    <footer>
        &copy; 2024 Situs Web Sederhana | <a href="#">Kebijakan Privasi</a>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>
</body>
</html>
