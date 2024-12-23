<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('assets/css/form.css') }}" rel="stylesheet"> <!-- Link ke form.css -->
    <title>Edit Barang</title>
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Ubah Barang')

    @section('header', 'Ubah Barang')

    @section('content')
    <div class="form-container"> <!-- Menambahkan class form-container -->
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
            @csrf
            @method('PUT') <!-- Update method -->

            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}" required>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <input type="text" id="kategori" name="kategori" value="{{ $barang->kategori }}" required>
            </div>

            <div class="form-group">
                <label for="stok_barang">Stok Barang</label>
                <input type="number" id="stok_barang" name="stok_barang" value="{{ $barang->stok_barang }}" required min="0">
            </div>

            <div class="form-group">
                <label for="harga_jual">Harga Jual</label>
                <input type="number" id="harga_jual" name="harga_jual" value="{{ $barang->harga_jual }}" required min="0" step="0.01">
            </div>

            <button type="submit" class="save-btn">Simpan Perubahan</button> <!-- Mengganti kelas tombol menjadi save-btn -->
            <button type="button" onclick="location.href='{{ route('barang.index') }}'" class="btn-cancel">Batal</button> <!-- Mengganti kelas tombol menjadi btn-cancel -->
        </form>
    </div>
    @endsection

    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>
</html>
