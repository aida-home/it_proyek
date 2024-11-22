<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Masuk</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Include CSS -->
</head>
<body>
    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Konten Utama -->
    <div class="content-wrapper">
        <h1>Barang Masuk</h1>
        <div class="container">
            <div class="subtitle">Tabel Data Barang Masuk</div> <!-- Judul di dalam box -->
            <div class="box">
                <a href="{{ route('barangmasuk.create') }}" class="btn">Tambah Barang Masuk</a> <!-- Tombol Tambah -->
                <table>
                    <thead>
                        <tr>
                            <th>ID Barang Masuk</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Supplier</th>
                            <th>Tanggal Masuk</th>
                            <th>Jumlah Masuk</th>
                            <th>Harga Beli</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangMasuk as $barang)
                            <tr>
                                <td>{{ str_pad($barang->id_barangmasuk, 2, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $barang->nama_barang }}</td>
                                <td>{{ $barang->kategori }}</td>
                                <td>{{ $barang->supplier }}</td>
                                <td>{{ $barang->tgl_masuk }}</td>
                                <td>{{ $barang->jumlah_masuk }}</td>
                                <td>Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('barangmasuk.edit', $barang->id_barangmasuk) }}" class="btn btn-edit">Edit</a>
                                        <form action="{{ route('barangmasuk.destroy', $barang->id_barangmasuk) }}" method="POST" style="display:inline;">
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
    </div>
</body>
</html>
