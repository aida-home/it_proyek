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
                <label for="id_barangmasuk">Nama Barang</label>
                <select name="id_barangmasuk" id="id_barangmasuk" placeholder="Pilih Nama Barang" required>
                    @foreach ($barangMasuk as $barang)
                        <option value="{{ $barang->id_barangmasuk }}">{{ $barang->nama_barang }}</option>
                    @endforeach
                </select>

                <label for="harga_jual">Harga Jual</label>
                <input type="number" name="harga_jual" id="harga_jual" placeholder="Masukkan Harga Jual" required min="0" step="0.01">

                <button type="submit" class="save-btn">Simpan</button>
                <button type="button" onclick="location.href='{{ route('barang.index') }}'" class="btn-cancel">Batal</button>
            </form>
        </div>
    </div>
    @endsection
</body>
</html>
