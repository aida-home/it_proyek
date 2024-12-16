<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/form.css') }}" rel="stylesheet"> <!-- Link ke form.css -->
    <title>Ubah Barang Masuk</title>
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Ubah Barang Masuk')

    @section('header', 'Ubah Barang Masuk')

    @section('content')
    <div class="form-container"> <!-- Menambahkan form-container -->
        <!-- Form untuk mengubah data barang masuk -->
        <form action="{{ route('barangmasuk.update', $barang->id_barangmasuk) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="supplier">Supplier</label>
                <!-- Dropdown untuk memilih supplier -->
                <select name="supplier" id="supplier" required>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id_supplier }}" {{ $supplier->id_supplier == $barang->supplier ? 'selected' : '' }}>
                            {{ $supplier->nama_supplier }}
                        </option>
                    @endforeach
                </select>

                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" required>
                    @foreach ($kategori as $kategori)
                        <option value="{{ $kategori->id_kategori }}" {{ $kategori->id_kategori == $barang->kategori ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <!-- Input manual untuk nama barang -->
                <input type="text" name="nama_barang" id="nama_barang" value="{{ $barang->nama_barang }}" placeholder="Nama Barang" required>
            </div>

            <div class="form-group">
                <label for="tgl_masuk">Tanggal Masuk</label>
                <!-- Input tanggal masuk -->
                <input type="date" name="tgl_masuk" id="tgl_masuk" value="{{ $barang->tgl_masuk }}" max="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="jumlah_masuk">Jumlah Masuk</label>
                <!-- Input jumlah barang masuk -->
                <input type="number" name="jumlah_masuk" id="jumlah_masuk" value="{{ $barang->jumlah_masuk }}" placeholder="Jumlah Masuk" required>
            </div>

            <div class="form-group">
                <label for="harga_beli">Harga Beli</label>
                <!-- Input harga beli -->
                <input type="number" name="harga_beli" id="harga_beli" value="{{ $barang->harga_beli }}" placeholder="Harga Beli" required>
            </div>

            <!-- Tombol untuk menyimpan perubahan -->
            <button type="submit" class="save-btn">Simpan Perubahan</button>
            
            <!-- Tombol untuk batal -->
            <button type="button" onclick="location.href='{{ route('barangmasuk.index') }}'" class="btn-cancel">Batal</button>
        </form>
    </div>
    @endsection
</body>
</html>
