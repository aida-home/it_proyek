<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #8A5E41;
            font-size: 48px; /* Ukuran lebih besar */
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 20px;
            color: #333;
            padding-bottom: 10px;
            border-bottom: 2px solid #ccc; /* Garis bawah */
            margin-bottom: 0; /* Hapus margin bawah untuk sejajar dengan box */
        }

        .btn {
            background-color: #8A5E41;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #7A4B31;
        }

        .btn-delete {
            background-color: #d50000;
        }

        .btn-delete:hover {
            background-color: #a70000;
        }

        .btn-edit {
            background-color: #f0ad4e;
        }

        .btn-edit:hover {
            background-color: #ec971f;
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
            background-color: #f0f0f0;
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
    </style>
</head>
<body>
    <h1>Barang Masuk</h1>

    <div class="container">
        <div class="subtitle">Tabel Data Barang Masuk</div> <!-- Judul di dalam box dengan garis bawah -->
        <div class="box">
            <a href="{{ route('barangmasuk.create') }}" class="btn">Tambah Barang Masuk</a> <!-- Tombol Tambah -->
            <table>
                <thead>
                    <tr>
                        <th>ID Barang Masuk</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Supplier</th>
                        <th>Tanggal Masuk</th>
                        <th>Jumlah Masuk</th>
                        <th>Harga Beli</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangMasuk as $barang)
                        <tr>
                            <td>{{ str_pad($barang->id_barangmasuk, 2, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->kategori }}</td>
                            <td>{{ $barang->supplier }}</td>
                            <td>{{ $barang->tgl_masuk }}</td>
                            <td>{{ $barang->jumlah_masuk }}</td>
                            <td>Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('barangmasuk.edit', $barang->id_barangmasuk) }}" class="btn btn-edit">Edit</a>
                                    <form action="{{ route('barangmasuk.destroy', $barang->id_barangmasuk) }}" method="POST" style="display:inline;">
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
</body>
</html>
