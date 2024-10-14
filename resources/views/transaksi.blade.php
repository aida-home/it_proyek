<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi</title>

    <!-- Tetap menggunakan file CSS Anda -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>
<body>
    <div class="container">
        <h1>Daftar Transaksi</h1>

        <!-- Pesan Sukses atau Error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Filter Tanggal Transaksi -->
        <form action="{{ route('transaksi.index') }}" method="GET">
            <label for="tanggal_transaksi">Filter berdasarkan tanggal:</label>
            <input type="date" name="tanggal_transaksi" max="{{ date('Y-m-d') }}" required>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <!-- Tombol untuk menambahkan transaksi baru -->
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Tambah Transaksi</a>

        <!-- Tabel daftar transaksi -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $item)
                    <tr>
                        <td>{{ $item->id_transaksi }}</td>
                        <td>{{ $item->tanggal_transaksi }}</td>
                        <td>Rp {{ number_format($item->total_pembayaran, 2, ',', '.') }}</td>
                        <td>
                            <!-- Link untuk melihat detail transaksi -->
                            <a href="{{ route('transaksi.show', $item->id_transaksi) }}" class="btn btn-info">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
