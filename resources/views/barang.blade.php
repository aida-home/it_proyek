<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ time() }}">
    <title>Barang</title>
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Barang')

    @section('header', 'Barang')

    @section('content')
    <div class="table-section">
        <div class="box">
            
            <!-- Tombol tambah barang -->
            <a href="{{ route('barang.create') }}" class="btn">Tambah Barang</a>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok Barang</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $index => $barang) <!-- Menambahkan indeks untuk nomor urut -->
                    <tr>
                        <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori }}</td>
                        <td>{{ $barang->stok_barang }}</td>
                        <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td> <!-- Format harga jual dengan dua angka desimal dan awalan Rp -->
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('barang.edit', $barang->id_barang) }}" class="btn-edit">Ubah</a>
                                <form action="{{ route('barang.destroy', $barang->id_barang) }}" method="POST" style="display:inline;">
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
