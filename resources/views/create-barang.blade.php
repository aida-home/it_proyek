<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Barang</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: space-between;
            margin: 50px;
            gap: 20px; /* Jarak antara tabel dan form */
        }
        .table-container {
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-height: 80vh; /* Mengatur tinggi maksimum untuk tabel agar tidak memenuhi layar */
            overflow-y: auto; /* Menambahkan scrollbar vertikal saat konten melebihi batas tinggi */
            flex: 2; /* Membuat container tabel lebih besar */
        }
        .form-container {
            flex: 1; /* Membuat container form lebih kecil */
            max-width: 400px; /* Mengatur lebar maksimum untuk form */
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-height: 200px;
        }
        h2 {
            text-align: justify;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #4e3629;
        }
        table {
            width: 100%;
            border-collapse: collapse; /* Menghindari jarak ganda antar border */
            margin-bottom: 20px;
            border: 1px solid #ddd; /* Garis pembatas untuk tabel */
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd; /* Garis bawah pada setiap sel */
            border-right: 1px solid #ddd; /* Garis kanan pada setiap sel */
        }
        th:last-child, td:last-child {
            border-right: none; /* Menghilangkan garis kanan pada kolom terakhir */
        }
        th {
            background-color: #8b5a2b; /* Coklat lebih tua untuk header tabel */
            color: white;
        }
        input[type="text"] {
            width: calc(100% - 24px); /* Mengatur lebar input agar tidak keluar dari batas */
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
            background-color: #f9f9f9;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus {
            border-color: #c19a6b;
            outline: none;
        }
        button {
            padding: 8px 16px; /* Menambahkan padding horizontal */
            font-size: 14px; /* Ukuran font tombol */
            font-weight: bold;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px; /* Memberikan jarak di atas tombol */
            display: inline-block; /* Menghilangkan garis biru */
            vertical-align: middle; /* Memastikan tombol sejajar secara vertikal */
        }
        .edit-btn {
            background-color: #f0ad4e; /* Kuning untuk tombol Edit */
            margin-right: 5px; /* Menambahkan sedikit margin kanan */
        }
        .edit-btn:hover {
            background-color: #e0a83b; /* Kuning lebih gelap saat hover */
        }
        .delete-btn {
            background-color: #d9534f; /* Merah untuk tombol Delete */
        }
        .delete-btn:hover {
            background-color: #c9302c; /* Merah lebih gelap saat hover */
        }
        .save-btn {
            background-color: #8b5a2b; /* Coklat untuk tombol Simpan */
        }
        .save-btn:hover {
            background-color: #7a4b2a; /* Coklat lebih gelap saat hover */
        }
        .form-group {
            margin-bottom: 20px; /* Menambahkan margin bawah untuk grup form */
        }
    </style>    
</head>
<body>
    <div class="container">
        <h2>Tambah Barang</h2>
    
        <!-- Menampilkan pesan sukses jika barang berhasil ditambahkan -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <!-- Form untuk menambahkan barang -->
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
    
            <!-- Dropdown untuk memilih nama barang dari tabel barang_masuks -->
            <div class="form-group">
                <label for="nama_barang">Nama Barang:</label>
                <select name="nama_barang" id="nama_barang" class="form-control">
                    <option value="">Pilih Nama Barang</option>
                    @foreach($barang_masuks as $barang)
                        <option value="{{ $barang->nama_barang }}">{{ $barang->nama_barang }}</option>
                    @endforeach
                </select>
                @error('nama_barang')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <!-- Input untuk stok (otomatis ditotal dari tabel barang_masuks) -->
            <div class="form-group">
                <label for="stok">Stok Barang:</label>
                <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok') }}" readonly>
            </div>
    
            <!-- Input untuk harga jual -->
            <div class="form-group">
                <label for="harga_jual">Harga Jual:</label>
                <input type="number" name="harga_jual" id="harga_jual" class="form-control" value="{{ old('harga_jual') }}">
                @error('harga_jual')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <!-- Tombol submit -->
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>