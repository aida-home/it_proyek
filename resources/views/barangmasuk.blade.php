<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Mendefinisikan karakter encoding dokumen -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur tampilan responsif di berbagai perangkat -->
    <title>Barang Masuk</title> <!-- Judul halaman -->
    
    <style>
        /* Reset margin dan padding untuk seluruh elemen */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styling untuk body: font, warna latar, dan padding */
        body {
            font-family: Roboto, sans-serif;
            background-color: #f9f4f4; /* Warna latar light pastel pink */
            padding: 20px;
        }

        /* Styling untuk judul utama (h1) */
        h1 {
            text-align: center;
            color: #d5006d; /* Warna teks header */
            font-size: 28px;
            margin-bottom: 20px;
        }

        /* Flexbox untuk membagi halaman menjadi dua bagian: tabel dan form */
        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap; /* Supaya tetap rapi jika layar kecil */
        }

        /* Styling untuk setiap section: tabel dan form */
        .table-section, .form-section {
            flex: 1;
            padding: 20px;
            border: 1px solid #d5006d; /* Warna border */
            border-radius: 8px;
            background-color: #fff; /* Warna latar setiap section */
        }

        /* Styling untuk subjudul (h2) di tiap section */
        h2 {
            color: #4e4e4e;
            margin-bottom: 15px;
            font-size: 24px;
        }

        /* Styling untuk tabel: lebar penuh dan border collapse */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffeef8; /* Warna latar tabel */
        }

        /* Border untuk tabel, header, dan data */
        table, th, td {
            border: 1px solid #ddd;
        }

        /* Styling untuk sel header dan sel data */
        th, td {
            padding: 8px;
            text-align: left;
            font-size: 14px;
            white-space: nowrap; /* Agar teks tidak terpotong ke baris berikutnya */
            overflow: hidden; /* Teks yang terlalu panjang tersembunyi */
            text-overflow: ellipsis; /* Tanda '...' jika teks terlalu panjang */
        }

        /* Styling untuk header tabel */
        th {
            background-color: #ff80ab; /* Warna latar header tabel */
            color: white; /* Warna teks header tabel */
        }

        /* Styling untuk input form dan dropdown */
        input[type="text"], input[type="number"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            font-size: 14px;
            appearance: none; /* Menghilangkan default arrow pada beberapa browser */
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        /* Styling tambahan untuk dropdown */
        select {
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="gray" d="M7 10l5 5 5-5z"/></svg>') no-repeat right center;
            background-size: 10px;
            background-position-x: 95%;
            padding-right: 30px; /* Tambahkan ruang untuk ikon dropdown */
        }

        /* Efek ketika input atau dropdown difokuskan */
        select:focus, input:focus {
            outline: none;
            border-color: #ff80ab; /* Warna saat fokus */
        }

        /* Styling umum untuk tombol */
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            transition: background-color 0.3s ease, transform 0.2s;
            width: 100%;
            text-decoration: none;
        }

        /* Warna tombol edit */
        .btn-edit {
            background-color: #ffb3c1; /* Warna pink sedikit lebih gelap untuk tombol edit */
        }

        /* Warna tombol hapus */
        .btn-delete {
            background-color: #d50000; /* Warna merah untuk tombol hapus */
        }

        /* Efek hover pada semua tombol */
        .btn:hover {
            background-color: #ff80ab; /* Warna pink lebih gelap saat hover */
            transform: scale(1.05); /* Efek perbesaran saat hover */
        }

        /* Styling untuk container tombol aksi */
        .action-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    <h1>Barang Masuk</h1> <!-- Judul halaman -->
    <div class="container"> <!-- Container utama yang membagi halaman menjadi tabel dan form -->
        
        <!-- Bagian Tabel Barang Masuk -->
        <div class="table-section">
            <h2>Daftar Barang Masuk</h2> <!-- Subjudul untuk tabel -->
            <table>
                <thead>
                    <tr>
                        <th>ID Barang Masuk</th>
                        <th>Supplier</th>
                        <th>Nama Barang</th>
                        <th>Tanggal Masuk</th>
                        <th>Jumlah Masuk</th>
                        <th>Harga Beli</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Looping data barang masuk -->
                    @foreach ($barangMasuk as $barang)
                        <tr
                            <!-- Menampilkan ID Barang dengan padding 0 di depan jika kurang dari 2 digit -->
                            <td>{{ str_pad($barang->id_barangmasuk, 2, '0', STR_PAD_LEFT) }}</td>
                            <!-- Menampilkan nama supplier -->
                            <td>{{ $barang->supplier }}</td>
                            <td>{{  $barang->nama_barang }}</td>
                            <!-- Menampilkan tanggal masuk -->
                            <td>{{ $barang->tgl_masuk }}</td>
                            <!-- Menampilkan jumlah barang masuk -->
                            <td>{{ $barang->jumlah_masuk }}</td>
                            <!-- Menampilkan harga beli dengan format rupiah -->
                            <td>Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <!-- Tombol edit barang masuk -->
                                    <a href="{{ route('barangmasuk.edit', $barang->id_barangmasuk) }}" class="btn btn-edit">
                                        Edit
                                    </a>
                                    <!-- Form untuk menghapus barang masuk -->
                                    <form action="{{ route('barangmasuk.destroy', $barang->id_barangmasuk) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete" onclick="return confirm('Anda Yakin ingin menghapus data ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>            
        </div>

        <!-- Bagian Form Tambah Barang Masuk -->
        <div class="form-section">
            <h2>Tambah Barang Masuk</h2> <!-- Subjudul untuk form -->
            <form action="{{ route('barangmasuk.create') }}" method="POST">
                @csrf
                <!-- Dropdown pilihan supplier -->
                <select name="supplier" required>
                    <option value="">Pilih Supplier</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id_supplier }}">{{ $supplier->nama_supplier }}</option>
                    @endforeach
                </select>
                <!-- Input tanggal masuk -->
                <input type="date" name="tgl_masuk" required>
                <!-- Input jumlah barang masuk -->
                <input type="text" name="nama_barang" placeholder="Nama Barang" required>
                <!-- Input jumlah barang masuk -->
                <input type="number" name="jumlah_masuk" placeholder="Jumlah Masuk" required>
                <!-- Input harga beli -->
                <input type="number" name="harga_beli" placeholder="Harga Beli" required>
                <!-- Tombol simpan -->
                <button type="submit" class="btn" style="background-color: #ffb3c1;">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>