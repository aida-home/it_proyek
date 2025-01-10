<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            </div>

            <!-- Tombol Ubah Nomor Target -->
            <div class="card">
                <div class="card-content">
                    <div class="text">
                        <h3>
                            @if ($setting && $setting->whatsapp_number)
                                Nomor tujuan notifikasi saat ini:
                                <br><br>
                                <strong>{{ $setting->whatsapp_number }}</strong>
                            @else
                                <span style="color: red;">Nomor belum diatur.</span>
                            @endif
                        </h3>
                    </div>
                </div>
                <a href="{{ route('settings.index') }}" class="btn btn-primary">
                    <button class="btn-edit">Ubah</button>
                </a>
            </div>
        </div>

        <div class="popular-items">
            <h4 style="text-align: center;">Barang Populer RPS Collection Tahun <span id="currentYear"></span></h4>
            <canvas id="popularChart"></canvas>
        </div>

        <script src="{{ asset('assets/js/custom.js') }}"></script>

        <script>
            //message with sweetalert
            @if (session('success'))
                Swal.fire({
                    icon: "success",
                    title: "BERHASIL",
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: "error",
                    title: "GAGAL!",
                    text: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif
        </script>

        <script>
            // Ambil tahun saat ini
            const currentYear = new Date().getFullYear();

            // Masukkan tahun ke elemen dengan ID 'currentYear'
            document.getElementById("currentYear").textContent = currentYear;
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
