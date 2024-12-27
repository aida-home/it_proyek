<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }} ?v={{ time() }}"> 
    <title>Ubah Barang Masuk</title>
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Ubah Barang Masuk')

    @section('header', 'Ubah Barang Masuk')

    @section('content')
    <div class="form-container">
        <!-- Form untuk mengubah data barang masuk -->
        <form action="{{ route('barangmasuk.update', $barangMasuk->id_barangmasuk) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <!-- Dropdown untuk memilih kategori -->
                <select name="kategori" id="kategori" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id_kategori }}" 
                            {{ old('kategori', $barangMasuk->kategori) == $kat->id_kategori ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <!-- Input nama barang -->
                <input type="text" name="nama_barang" id="nama_barang" 
                    value="{{ old('nama_barang', $barangMasuk->nama_barang) }}" 
                    placeholder="Nama Barang" required>
                @error('nama_barang')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tgl_masuk">Tanggal Masuk</label>
                <!-- Input tanggal masuk -->
                <input type="date" name="tgl_masuk" id="tgl_masuk" 
                    value="{{ old('tgl_masuk', $barangMasuk->tgl_masuk) }}" 
                    max="{{ date('Y-m-d') }}" required>
                @error('tgl_masuk')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jumlah_masuk">Jumlah Masuk</label>
                <!-- Input jumlah barang masuk -->
                <input type="number" name="jumlah_masuk" id="jumlah_masuk" 
                    value="{{ old('jumlah_masuk', $barangMasuk->jumlah_masuk) }}" 
                    placeholder="Jumlah Masuk" required>
                @error('jumlah_masuk')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="harga_beli">Harga Beli</label>
                <!-- Input harga beli -->
                <input type="number" name="harga_beli" id="harga_beli" 
                    value="{{ old('harga_beli', $barangMasuk->harga_beli) }}" 
                    placeholder="Harga Beli" required>
                @error('harga_beli')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="save-btn">Simpan Perubahan</button>
                <button type="button" onclick="location.href='{{ route('barangmasuk.index') }}'" class="btn-cancel">Batal</button>
            </div>
        </form>
    </div>
    @endsection

    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        // Pastikan DOM sudah dimuat sepenuhnya
        window.onload = function() {
            // Set tanggal input default menjadi hari ini
            const today = new Date().toISOString().split('T')[0];
            const tglMasuk = document.getElementById('tgl_masuk');
            tglMasuk.value = today; // Set default date to today
            tglMasuk.setAttribute('max', today); // Prevent selecting future dates
        };

        // Menampilkan notifikasi dengan SweetAlert jika ada sesi 'success' atau 'error'
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>
</html>
