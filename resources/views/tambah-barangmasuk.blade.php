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

                <!-- Input Nama Barang -->
                <div class="form-group">
                    <label for="barang">Nama Barang :</label>
                    <select name="id_barang" id="barang" class="form-control" required>
                        <option value="">Pilih Barang</option>
                        @foreach ($barang as $item)
                            <option value="{{ $item->id_barang }}" 
                                {{ old('id_barang') == $item->id_barang ? 'selected' : '' }}>
                                {{ $item->nama_barang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('id_barang')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <!-- Input Kategori -->
                <div class="form-group">
                    <label for="kategori">Kategori :</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" 
                           value="{{ old('kategori') }}" readonly>
                </div>
                @error('kategori')
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
        document.addEventListener('DOMContentLoaded', function () {
            const barangSelect = document.getElementById('barang');
            const kategoriInput = document.getElementById('kategori');

            barangSelect.addEventListener('change', function () {
                const barangId = barangSelect.value;

                if (barangId) {
                    // Mengambil kategori berdasarkan ID barang
                    fetch(`/get-kategori/${barangId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Set nilai kategori jika ditemukan
                            kategoriInput.value = data.nama_kategori || 'Kategori tidak ditemukan';
                        })
                        .catch(error => {
                            console.error('Error fetching kategori:', error);
                            kategoriInput.value = 'Error mengambil kategori';
                        });
                } else {
                    kategoriInput.value = '';
                }
            });

            // Set default tanggal
            const tglMasuk = document.getElementById('tgl_masuk');
            const today = new Date().toISOString().split('T')[0];
            tglMasuk.value = today;
            tglMasuk.setAttribute('max', today);
        });
    </script>
</body>
</html>
