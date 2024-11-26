<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
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
            <!-- Tampilkan pesan sukses jika ada -->
            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif
            
            <!-- Tombol tambah barang -->
            <a href="{{ route('barang.create') }}" class="btn">Tambah Barang</a>
            <table>
                <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok Barang</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $barang)
                    <tr>
                        <td>{{ $barang->id_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori }}</td>
                        <td>{{ $barang->stok_barang }}</td>
                        <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td> <!-- Format harga jual dengan dua angka desimal dan awalan Rp -->
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('barang.edit', $barang->id_barang) }}" class="btn-edit">Edit</a>
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
        </div>
    </div>
    @endsection
</body>
</html>
