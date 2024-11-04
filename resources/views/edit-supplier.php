<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    <style>
        body {
            font-family: Roboto, sans-serif;
            background-color: #f9f4f4; /* Warna latar belakang pastel pink yang lembut */
            padding: 20px; /* Jarak internal untuk seluruh halaman */
        }

        h1 {
            text-align: center;
            color: #d5006d; /* Warna header */
        }

        .form-section {
            max-width: 400px; /* Lebar maksimal form */
            margin: auto; /* Form berada di tengah */
            padding: 20px;
            border: 1px solid #d5006d; /* Warna border form */
            border-radius: 8px;
            background-color: #ffffff; /* Warna latar belakang form */
        }

        /* Styling untuk input fields */
        input[type="text"], input[type="number"], input[type="date"] {
            width: calc(100% - 20px); /* Lebar penuh dikurangi padding */
            padding: 10px;
            margin-bottom: 20px; /* Jarak antar input field */
            border: 1px solid #ddd; /* Warna border input */
            border-radius: 5px;
        }

        /* Styling tombol simpan */
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white; /* Warna teks tombol */
            background-color: #ffb3c1; /* Warna tombol pink pastel */
            transition: background-color 0.3s ease; /* Transisi halus perubahan warna tombol */
            width: 100%; /* Lebar penuh untuk tombol */
        }

        /* Hover effect untuk tombol */
        .btn:hover {
            background-color: #ff80ab; /* Warna pink lebih gelap saat hover */
        }
    </style>
</head>
<body>
    <h1>Edit Supplier</h1>
    <div class="form-section">
        <h2>Edit Data Supplier</h2>
        <!-- Form untuk mengedit data supplier -->
        <form action="{{ route('suppliers.update', $supplier->id_supplier) }}" method="POST">
            @csrf
            @method('PUT') <!-- Menggunakan metode PUT untuk memperbarui data -->
            <!-- Input untuk nama supplier -->
            <input type="text" name="nama_supplier" value="{{ $supplier->nama_supplier }}" required>
            <!-- Input untuk nomor telepon supplier -->
            <input type="text" name="no_telp" value="{{ $supplier->no_telp }}" required>
            <!-- Input untuk alamat supplier -->
            <input type="text" name="alamat" value="{{ $supplier->alamat }}" required>
            <!-- Tombol untuk menyimpan perubahan -->
            <button type="submit" class="btn">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
