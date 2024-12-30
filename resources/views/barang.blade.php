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
                        <th>Harga Beli</th> <!-- Menambahkan kolom harga beli -->
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $index => $item) <!-- Perubahan variabel dari $barang ke $item -->
                    <tr>
                        <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->kategori->nama_kategori ?? '-' }}</td> <!-- Menampilkan nama kategori -->
                        <td>{{ $item->stok_barang }}</td>
                        <td>Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td> <!-- Menampilkan harga beli -->
                        <td>Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td> <!-- Format harga jual -->
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('barang.edit', $item->id_barang) }}" class="btn-edit">Ubah</a>
                                <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST" style="display:inline;">
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
