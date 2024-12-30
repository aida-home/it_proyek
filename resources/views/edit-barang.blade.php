<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }} ?v={{ time() }}"> 
    <title>Edit Barang</title>
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Ubah Barang')

    @section('header', 'Ubah Barang')

    @section('content')
    <div class="form-container"> <!-- Menambahkan class form-container -->
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
                <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori:</label>
                <select id="kategori" name="id_kategori" required>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id_kategori }}" 
                            {{ old('kategori', $barang->kategori) == $item->id_kategori ? 'selected' : '' }}>
                            {{ $item->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="stok_barang">Stok Barang</label>
                <input type="number" id="stok_barang" name="stok_barang" value="{{ old('stok_barang', $barang->stok_barang) }}" required min="0">
            </div>

            <!-- Menambahkan input harga beli -->
            <div class="form-group">
                <label for="harga_beli">Harga Beli</label>
                <input type="number" id="harga_beli" name="harga_beli" value="{{ old('harga_beli', $barang->harga_beli) }}" required min="0" step="0.01">
            </div>

            <div class="form-group">
                <label for="harga_jual">Harga Jual</label>
                <input type="number" id="harga_jual" name="harga_jual" value="{{ old('harga_jual', $barang->harga_jual) }}" required min="0" step="0.01">
            </div>

            <button type="submit" class="save-btn">Simpan Perubahan</button> <!-- Mengganti kelas tombol menjadi save-btn -->
            <button type="button" onclick="location.href='{{ route('barang.index') }}'" class="btn-cancel">Batal</button> <!-- Mengganti kelas tombol menjadi btn-cancel -->
        </form>
    </div>
    @endsection

    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        //message with sweetalert
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
