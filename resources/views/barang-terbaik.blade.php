<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Terbaik - SAW</title>
</head>
<body>
    <h1>Langkah-Langkah Perhitungan Barang Terbaik (Metode SAW)</h1>

    <!-- 1. Data Awal -->
    <h2>1. Data Awal</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah Terjual</th>
                <th>Harga Jual</th>
                <th>Profit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangData as $barang)
            <tr>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->jumlah_terjual }}</td>
                <td>{{ $barang->harga_jual }}</td>
                <td>{{ $barang->profit }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 2. Normalisasi -->
    <h2>2. Normalisasi</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah Terjual (Benefit)</th>
                <th>Harga Jual (Cost)</th>
                <th>Profit (Benefit)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangNormalisasi as $barang)
            <tr>
                <td>{{ $barang['nama_barang'] }}</td>
                <td>{{ number_format($barang['jumlah_terjual'], 4) }}</td>
                <td>{{ number_format($barang['harga_jual'], 4) }}</td>
                <td>{{ number_format($barang['profit'], 4) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 3. Nilai Preferensi -->
    <h2>3. Nilai Preferensi</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Nilai Preferensi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangTerbaik as $barang)
            <tr>
                <td>{{ $barang['nama_barang'] }}</td>
                <td>{{ number_format($barang['nilai_preferensi'], 4) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Bobot -->
    <h2>Bobot Kriteria</h2>
    <ul>
        <li>Jumlah Terjual: {{ $bobot['jumlah_terjual'] }}</li>
        <li>Harga Jual: {{ $bobot['harga_jual'] }}</li>
        <li>Profit: {{ $bobot['profit'] }}</li>
    </ul>
</body>
</html>
