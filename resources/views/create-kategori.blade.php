<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ time() }}">
</head>
<body>
<div class="form-container">
            <h2>Tambah Data Kategori</h2>
            <form action="/create-kategori" method="POST">
                @csrf
                <div class="table-section"> 
                <div class="form-group">
                    <input type="text" name="nama_kategori" placeholder="Masukkan Nama Kategori" required>
                            <!-- Menampilkan pesan error jika ada -->
                </div>
            @error('nama_kategori')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
                <button type="submit" class="save-btn">Simpan</button> <!-- Ubah warna tombol simpan menjadi coklat -->
            </form>
        </div>
    </div>
</body>
</html>