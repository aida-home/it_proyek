<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Masuk</title>
    <style>
        body {
            font-family: Roboto, sans-serif;
            background-color: #f9f4f4; /* Warna latar pastel pink */
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #8A5E41; /* Warna header */
        }

        .form-section {
            max-width: 400px; /* Membatasi lebar maksimal form */
            margin: auto; /* Form berada di tengah */
            padding: 20px;
            border: 1px solid #8A5E41; /* Warna border */
            border-radius: 8px;
            background-color: #ffffff; /* Warna latar form */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Memberikan bayangan */
        }

        input[type="text"], input[type="number"], input[type="date"], select {
            width: 100%; /* Lebar penuh untuk input dan select */
            padding: 10px;
            margin-bottom: 15px; /* Jarak antar elemen input */
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            background-color: #fff;
            box-sizing: border-box; /* Agar padding tidak memengaruhi lebar */
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

        .form-group {
            margin-bottom: 20px; /* Jarak antar form group */
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block; /* Agar label di atas input */
            color: #8A5E41; /* Warna teks label */
        }
    </style>
</head>
<body>
    <h1>Tambah Barang Masuk</h1>
    <div class="form-section">
        <form action="{{ route('barangmasuk.create') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="supplier">Supplier</label>
                <select name="supplier" id="supplier" required>
                    <option value="">Pilih Supplier</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id_supplier }}">{{ $supplier->nama_supplier }}</option>
                    @endforeach
                </select>

                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" required>
                    @foreach ($kategori as $kategori)
                        <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" placeholder="Nama Barang" required>
            </div>

            <div class="form-group">
                <label for="tgl_masuk">Tanggal Masuk</label>
                <input type="date" name="tgl_masuk" id="tgl_masuk" max="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="jumlah_masuk">Jumlah Masuk</label>
                <input type="number" name="jumlah_masuk" id="jumlah_masuk" placeholder="Jumlah Masuk" required>
            </div>

            <div class="form-group">
                <label for="harga_beli">Harga Beli</label>
                <input type="number" name="harga_beli" id="harga_beli" placeholder="Harga Beli" required>
            </div>

            <!-- Tombol Simpan -->
            <button type="submit" class="btn">Simpan</button>
            
            <!-- Tombol Batal -->
            <button type="button" onclick="location.href='{{ route('barangmasuk.index') }}'" class="btn btn-cancel">Batal</button>
        </form>
    </div>
</body>
</html>
