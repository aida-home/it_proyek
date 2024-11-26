<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Ubah Kategori')

    @section('header', 'Ubah Kategori')

    @section('content')
    <div class="container">
        <form action="/edit-kategori/{{$kategori->id_kategori}}" method="POST">
            @csrf
            @method('PUT')
            <div class="table-section"> 
            <div class="form-group">
                <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" placeholder="Nama Kategori" required>
            </div>
            @error('nama_kategori')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit">Simpan</button>
        </form>
    </div>
</div>
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
@endsection
</body>
</html>
