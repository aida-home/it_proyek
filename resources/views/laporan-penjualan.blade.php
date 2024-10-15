<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>
<body>
    <div class="container">
        <h1>Laporan Penjualan</h1>
        <form action="{{ route('laporan-penjualan') }}" method="GET">
            <label for="start_date">Tanggal Mulai:</label>
            <input type="date" name="start_date" id="start_date" value="{{ $startDate }}">
            <label for="end_date">Tanggal Selesai:</label>
            <input type="date" name="end_date" id="end_date" value="{{ $endDate }}">
            <button type="submit">Tampilkan</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah Beli</th>
                    <th>Harga Satuan</th>
                    <th>Total Penjualan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporanPenjualan as $item)
                    <tr>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->jumlah_beli }}</td>
                        <td>{{ number_format($item->harga_jual, 2, ',', '.') }}</td>
                        <td>{{ number_format($item->total_penjualan, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Total Penjualan: {{ number_format($totalPenjualan, 2, ',', '.') }}</h3>
    </div>
</body>
</html>
