<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ time() }}">
    <title>Barang Masuk</title>
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Barang Masuk')

    @section('header', 'Barang Masuk')

    @section('content')
    <div class="table-section">
        <div class="box">
            <!-- Tombol Tambah -->
            <a href="{{ route('barangmasuk.create') }}" class="btn">Tambah Barang Masuk</a>
    
            <!-- Tabel Data Barang Masuk -->
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Kategori</th>
                        <th>Tanggal Masuk</th>
                        <th>Jumlah Masuk</th>
                        <th>Harga Beli</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangMasuk as $index => $barang) <!-- Menambahkan $index untuk nomor urut -->
                        <tr>
                            <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut mulai dari 1 -->
                            <td>{{ $barang->barang->nama_barang ?? '-' }}</td> 
                            <td>{{ $barang->barang->kategori->nama_kategori ?? '-' }}</td> <!-- Menampilkan nama kategori berdasarkan barang -->
                            <td>{{ \Carbon\Carbon::parse($barang->tgl_masuk)->format('d/m/Y') }}</td> <!-- Menampilkan tanggal dengan format yang lebih mudah dibaca -->
                            <td>{{ $barang->jumlah_masuk }}</td>
                            <td>Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('barangmasuk.edit', $barang->id_barangmasuk) }}" class="btn btn-edit">Ubah</a>
                                    <!-- Tombol Hapus -->
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
    @endsection
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        // Pesan dengan SweetAlert
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
