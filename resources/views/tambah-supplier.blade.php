<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }}?v={{ time() }}">
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Tambah Supplier')

    @section('header', 'Tambah Supplier')

    @section('content')
    <div class="form-container">
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="table-section"> 
                <!-- Input Nama Supplier -->
                <div class="form-group">
                    <label for="nama_supplier">Nama Supplier :</label>
                    <input type="text" class="form-control" name="nama_supplier" placeholder="Masukkan Nama Supplier" required>
                </div>
                @error('nama_supplier')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <!-- Input No. Telepon -->
                <div class="form-group">
                    <label for="no_telp">No. Telepon :</label>
                    <input type="text" class="form-control" name="no_telp" placeholder="Masukkan No. Telepon" required>
                </div>
                @error('no_telp')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <!-- Input Alamat -->
                <div class="form-group">
                    <label for="alamat">Alamat :</label>
                    <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat" required>
                </div>
                @error('alamat')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <!-- Tombol Aksi -->
                <button type="submit" class="save-btn">Simpan</button>
                <button type="button" onclick="location.href='{{ route('suppliers.index') }}'" class="btn btn-cancel">Batal</button>
            </div>
        </form>
    </div>
    @endsection
</body>
</html>
