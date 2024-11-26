<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #8A5E41;
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-section {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #8A5E41;
            border-radius: 8px;
            background-color: #ffffff;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"], input[type="password"], input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn {
            padding: 12px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            background-color: #8A5E41;
            transition: background-color 0.3s ease;
            width: 100%;
            text-align: center;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .btn:hover {
            background-color: #7A4B31;
        }

        .btn-cancel {
            background-color: #d50000;
        }

        .error {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Ubah Pengguna')

    @section('header', 'Ubah Pengguna')

    @section('content')
    <div class="form-section">
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('pengguna.update', $pengguna->id_pengguna) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nama_pengguna">Nama Pengguna</label>
            <input type="text" id="nama_pengguna" name="nama_pengguna" value="{{ $pengguna->nama_pengguna }}" required>
            
            <label for="no_telepon">No. Telepon</label>
            <input type="text" id="no_telepon" name="no_telepon" value="{{ $pengguna->no_telepon }}" required>
            
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ $pengguna->username }}" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan Password (Kosongkan jika tidak ingin diubah)">
            
            <button type="submit" class="btn">Simpan Perubahan</button>
            <button type="button" onclick="location.href='{{ route('pengguna.index') }}'" class="btn btn-cancel">Batal</button>
        </form>
    </div>
    @endsection
</body>
</html>
