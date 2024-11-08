<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9; /* Warna latar belakang */
            padding: 20px; /* Jarak internal untuk seluruh halaman */
        }

        h1 {
            text-align: center;
            color: #8A5E41; /* Warna header */
            font-size: 48px; /* Ukuran lebih besar */
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-section {
            max-width: 400px; /* Lebar maksimal form */
            margin: auto; /* Form berada di tengah */
            padding: 20px;
            border: 1px solid #8A5E41; /* Warna border */
            border-radius: 8px;
            background-color: #ffffff; /* Warna latar belakang form */
        }

        label {
            font-weight: bold; /* Menebalkan teks label */
            margin-bottom: 5px; /* Jarak antara label dan input */
            display: block; /* Agar label berada di atas input */
        }

        input[type="text"], input[type="number"], input[type="date"] {
            width: calc(100% - 20px); /* Lebar penuh minus padding */
            padding: 10px;
            margin-bottom: 20px; /* Jarak antar input field */
            border: 1px solid #ddd; /* Warna border input */
            border-radius: 5px;
        }

        .btn {
            padding: 12px 0; /* Menambahkan padding atas bawah pada tombol */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            background-color: #8A5E41; /* Warna tombol konsisten */
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
            background-color: #a70000; /* Warna merah untuk tombol batal */
        }
    </style>
</head>
<body>
    <h1>Edit Supplier</h1>
    <div class="form-section">
        <form action="{{ route('suppliers.update', $supplier->id_supplier) }}" method="POST">
        @csrf
        @method('PUT')

            <label for="nama_supplier">Nama Supplier</label>
            <input type="text" id="nama_supplier" name="nama_supplier" value="{{ $supplier->nama_supplier }}" required>
            
            <label for="no_telp">No. Telepon</label>
            <input type="text" id="no_telp" name="no_telp" value="{{ $supplier->no_telp }}" required>
            
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" value="{{ $supplier->alamat }}" required>
            
            <!-- Tombol untuk menyimpan perubahan -->
            <button type="submit" class="btn">Simpan Perubahan</button>
            
            <!-- Tombol untuk batal -->
            <button type="button" onclick="location.href='{{ route('suppliers.index') }}'" class="btn btn-cancel">Batal</button>
        </form>
    </div>
</body>
</html>
