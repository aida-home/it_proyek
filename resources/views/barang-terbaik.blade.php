<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Terbaik</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ time() }}">
</head>

<body>
    @extends('layouts.sidebar')
    @section('title', 'Barang Terbaik')

    @section('header', 'Perhitungan')

    @section('content')

        <div class="table-section">
            <!-- Form Filter Tanggal -->
            <form method="GET" action="{{ route('barang-terbaik') }}">
                <label for="start_date">Tanggal :</label>
                <input type="date" name="start_date" id="start_date"
                    value="{{ $start_date ?? now()->startOfMonth()->format('Y-m-d') }}" required>

                <label for="end_date"> - </label>
                <input type="date" name="end_date" id="end_date"
                    value="{{ $end_date ?? now()->endOfMonth()->format('Y-m-d') }}" required>

                <button type="submit">Filter</button>
            </form>

            @if ($errors->any())
                <div class="alert">{{ $errors->first() }}</div>
            @endif

            <br>
            <!-- 1. Data Awal -->
            <h3>1. Data Awal</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Terjual</th>
                        <th>Harga Jual</th>
                        <th>Profit</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangData as $index => $barang)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->jumlah_terjual }}</td>
                            <td> Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($barang->profit, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Data tidak tersedia untuk rentang tanggal yang dipilih.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- 2. Normalisasi -->
            <h3>2. Normalisasi</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Terjual (Benefit)</th>
                        <th>Harga Jual (Cost)</th>
                        <th>Profit (Benefit)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangNormalisasi as $index => $barang)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $barang['nama_barang'] }}</td>
                            <td>{{ number_format($barang['jumlah_terjual'], 2, ',') }}</td>
                            <td>{{ number_format($barang['harga_jual'], 2, ',') }}</td>
                            <td>{{ number_format($barang['profit'], 2, ',') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Data tidak tersedia untuk normalisasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- 3. Nilai Preferensi -->
            <h3>3. Nilai Preferensi</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Nilai Preferensi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangTerbaik as $barang)
                        <tr>
                            <td>{{ $barang['nama_barang'] }}</td>
                            <td>{{ number_format($barang['nilai_preferensi'], 2, ',') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">Data tidak tersedia untuk preferensi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endsection
</body>

</html>
