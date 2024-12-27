<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <link href="{{ asset('assets/css/form.css') }}" rel="stylesheet"> <!-- Link ke form.css -->
</head>

<body>
    @extends('layouts.sidebar')

    @section('title', 'Tambah Kategori')

    @section('header', 'Tambah Kategori')

    @section('content')
        <div class="form-container">
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="table-section">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori" placeholder="Masukkan Nama Kategori"
                            required>
                        <!-- Menampilkan pesan error jika ada -->
                    </div>
                    @error('nama_kategori')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="save-btn">Simpan</button> <!-- Ubah warna tombol simpan menjadi coklat -->
                    <button type="button" onclick="location.href='{{ route('kategori.index') }}'" class="btn btn-cancel">Batal</button>
            </form>
        </div>
        </div>
    @endsection
</body>

</html>
