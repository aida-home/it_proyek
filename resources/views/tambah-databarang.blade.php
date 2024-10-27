<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #8A5E41;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
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
            display: inline-block;
            text-align: center;
        }

        .btn:hover {
            background-color: #7A4B31;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #8A5E41;
            outline: none;
        }

        .btn-save {
            background-color: #8A5E41;
            color: white;
            padding: 12px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            font-size: 16px;
        }

        .btn-save:hover {
            background-color: #7A4B31;
        }

        .form-section {
            background-color: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            max-width: 600px; /* Max width for better layout */
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Tambah Barang</h1>

    <div class="form-section">
        <form action="{{ route('databarang.store') }}" method="POST">
            @csrf
            <input type="text" name="nama_barang" placeholder="Nama Barang" required>
            <input type="text" name="kategori" placeholder="Kategori" required>
            <input type="number" name="stok_barang" placeholder="Stok Barang" required min="0">
            <input type="number" name="harga_jual" placeholder="Harga Jual" required min="0" step="0.01">
            <button type="submit" class="btn-save">Simpan</button>
        </form>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('databarang.index') }}" class="btn">Kembali ke Daftar Barang</a>
    </div>
</body>
</html>