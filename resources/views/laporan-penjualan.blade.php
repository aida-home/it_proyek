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

        <div class="table-section">
            <form action="{{ route('laporan-penjualan.index') }}" method="GET">
                <label for="start_date">Tanggal awal:</label>
                <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" placeholder="">
                <label for="end_date">Tanggal akhir:</label>
                <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" placeholder="">                
                <button type="submit">Filter</button>
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
                </tr>
            </thead>
            <tbody>
                @foreach ($laporanPenjualan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->tanggal_transaksi)) }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->jumlah_beli }}</td>
                        <td>Rp {{ number_format($item->harga_jual, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->total_pendapatan, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Total Pendapatan: Rp{{ number_format($totalPendapatan, 2, ',', '.') }}</h3>
        @endsection
    </div>
</body>
</html>
