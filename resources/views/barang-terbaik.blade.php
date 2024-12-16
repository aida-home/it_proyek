<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Terbaik - SAW</title>
</head>
<body>
    <h1>Hasil Perhitungan Barang Terbaik (Metode SAW)</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Nilai Preferensi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangTerbaik as $barang)
            <tr>
                <td>{{ $barang['id_barang'] }}</td>
                <td>{{ $barang['nama_barang'] }}</td>
                <td>{{ number_format($barang['nilai_preferensi'], 4) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
