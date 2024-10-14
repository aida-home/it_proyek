<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi</title>
    <link rel="stylesheet" href="{{ asset('css2/style2.css') }}">
</head>
<body>
    <div class="container">
        <h1>Daftar Transaksi</h1>

        <div class="table-section">
            <!-- Link untuk menambahkan transaksi baru -->
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Tambah Transaksi</a>

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
    </div>
</body>
</html>
