<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ time() }}">
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Pengguna')

    @section('header', 'Pengguna')

    @section('content')

    <div class="table-section">
        <div class="box">
            <a href="{{ route('pengguna.create') }}" class="btn">Tambah Pengguna</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pengguna</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengguna as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td> 
                        <td>{{ $user->nama_pengguna }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <div style="display: flex; justify-content: {{ count($pengguna) === 1 ? 'center' : 'flex-start' }}; align-items: center; gap: 10px;">
                                <a href="{{ route('pengguna.edit', $user->id_pengguna) }}" class="btn-edit">Ubah</a>
                                @if (count($pengguna) > 1) <!-- Tampilkan tombol Hapus hanya jika jumlah pengguna > 1 -->
                                <form action="{{ route('pengguna.destroy', $user->id_pengguna) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
