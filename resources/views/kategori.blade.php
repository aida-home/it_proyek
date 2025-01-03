<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kategori</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ time() }}">
</head>

<body>
    @extends('layouts.sidebar')

    @section('title', 'Kategori')

    @section('header', 'Kategori')

    @section('content')
        <div class="table-section">
            <!-- Link untuk menambahkan kategori baru -->
            <br>
            @if ($errors->has('error'))
                <div id="notif-error" class="alert alert-danger">
                    {{ $errors->first('error') }}
                </div>
            @endif

            <a href="{{ route('kategori.create') }}" class="btn">Tambah Kategori</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th> <!-- Kolom Aksi -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_kategori }}</td>
                            <td>
                                <div class="action-buttons">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('kategori.edit', $item->id_kategori) }}"
                                        style="text-decoration: none;">
                                        <button class="btn-edit">Ubah</button>
                                    </a>
                                    <!-- Tombol Delete -->
                                    <form action="{{ route('kategori.destroy', $item->id_kategori) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete"
                                            onclick="return confirm('Apakah yakin ingin menghapus?')">Hapus</button>
                                    </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
    </div>
    </div>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        //message with sweetalert
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

    <script>
        setTimeout(() => {
            const errorNotif = document.getElementById('notif-error');
            if (errorNotif) {
                // Tambahkan animasi transisi
                errorNotif.style.transition = 'opacity 0.5s ease';
                errorNotif.style.opacity = '0'; // Kurangi opacity ke 0
                setTimeout(() => errorNotif.remove(), 500);
            }
        }, 5000);
    </script>

</body>

</html>
