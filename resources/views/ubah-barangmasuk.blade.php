<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Barang Masuk</title>
    <style>
        body {
            font-family: Roboto, sans-serif;
            background-color: #f9f4f4; /* Warna latar pastel pink */
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #d5006d; /* Warna teks header */
        }

        .form-section {
            max-width: 400px; /* Membatasi lebar maksimal form */
            margin: auto; /* Form berada di tengah */
            padding: 20px;
            border: 1px solid #d5006d; /* Warna border */
            border-radius: 8px;
            background-color: #ffffff; /* Warna latar form */
        }

        input[type="text"], input[type="number"], input[type="date"], select {
            width: calc(100% - 20px); /* Lebar penuh minus padding */
            padding: 10px;
            margin-bottom: 20px; /* Jarak antara field */
            border: 1px solid #ddd; /* Warna border input */
            border-radius: 5px;
            font-size: 14px;
            background-color: #fff;
        }

        select {
            appearance: none; /* Menghilangkan panah default dropdown */
            -webkit-appearance: none; /* Untuk Safari */
        }

        select:focus {
            outline: none;
            border-color: #ff80ab; /* Warna border saat fokus */
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            background-color: #ffb3c1; /* Warna tombol pastel pink */
            transition: background-color 0.3s ease;
            width: 100%; /* Tombol selebar form */
        }

        .btn:hover {
            background-color: #ff80ab; /* Warna tombol saat hover */
        }
    </style>
</head>
<body>
    <h1>Ubah Barang Masuk</h1> <!-- Judul halaman -->
    <div class="form-section">
        <!-- Form untuk mengubah data barang masuk -->
        <form action="{{ route('barangmasuk.update', $barang->id_barangmasuk) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Dropdown untuk memilih supplier -->
            <select name="supplier" required>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id_supplier }}" {{ $supplier->id_supplier == $barang->supplier ? 'selected' : '' }}>
                        {{ $supplier->nama_supplier }}
                    </option>
                @endforeach
            </select>
            <!-- Input tanggal masuk -->
            <input type="date" name="tgl_masuk" value="{{ $barang->tgl_masuk }}" required>
            <!-- Input jumlah barang masuk -->
            <input type="number" name="jumlah_masuk" value="{{ $barang->jumlah_masuk }}" placeholder="Jumlah Masuk" required>
            <!-- Input harga beli -->
            <input type="number" name="harga_beli" value="{{ $barang->harga_beli }}" placeholder="Harga Beli" required>
            <!-- Tombol untuk memperbarui data -->
            <button type="submit" class="btn" style="background-color: #ffb3c1;">Perbarui</button>
        </form>
    </div>
</body>
</html>