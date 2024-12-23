<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Detail Transaksi')

    @section('header', 'Detail Transaksi')

    @section('content')
    <div class="form-container">

        <div class="table-section"> <!-- Tambahkan div dengan kelas table-section -->
            <div class="mb-3">
                <strong style="font-size: 20px">Tanggal Transaksi: </strong> {{ $transaksi->tanggal_transaksi }}
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga Jual</th>
                        <th>Jumlah Beli</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_pembayaran = 0;
                    @endphp
                    @foreach($transaksi->detailTransaksi as $index => $detail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $detail->nama_barang }}</td>
                        <td>Rp {{ number_format($detail->harga_jual ?? 0, 0, ',', '.') }}</td>
                        <td>{{ $detail->jumlah_beli }}</td>
                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @php
                        $total_pembayaran += $detail->subtotal;
                    @endphp
                    @endforeach            
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"><strong>Total Pendapatan</strong></td>
                        <td><strong>Rp {{ number_format($total_pembayaran, 0, ',', '.') }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        <a href="{{ route('transaksi.index') }}" class="btn">Kembali</a>
    </div>
    @endsection
</body>
</html>
