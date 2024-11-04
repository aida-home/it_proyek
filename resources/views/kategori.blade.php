<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kategori</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f9f4f4; /* Warna latar light pastel pink */
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
        color: #d5006d; /* Warna teks h2 */
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
        background-color: #ff80ab; /* Warna latar header tabel */
        color: white;
    }
    
    input[type="text"] {
        width: calc(100% - 24px); /* Mengatur lebar input agar tidak keluar dari batas */
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        color: #333;
        background-color: #ffeef8; /* Warna latar input */
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: border-color 0.3s ease;
    }
    
    input[type="text"]:focus {
        border-color: #ff80ab; /* Warna saat fokus */
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
        background-color: #ffb3c1; /* Warna pink untuk tombol Edit */
        margin-right: 5px; /* Menambahkan sedikit margin kanan */
    }
    
    .edit-btn:hover {
        background-color: #ff80ab; /* Pink lebih gelap saat hover */
    }
    
    .delete-btn {
        background-color: #d50000; /* Merah untuk tombol Delete */
    }
    
    .delete-btn:hover {
        background-color: #c9302c; /* Merah lebih gelap saat hover */
    }
    
    .save-btn {
        background-color: #ff80ab; /* Pink untuk tombol Simpan */
    }
    
    .save-btn:hover {
        background-color: #ff1493; /* Pink lebih gelap saat hover */
    }
    
    .form-group {
        margin-bottom: 20px; /* Menambahkan margin bawah untuk grup form */
    }
</style> 
</head>
<body>
    <h1 style="text-align: center; font-size: 30px; margin-top: 40px;">Kategori</h1>
    <div class="container">
        <div class="table-container">
            <h2>Data Kategori</h2>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th> <!-- Kolom Aksi -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->id_kategori }}</td>
                        <td>{{ $item->nama_kategori }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="/edit-kategori/{{$item->id_kategori}}" style="text-decoration: none;"> <!-- Menonaktifkan garis bawah -->
                                <button class="edit-btn">Ubah</button>
                            </a>
                            <!-- Tombol Delete -->
                            <form action="/delete-kategori/{{$item->id_kategori}}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Apakah yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="form-container">
            <h2>Tambah Data Kategori</h2>
            <form action="/create-kategori" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="nama_kategori" placeholder="Masukkan Nama Kategori" required>
                </div>
                <button type="submit" class="save-btn">Simpan</button> <!-- Ubah warna tombol simpan menjadi coklat -->
            </form>
        </div>
    </div>
</body>
</html>
