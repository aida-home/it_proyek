<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffeef8; /* Warna latar belakang pink */
        }
        .container {
            margin-top: 50px;
            background-color: #ffffff; /* Warna latar belakang putih untuk isi */
            border-radius: 10px;
            padding: 20px; /* Padding di dalam container */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* Bayangan */
        }
        h1 {
            color: #ff80ab; /* Warna teks judul */
            font-size: 24px; /* Ukuran font judul */
            margin-bottom: 10px; /* Mengurangi jarak bawah */
        }
        h3 {
            color: #ff80ab; /* Warna teks subjudul */
            font-size: 20px; /* Ukuran font subjudul */
            margin-bottom: 15px; /* Mengurangi jarak bawah */
        }

        .table {
            border-collapse: collapse; /* Menghilangkan jarak antara border */
            width: 100%; /* Memastikan tabel penuh lebar */
        }
        .table th, .table td {
            text-align: justify; /* Mengatur isi kolom menjadi justify */
            padding: 10px; /* Padding pada sel tabel */
            border: 1px solid #ddd; /* Garis pembatas untuk tabel */
            background-color: #ffffff; /* Warna latar belakang sel tabel menjadi putih bersih */
        }
        .table th {
            background-color: #ff80ab; /* Warna latar belakang untuk header menjadi pink */
            color: white; /* Warna teks header */
        }
        .table tr:nth-child(even) {
            background-color: #f9f9f9; /* Warna latar belakang lebih putih untuk baris genap */
        }
        .btn-secondary {
            background-color: #ff80ab; /* Warna tombol */
            border: none; /* Hapus border default */
        }
        .btn-secondary:hover {
            background-color: #b02a6e; /* Warna saat hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Transaksi {{ $transaksi->id_transaksi }}</h1>

        <div class="mb-3">
            <strong>Tanggal Transaksi: </strong> {{ $transaksi->tanggal_transaksi }}
        </div>

        <h3>Barang yang Dibeli</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga Jual</th>
                    <th>Jumlah Beli</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_pembayaran = 0;
                @endphp
                @foreach($transaksi->detailTransaksi as $detail)
                <tr>
                    <td>{{ $detail->nama_barang }}</td>
                    <td>Rp {{ number_format($detail->harga_jual ?? 0, 2, ',', '.') }}</td>
                    <td>{{ $detail->jumlah_beli }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 2, ',', '.') }}</td>
                </tr>
                @php
                    $total_pembayaran += $detail->subtotal;
                @endphp
                @endforeach            
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Total Pembayaran</strong></td>
                    <td><strong>Rp {{ number_format($total_pembayaran, 2, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</body>

</html>
