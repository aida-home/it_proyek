<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi</title>

    <style>
        /* Reset margin dan padding untuk seluruh elemen */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styling untuk body: font, warna latar, dan padding */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f4f4; /* Warna latar light pastel pink */
            padding: 20px;
        }

        /* Styling untuk judul utama (h1) */
        h1 {
            text-align: center;
            color: #d5006d; /* Warna teks header */
            font-size: 28px;
            margin-bottom: 20px;
        }

        /* Flexbox untuk membagi halaman menjadi dua bagian: tabel dan form */
        .container {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center; /* Pusatkan konten */
        }

        /* Styling untuk section: tabel */
        .table-section {
            width: 100%;
            max-width: 1200px; /* Lebar maksimum tabel */
            padding: 20px; /* Padding untuk tabel */
            border: 1px solid #d5006d; /* Warna border */
            border-radius: 8px;
            background-color: #fff; /* Warna latar section */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Bayangan untuk depth */
            margin-top: 20px; /* Jarak atas untuk section tabel */
            display: flex; /* Flex untuk layout tombol dan tabel */
            flex-direction: column; /* Mengatur tombol dan tabel dalam kolom */
        }

        /* Styling untuk subjudul (h2) di tiap section */
        h2 {
            color: #4e4e4e;
            margin-bottom: 15px;
            font-size: 24px;
        }

        /* Styling untuk tabel: lebar penuh dan border collapse */
        table {
            width: 100%; /* Tabel memanjang ke samping */
            border-collapse: collapse;
            margin-top: 20px; /* Jarak antara tombol dan tabel */
            background-color: #ffeef8; /* Warna latar tabel */
        }

        /* Border untuk tabel, header, dan data */
        table, th, td {
            border: 1px solid #ddd;
        }

        /* Styling untuk sel header dan sel data */
        th, td {
            padding: 12px; /* Padding untuk sel */
            text-align: left;
            font-size: 14px;
            white-space: nowrap; /* Agar teks tidak terpotong ke baris berikutnya */
            overflow: hidden; /* Teks yang terlalu panjang tersembunyi */
            text-overflow: ellipsis; /* Tanda '...' jika teks terlalu panjang */
        }

        /* Styling untuk header tabel */
        th {
            background-color: #ff80ab; /* Warna latar header tabel */
            color: white; /* Warna teks header tabel */
        }

        /* Styling untuk tombol */
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            transition: background-color 0.3s ease, transform 0.2s;
            text-decoration: none;
            background-color: #d5006d; /* Warna tombol utama */
            display: inline-block;
            margin-bottom: 10px; /* Jarak bawah tombol */
            align-self: flex-start; /* Memposisikan tombol di pinggir kiri */
        }

        /* Warna tombol edit */
        .btn-edit {
            background-color: #ffb3c1; /* Warna pink sedikit lebih gelap untuk tombol edit */
        }

        /* Warna tombol hapus */
        .btn-delete {
            background-color: #d50000; /* Warna merah untuk tombol hapus */
        }

        /* Efek hover pada semua tombol */
        .btn:hover {
            background-color: #ff80ab; /* Warna pink lebih gelap saat hover */
            transform: scale(1.05); /* Efek perbesaran saat hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Transaksi</h1>

        <div class="table-section">
            <!-- Link untuk menambahkan transaksi baru -->
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Tambah Transaksi</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $item)
                        <tr>
                            <td>{{ $item->id_transaksi }}</td>
                            <td>{{ $item->tanggal_transaksi }}</td>
                            <td>Rp {{ number_format($item->total_pembayaran, 2, ',', '.') }}</td>
                            <td>
                                <!-- Link untuk melihat detail transaksi -->
                                <a href="{{ route('transaksi.show', $item->id_transaksi) }}" class="btn btn-info">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
