<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <!-- Link ke form.css -->
    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }}?v={{ time() }}">
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Tambah Barang')

    @section('header', 'Tambah Barang')

    @section('content')
    <div class="form-container">
        <div class="form-section">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_barang">Nama Barang:</label>
                    <input type="text" id="nama_barang" name="nama_barang" placeholder="Masukkan nama barang" required>
                </div>
                @error('nama_barang')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="kategori">Kategori:</label>
                    <select id="kategori" name="id_kategori" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="harga_beli">Harga Beli:</label>
                    <input type="number" id="harga_beli" name="harga_beli" placeholder="Masukkan harga beli barang" min="0" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="harga_jual">Harga Jual:</label>
                    <input type="number" id="harga_jual" name="harga_jual" placeholder="Masukkan harga jual barang" min="0" step="0.01" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="save-btn">Simpan</button>
                    <button type="button" onclick="location.href='{{ route('barang.index') }}'" class="btn-cancel">Batal</button>
                </div>
            </form>
        </div>
    </div>
    @endsection
</body>
</html>
