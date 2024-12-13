<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/font/css/all.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <div class="icon">
                        <i class="fas fa-users"></i> <!-- Icon Font Awesome -->
                    </div>
                </div>
                <a href="/pengguna" class="more-info">More info</a>
            </div>

            <div class="card">
                <div class="card-content">
                    <div class="text">
                        <h3>Barang</h3>
                        <p>{{ $barangCount }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-cube"></i> <!-- Icon Font Awesome -->
                    </div>
                </div>
                <a href="/barang" class="more-info">More info</a>
            </div>

            <div class="card">
                <div class="card-content">
                    <div class="text">
                        <h3>Barang Masuk</h3>
                        <p>{{ $barangMasukCount }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box-open"></i> <!-- Icon Font Awesome -->
                    </div>
                </div>
                <a href="/barangmasuk" class="more-info">More info</a>
            </div>

            <div class="card">
                <div class="card-content">
                    <div class="text">
                        <h3>Kategori</h3>
                        <p>{{ $kategoriCount }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i> <!-- Icon Font Awesome -->
                    </div>
                </div>
                <a href="/kategori" class="more-info">More info</a>
            </div>

            <div class="card">
                <div class="card-content">
                    <div class="text">
                        <h3>Supplier</h3>
                        <p>{{ $supplierCount }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-truck"></i> <!-- Icon Font Awesome -->
                    </div>
                </div>
                <a href="/suppliers" class="more-info">More info</a>
            </div>

            <div class="card">
                <div class="card-content">
                    <div class="text">
                        <h3>Transaksi</h3>
                        <p>{{ $transaksiCount }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exchange-alt"></i> <!-- Icon Font Awesome -->
                    </div>
                </div>
                <a href="/transaksi" class="more-info">More info</a>
            </div>
        </div>

        <div class="popular-items">
            <h3>Barang Populer RPS Collection Tahun ini</h3>
            <canvas id="popularChart"></canvas>
        </div>

        <script>
            var ctx = document.getElementById('popularChart').getContext('2d');
            var popularChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach ($barangPopuler as $item)
                            '{{ $item->nama_barang }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Total Terjual',
                        data: [
                            @foreach ($barangPopuler as $item)
                                {{ $item->total_terjual }},
                            @endforeach
                        ],
                        backgroundColor: '#8A5E41',
                        borderColor: '#8B4513',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    height: window.innerWidth < 768 ? 200 : 250 // Sesuaikan tinggi berdasarkan ukuran layar
                }
            });
        </script>
    @endsection
</body>

</html>
