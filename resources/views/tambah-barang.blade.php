<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <style>
        body {
            font-family: Roboto, sans-serif;
            background-color: #f9f4f4; /* Pastel pink background color */
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #8A5E41; /* Header color */
        }

        .form-section {
            max-width: 400px; /* Limit form width */
            margin: auto; /* Center form */
            padding: 20px;
            border: 1px solid #8A5E41; /* Border color */
            border-radius: 8px;
            background-color: #ffffff; /* Form background color */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow */
        }

        input[type="text"], input[type="number"] {
            width: 100%; /* Full-width inputs */
            padding: 10px;
            margin-bottom: 15px; /* Spacing between inputs */
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            background-color: #fff;
            box-sizing: border-box;
        }

        .btn-save {
            padding: 12px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            background-color: #8A5E41; /* Save button color */
            transition: background-color 0.3s ease;
            width: 100%; /* Full-width button */
            font-size: 16px;
            text-align: center;
            margin-bottom: 10px;
        }

        .btn-save:hover {
            background-color: #7A4B31; /* Hover color */
        }

        .btn {
            background-color: #8A5E41; /* Brown for 'Back' button */
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

        .btn-cancel {
            background-color: #d50000; /* Cancel button color */
        }

        .btn-cancel:hover {
            background-color: #a70000; /* Hover color for cancel button */
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block; /* Label above input */
            color: #8A5E41; /* Label text color */
        }
    </style>
</head>
<body>
    <h1>Tambah Barang</h1>
    <div class="form-section">
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" placeholder="Nama Barang" required>

            <label for="kategori">Kategori</label>
            <input type="text" name="kategori" id="kategori" placeholder="Kategori" required>

            <label for="stok_barang">Stok Barang</label>
            <input type="number" name="stok_barang" id="stok_barang" placeholder="Stok Barang" required min="0">

            <label for="harga_jual">Harga Jual</label>
            <input type="number" name="harga_jual" id="harga_jual" placeholder="Harga Jual" required min="0" step="0.01">

            <button type="submit" class="btn-save">Simpan</button>
        </form>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('barang.index') }}" class="btn">Kembali ke Daftar Barang</a>
    </div>
</body>
</html>
