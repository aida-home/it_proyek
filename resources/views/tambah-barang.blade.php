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
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #8A5E41;
            font-size: 48px; /* Ukuran lebih besar */
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-section {
            max-width: 400px; /* Membatasi lebar maksimal form */
            margin: auto; /* Form berada di tengah */
            padding: 20px;
            border: 1px solid #8A5E41; /* Warna border */
            border-radius: 8px;
            background-color: #ffffff; /* Warna latar form */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow */
        }

        label {
            font-weight: bold; /* Menebalkan teks label */
            margin-bottom: 5px; /* Jarak antara label dan input */
            display: block; /* Agar label berada di atas input */
        }

        input[type="text"], input[type="number"], input[type="date"] {
            width: calc(100% - 20px); /* Lebar penuh minus padding */
            padding: 10px;
            margin-bottom: 20px; /* Jarak antara field */
            border: 1px solid #ddd; /* Warna border input */
            border-radius: 5px;
        }

        .btn-save {
            padding: 12px 0; /* Menambahkan padding atas bawah pada tombol */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            background-color: #8A5E41; /* Warna tombol */
            transition: background-color 0.3s ease;
            width: 100%; /* Tombol selebar form */
            text-align: center;
            font-size: 16px;
            margin-bottom: 10px; /* Jarak antar tombol */
        }

        .btn-save:hover {
            background-color: #7A4B31; /* Warna tombol saat hover */
        }

        .btn {
            padding: 12px 0; /* Menambahkan padding atas bawah pada tombol */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            background-color: #8A5E41; /* Warna tombol */
            transition: background-color 0.3s ease;
            width: 100%; /* Tombol selebar form */
            text-align: center;
            font-size: 16px;
            margin-bottom: 10px; /* Jarak antar tombol */
        }

        .btn:hover {
            background-color: #7A4B31; /* Warna tombol saat hover */
        }

        .btn-cancel {
            background-color: #d50000; /* Warna merah untuk tombol cancel */
            /* width: 100%;  -- Dihapus dari sini untuk mencegah override */
        }

        .btn-cancel:hover {
            background-color: #a70000; /* Warna merah lebih gelap saat hover */
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
            
            <!-- Tombol Batal -->
            <button type="button" onclick="location.href='{{ route('barang.index') }}'" class="btn btn-cancel">Batal</button>
        </form>
    </div>
</body>
</html>