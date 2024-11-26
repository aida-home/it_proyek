<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ time() }}">
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Pengguna')

    @section('header', 'Pengguna')

    @section('content')

    <div class="table-section">
        <div class="box">
            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif
            <a href="{{ route('pengguna.create') }}" class="btn">Tambah Pengguna</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Pengguna</th>
                        <th>Nama Pengguna</th>
                        <th>No. Telepon</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengguna as $user)
                    <tr>
                        <td>{{ $user->id_pengguna }}</td>
                        <td>{{ $user->nama_pengguna }}</td>
                        <td>{{ $user->no_telepon }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('pengguna.edit', $user->id_pengguna) }}" class="btn-edit">Ubah</a>
                                <form action="{{ route('pengguna.destroy', $user->id_pengguna) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>                           
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection
</body>
</html>
