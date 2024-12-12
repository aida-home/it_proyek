<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Transaksi')

    @section('header', 'Transaksi')

    @section('content')

        <div class="table-section">
            <!-- Link untuk menambahkan transaksi baru -->
            <a href="{{ route('transaksi.create') }}" class="btn">Tambah Transaksi</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td> 
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
        @endsection
    </div>
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
