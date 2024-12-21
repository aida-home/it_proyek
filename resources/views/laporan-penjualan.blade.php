<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    @extends('layouts.sidebar')
    @section('title', 'Laporan Penjualan')

    @section('header', 'Laporan Penjualan')

    @section('content')

        <div class="summary-section">
            <div class="card">
                <h3><i class="fas fa-wallet"></i> Total Pendapatan</h3>
                <p>Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</p>
            </div>
            <div class="card">
                <h3><i class="fas fa-chart-line"></i> Total Profit</h3>
                <p>Rp{{ number_format($totalProfit, 0, ',', '.') }}</p>
            </div>
        </div>

    <div class="table-section">
            <form action="{{ route('laporan-penjualan.index') }}" method="GET">
                <label for="start_date">Tanggal :</label>
                <input type="date" name="start_date" id="start_date"
                    value="{{ $startDate ?? now()->startOfMonth()->format('Y-m-d') }}">
                <label for="end_date"> - </label>
                <input type="date" name="end_date" id="end_date"
                    value="{{ $endDate ?? now()->endOfMonth()->format('Y-m-d') }}">
                <button type="submit">Filter</button>
                <a href="{{ route('laporan-penjualan.export', ['start_date' => $startDate ?? now()->startOfMonth()->format('Y-m-d'), 'end_date' => $endDate ?? now()->endOfMonth()->format('Y-m-d')]) }}"
                    class="btn">Unduh Laporan</a>
            </form>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Terjual</th>
                        <th>Harga Satuan</th>
                        <th>Total Pendapatan</th>
                        <th>Profit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporanPenjualan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->tanggal_transaksi)) }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->jumlah_beli }}</td>
                            <td>Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->profit, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endsection
    </div>
</body>

</html>
