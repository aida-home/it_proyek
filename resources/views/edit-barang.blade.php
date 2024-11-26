<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <style>
        body {
            font-family: Roboto, sans-serif;
            background-color: #f9f4f4; /* Pastel pink background */
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #8A5E41; /* Consistent header color */
        }

        .form-section {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #8A5E41; /* Consistent border color */
            border-radius: 8px;
            background-color: #ffffff; /* Form background color */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow for depth */
        }

        input[type="text"], input[type="number"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            background-color: #fff;
            box-sizing: border-box;
        }

        select:focus, input:focus {
            outline: none;
            border-color: #ff80ab; /* Border color on focus */
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
            font-size: 16px;
            margin-bottom: 10px;
        }

        .btn:hover {
            background-color: #7A4B31;
        }

        .btn-cancel {
            background-color: #d50000;
        }

        .btn-cancel:hover {
            background-color: #a70000;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #8A5E41;
        }
    </style>
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Barang')

    @section('header', 'Barang')

    @section('content')
    <h1>Edit Barang</h1>
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

            <button type="submit" class="btn">Simpan Perubahan</button>
            <button type="button" onclick="location.href='{{ route('barang.index') }}'" class="btn btn-cancel">Batal</button>
        </form>
        @endsection
    </div>
</body>
</html>
