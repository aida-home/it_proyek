<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }} ?v={{ time() }}"> 
    <title>Edit Pengguna</title>
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Ubah Pengguna')

    @section('header', 'Ubah Pengguna')

    @section('content')
    <div class="form-container"> <!-- Menambahkan form-container -->
        <form action="{{ route('pengguna.update', $pengguna->id_pengguna) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nama_pengguna">Nama Pengguna</label>
            <input type="text" id="nama_pengguna" name="nama_pengguna" value="{{ $pengguna->nama_pengguna }}" required>
            
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ $pengguna->username }}" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan Password (Kosongkan jika tidak ingin diubah)">
            
            <button type="submit" class="save-btn">Simpan Perubahan</button> <!-- Mengganti kelas tombol menjadi save-btn -->
            <button type="button" onclick="location.href='{{ route('pengguna.index') }}'" class="btn-cancel">Batal</button> <!-- Mengganti kelas tombol menjadi btn-cancel -->
        </form>
    </div>
    @endsection

    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        // message with sweetalert
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
