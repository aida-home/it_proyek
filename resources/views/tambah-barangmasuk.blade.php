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
        <form action="{{ route('barangmasuk.store') }}" method="POST">
            @csrf
            <div class="table-section">
                <!-- Input Kategori -->
                <div class="form-group">
                    <label for="kategori">Kategori :</label>
                    <select name="id_kategori" id="kategori" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id_kategori }}" 
                                {{ old('kategori') == $item->id_kategori ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('kategori')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <!-- Input Nama Barang -->
                <div class="form-group">
                    <label for="barang">Nama Barang :</label>
                    <select name="id_barang" id="barang" class="form-control" required>
                        <option value="">Pilih Barang</option>
                        @foreach ($barang as $item)
                            <option value="{{ $item->id_barang }}" 
                                {{ old('barang') == $item->id_barang ? 'selected' : '' }}>
                                {{ $item->nama_barang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('nama_barang')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <!-- Input Tanggal Masuk -->
                <div class="form-group">
                    <label for="tgl_masuk">Tanggal Masuk :</label>
                    <input type="date" class="form-control" name="tgl_masuk" id="tgl_masuk" 
                        value="{{ old('tgl_masuk') }}" required>
                </div>
                @error('tgl_masuk')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <!-- Input Jumlah Masuk -->
                <div class="form-group">
                    <label for="jumlah_masuk">Jumlah Masuk :</label>
                    <input type="number" class="form-control" name="jumlah_masuk" 
                        value="{{ old('jumlah_masuk') }}" placeholder="Masukkan Jumlah Masuk" required>
                </div>
                @error('jumlah_masuk')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <!-- Input Harga Beli -->
                <div class="form-group">
                    <label for="harga_beli">Harga Beli :</label>
                    <input type="number" class="form-control" name="harga_beli" 
                        value="{{ old('harga_beli') }}" placeholder="Masukkan Harga Beli" required>
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

    <script>
        // Pastikan DOM sudah dimuat sepenuhnya
        window.onload = function() {
            const today = new Date().toISOString().split('T')[0];
            const tglMasuk = document.getElementById('tgl_masuk');
            tglMasuk.value = today; // Set default date to today
            tglMasuk.setAttribute('max', today); // Prevent selecting future dates
        };
    </script>
</body>
</html>
