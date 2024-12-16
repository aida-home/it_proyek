<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Tambah Pengguna</title>
    <!-- Link ke form.css -->
    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }}?v={{ time() }}">
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Tambah Pengguna')

    @section('header', 'Tambah Pengguna')

    @section('content')
    <div class="form-container">
        <div class="form-section">
            <form action="{{ route('pengguna.store') }}" method="POST">
                @csrf
                <label for="nama_pengguna">Nama Pengguna</label>
                <input type="text" id="nama_pengguna" name="nama_pengguna" placeholder="Nama Pengguna" required>
                @error('nama_pengguna')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <label for="no_telepon">No. Telepon</label>
                <input type="string" id="no_telepon" name="no_telepon" placeholder="No. Telepon" required>
                @error('no_telepon')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" required>
                @error('username')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required pattern=".{8,}" title="Password minimal 8 karakter">
                <div class="password-hint">Password minimal 8 karakter.</div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                
                <button type="submit" class="save-btn">Simpan</button>
                <button type="button" onclick="location.href='{{ route('pengguna.index') }}'" class="btn btn-cancel">Batal</button>
            </form>
        </div>
    </div>
    @endsection
</body>
</html>
