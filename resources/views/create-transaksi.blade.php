<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Transaksi</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styleform.css') }}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Tambah Transaksi')

    @section('header', 'Tambah Transaksi')

    @section('content')
    <div class="form-container">
        <form action="{{ route('transaksi.store') }}" method="POST" id="transaksiForm">
            @csrf
            <div class="table-section">
                <!-- Input Tanggal dengan Filter -->
                <div class="form-group">
                    <label for="tanggal_transaksi">Tanggal Transaksi:</label>
                    <input type="date" class="form-control" name="tanggal_transaksi" max="{{ date('Y-m-d') }}" required>
                    <small class="form-text text-muted" style="color: #888; font-size: 12px; font-weight: normal;">*Tanggal hanya dimasukkan sekali.</small>
                </div>

                <!-- Pilihan Barang -->
                <div class="form-group">
                    <label for="barang">Barang:</label>
                    <select class="form-control" id="barang" name="barang">
                        <option value="">Pilih Barang</option>
                        @foreach ($barang as $item)
                            <option value="{{ $item->id_barang }}" data-harga="{{ $item->harga_jual }}" data-stock="{{ $item->stok_barang }}">
                                {{ $item->nama_barang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Harga Jual Barang -->
                <div class="form-group">
                    <label for="harga_jual">Harga Jual:</label>
                    <input type="number" class="form-control" id="harga_jual" readonly>
                </div>

                <!-- Jumlah Beli -->
                <div class="form-group">
                    <label for="jumlah_beli">Jumlah Beli:</label>
                    <input type="number" class="form-control" id="jumlah_beli" min="1" name="jumlah_beli">
                </div>

                <!-- Tombol Tambah Barang -->
                <button type="button" class="btn btn-primary" id="tambahBarang">Tambah Barang</button>
                <small class="form-text text-muted" style="color: #888; font-size: 12px; font-weight: normal;">*Tambahkan sekali untuk 1 jenis barang</small>

                <hr>

                <!-- Daftar Barang yang Ditambahkan -->
                <h3>Daftar Barang</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah Beli</th>
                            <th>Harga Jual</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="daftarBarang">
                        <!-- Barang yang ditambahkan akan muncul di sini -->
                    </tbody>
                </table>

                <!-- Total Transaksi -->
                <h4>Total: <span id="totalTransaksi">0</span></h4>

                <!-- Tombol Simpan Transaksi -->
                <button type="submit" class="btn btn-success">Simpan Transaksi</button>
            </div>
        </form>
    </div>
    @endsection

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        let totalTransaksi = 0;

        // Saat barang dipilih, tampilkan harga jual
        $('#barang').change(function() {
            var hargaJual = $(this).find(':selected').data('harga');
            $('#harga_jual').val(hargaJual);
        });

        // Tambahkan barang ke daftar ketika tombol "Tambah Barang" diklik
        $('#tambahBarang').click(function() {
            var namaBarang = $('#barang option:selected').text();
            var idBarang = $('#barang').val();
            var jumlahBeli = $('#jumlah_beli').val();
            var hargaJual = $('#harga_jual').val();
            var stok = $('#barang option:selected').data('stock');
            var subtotal = jumlahBeli * hargaJual;

            // Cek apakah jumlah beli melebihi stok
            if (!idBarang || !jumlahBeli || jumlahBeli <= 0) {
                alert('Harap isi semua field dan jumlah beli harus lebih dari 0.');
                return;
            }

            // Pastikan stok cukup
            if (jumlahBeli > parseInt(stok)) {
                alert('Stok tidak mencukupi. Stok tersedia: ' + stok);
                return;
            }

            // Tambahkan subtotal ke total transaksi
            totalTransaksi += subtotal;

            var newRow = `
                <tr>
                    <td><input type="hidden" name="barang[${idBarang}][id_barang]" value="${idBarang}">${namaBarang}</td>
                    <td><input type="hidden" name="barang[${idBarang}][jumlah_beli]" value="${jumlahBeli}">${jumlahBeli}</td>
                    <td>${hargaJual}</td>
                    <td>${subtotal}</td>
                    <td><button type="button" class="btn btn-danger btn-delete">Hapus</button></td>
                </tr>
            `;

            $('#daftarBarang').append(newRow);
            $('#totalTransaksi').text(totalTransaksi);

            // Reset form setelah barang ditambahkan
            $('#barang').val('');
            $('#harga_jual').val('');
            $('#jumlah_beli').val('');
        });

        // Hapus barang dari daftar
        $('#daftarBarang').on('click', '.btn-delete', function() {
            var subtotal = $(this).closest('tr').find('td:nth-child(4)').text();
            totalTransaksi -= parseFloat(subtotal);
            $('#totalTransaksi').text(totalTransaksi);
            $(this).closest('tr').remove();
        });
    });
    </script>
</body>
</html>
