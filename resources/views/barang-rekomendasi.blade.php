<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ time() }}">
    <title>Rekomendasi Barang</title>
</head>
<body>
    @extends('layouts.sidebar')
    @section('title', 'Barang Terbaik')

    @section('header', 'Rekomendasi Barang')

    @section('content')
    <div class="table-section">
        <!-- Form Filter Tanggal -->
        <form method="GET" action="{{ route('barang-rekomendasi') }}">
            <label for="start_date">Tanggal :</label>
            <input type="date" name="start_date" id="start_date"
                value="{{ $start_date ?? now()->startOfMonth()->format('Y-m-d') }}" required>

            <label for="end_date"> - </label>
            <input type="date" name="end_date" id="end_date"
                value="{{ $end_date ?? now()->endOfMonth()->format('Y-m-d') }}" required>

            <button type="submit">Filter</button>
        </form>

        <!-- Tabel Rekomendasi dengan Ranking -->
        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Ranking</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangTerbaik as $barang)
                    <tr>
                        <td>{{ $barang['nama_barang'] }}</td>
                        <td>{{ $barang['ranking'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
</body>
</html>