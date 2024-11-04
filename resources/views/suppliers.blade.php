<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Supplier</title>
    <style>
        /* Reset margin dan padding untuk semua elemen */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Roboto, sans-serif;
            background-color: #f9f4f4; /* Latar belakang pastel pink */
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #d5006d; /* Warna teks header */
            font-size: 28px;
            margin-bottom: 20px; /* Jarak bawah header */
        }

        /* Container untuk membagi form dan tabel */
        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap; /* Agar tampil rapi di layar kecil */
        }

        .table-section, .form-section {
            flex: 1; /* Flex untuk mengatur lebar */
            padding: 20px;
            border: 1px solid #d5006d; /* Warna border */
            border-radius: 8px;
            background-color: #fff; /* Latar belakang putih */
        }

        h2 {
            color: #4e4e4e;
            margin-bottom: 15px;
            font-size: 24px;
        }

        table {
            width: 100%; /* Lebar penuh tabel */
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffeef8; /* Warna latar belakang tabel */
        }

        /* Pengaturan border dan tampilan tabel */
        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
            font-size: 14px; /* Ukuran teks tabel */
            white-space: nowrap; /* Menghindari teks terpotong */
            overflow: hidden;
            text-overflow: ellipsis;
        }

        th {
            background-color: #ff80ab; /* Warna header tabel */
            color: white;
        }

        /* Styling untuk input form */
        input[type="text"], input[type="number"], input[type="date"] {
            width: 100%; /* Lebar penuh input */
            padding: 10px;
            margin-bottom: 15px; /* Jarak bawah antar input */
            border: 1px solid #ddd; /* Border input */
            border-radius: 5px;
        }

        /* Styling tombol umum */
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            transition: background-color 0.3s ease, transform 0.2s; /* Animasi transisi warna dan ukuran */
            width: 100%; /* Lebar penuh tombol */
            text-decoration: none; /* Hilangkan garis bawah pada tombol link */
        }

        /* Warna tombol */
        .btn-edit {
            background-color: #ffb3c1; /* Pink untuk tombol edit */
        }

        .btn-delete {
            background-color: #d50000; /* Merah untuk tombol hapus */
        }

        /* Efek hover untuk tombol */
        .btn:hover {
            background-color: #ff80ab; /* Warna pink lebih gelap saat hover */
            transform: scale(1.05); /* Sedikit memperbesar tombol saat hover */
        }

        .action-buttons {
            display: flex;
            gap: 10px; /* Jarak antara tombol */
        }
    </style>
</head>
<body>
    <h1>Data Supplier</h1>
    <div class="container">
        <!-- Bagian tabel data supplier -->
        <div class="table-section">
            <h2>Daftar Supplier</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Supplier</th>
                        <th>Nama Supplier</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th> <!-- Kolom aksi untuk tombol ubah dan hapus -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Looping untuk menampilkan data supplier -->
                    @foreach ($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->id_supplier }}</td>
                            <td>{{ $supplier->nama_supplier }}</td>
                            <td>{{ $supplier->no_telp }}</td>
                            <td>{{ $supplier->alamat }}</td>
                            <td class="action-buttons">
                                <!-- Tombol untuk mengedit supplier -->
                                <a href="{{ route('suppliers.edit', $supplier->id_supplier) }}" class="btn btn-edit">Ubah</a>
                                <!-- Form untuk menghapus supplier -->
                                <form action="{{ route('suppliers.destroy', $supplier->id_supplier) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Bagian form untuk menambahkan supplier baru -->
        <div class="form-section">
            <h2>Tambah Supplier</h2>
            <form action="{{ route('suppliers.store') }}" method="POST">
                @csrf
                <!-- Input nama supplier -->
                <input type="text" name="nama_supplier" placeholder="Nama Supplier" required>
                <!-- Input nomor telepon supplier -->
                <input type="text" name="no_telp" placeholder="No. Telepon" required>
                <!-- Input alamat supplier -->
                <input type="text" name="alamat" placeholder="Alamat" required>
                <!-- Tombol untuk menyimpan data supplier -->
                <button type="submit" class="btn" style="background-color: #ffb3c1;">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>