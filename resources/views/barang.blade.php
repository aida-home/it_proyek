<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Barang</title>
    <style>
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .subtitle {
            font-size: 20px;
            color: #333;
            padding-bottom: 10px;
            border-bottom: 2px solid #ccc;
            margin-bottom: 0; 
        }

        .btn {
            background-color: #8A5E41; /* Warna coklat untuk tombol */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #7A4B31; /* Warna coklat gelap saat hover */
        }

        .btn-delete {
            background-color: #d9534f; /* Warna merah untuk tombol hapus */
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #a70000; /* Warna merah gelap saat hover */
        }

        .btn-edit {
            background-color: #f0ad4e; /* Warna oranye untuk tombol edit */
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-edit:hover {
            background-color: #ec971f; /* Warna oranye gelap saat hover */
        }

        .box {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #8A5E41; /* Warna coklat untuk header tabel */
            color: white;
            text-align: center; /* Menengahkan teks header */
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            color: white;
            background-color: #28a745;
        }
    </style>
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Barang')

    @section('header', 'Barang')

    @section('content')
    <div class="container">
        <div class="box">
            <!-- Tampilkan pesan sukses jika ada -->
            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif
            
            <!-- Tombol tambah barang -->
            <a href="{{ route('barang.create') }}" class="btn">Tambah Barang</a>
            <table>
                <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok Barang</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $barang)
                    <tr>
                        <td>{{ $barang->id_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori }}</td>
                        <td>{{ $barang->stok_barang }}</td>
                        <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td> <!-- Format harga jual dengan dua angka desimal dan awalan Rp -->
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('barang.edit', $barang->id_barang) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('barang.destroy', $barang->id_barang) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach             
                </tbody>                
            </table>
        </div>
    </div>
    @endsection
</body>
</html>
