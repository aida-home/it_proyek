<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Masuk</title>
    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }}?v={{ time() }}">
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Tambah Barang Masuk')

    @section('header', 'Tambah Barang Masuk')

    @section('content')
    <div class="form-container">
        <form action="{{ route('barangmasuk.create') }}" method="POST">
            @csrf
            <div class="table-section">
                <!-- Input Supplier -->
                <div class="form-group">
                    <label for="supplier">Supplier :</label>
                    <select name="supplier" id="supplier" class="form-control" required>
                        <option value="">Pilih Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id_supplier }}">{{ $supplier->nama_supplier }}</option>
                        @endforeach
                    </select>
                </div>
                @error('supplier')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <!-- Input Kategori -->
                <div class="form-group">
                    <label for="kategori">Kategori :</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $kategori)
                            <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                @error('kategori')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <!-- Input Nama Barang -->
                <div class="form-group">
                    <label for="nama_barang">Nama Barang :</label>
                    <input type="text" class="form-control" name="nama_barang" placeholder="Masukkan Nama Barang" required>
                </div>
                @error('nama_barang')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <!-- Input Tanggal Masuk -->
                <div class="form-group">
                    <label for="tgl_masuk">Tanggal Masuk :</label>
                    <input type="date" class="form-control" name="tgl_masuk" max="{{ date('Y-m-d') }}" required>
                </div>
                @error('tgl_masuk')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <!-- Input Jumlah Masuk -->
                <div class="form-group">
                    <label for="jumlah_masuk">Jumlah Masuk :</label>
                    <input type="number" class="form-control" name="jumlah_masuk" placeholder="Masukkan Jumlah Masuk" required>
                </div>
                @error('jumlah_masuk')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <!-- Input Harga Beli -->
                <div class="form-group">
                    <label for="harga_beli">Harga Beli :</label>
                    <input type="number" class="form-control" name="harga_beli" placeholder="Masukkan Harga Beli" required>
                </div>
                @error('harga_beli')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <!-- Tombol Aksi -->
                <button type="submit" class="save-btn">Simpan</button>
                <button type="button" onclick="location.href='{{ route('barangmasuk.index') }}'" class="btn btn-cancel">Batal</button>
            </div>
        </form>
    </div>
    @endsection
</body>
</html>
