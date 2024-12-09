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
    <form action="{{ route('transaksi.store') }}" method="POST" id="transaksiForm">
        @csrf
        <div class="form-container">
            <div class="row">
                <!-- Form Input Barang -->
                <div class="col-md-6">
                    <div class="form-section">
                        <div class="form-group">
                            <label for="tanggal_transaksi">Tanggal Transaksi:</label>
                            <input type="date" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi" max="{{ date('Y-m-d') }}" required>
                            <small class="form-text text-muted">*Tanggal hanya dimasukkan sekali.</small>
                        </div>
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
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual:</label>
                            <input type="number" class="form-control" id="harga_jual" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_beli">Jumlah Beli:</label>
                            <input type="number" class="form-control" id="jumlah_beli" min="1" name="jumlah_beli" value="1">
                        </div>
                        <button type="button" class="btn btn-primary" id="tambahBarang">Tambah Barang</button>
                    </div>
                </div>

                <!-- Daftar Barang -->
                <div class="col-md-6">
                    <div class="daftar-barang-container">
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
                        <h4>Total: <span id="totalTransaksi">Rp 0</span></h4>

                        <!-- Input Pembayaran -->
                        <div class="form-group">
                            <label for="uang_dibayar" style="font-size: 14px;">Uang Dibayar:</label>
                            <input type="number" class="form-control" id="uang_dibayar" min="0" value="0">
                        </div>
                        <h4>Kembalian: <span id="kembalian">Rp 0</span></h4>
                        
                    </div>
                </div>
            </div>

            <!-- Tombol Simpan dan Batal -->
            <div class="form-actions">
                <button type="submit" class="btn btn-success">Simpan Transaksi</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-danger">Batal</a>
            </div>
        </div>
    </form>
    @endsection

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            let totalTransaksi = 0;

            // Fungsi untuk memformat angka menjadi mata uang
            function formatRupiah(angka) {
                return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            // Set default date to today
            const today = new Date().toISOString().split('T')[0];
            $('#tanggal_transaksi').val(today);

            // Saat barang dipilih, tampilkan harga jual
            $('#barang').change(function () {
                const hargaJual = $(this).find(':selected').data('harga');
                $('#harga_jual').val(hargaJual);
            });

            // Tambahkan barang ke daftar
            $('#tambahBarang').click(function () {
                const namaBarang = $('#barang option:selected').text();
                const idBarang = $('#barang').val();
                const jumlahBeli = $('#jumlah_beli').val();
                const hargaJual = $('#harga_jual').val();
                const stok = $('#barang option:selected').data('stock');
                const subtotal = jumlahBeli * hargaJual;

                if (!idBarang || !jumlahBeli || jumlahBeli <= 0) {
                    alert('Harap isi semua field dan jumlah beli harus lebih dari 0.');
                    return;
                }

                if (jumlahBeli > parseInt(stok)) {
                    alert('Stok tidak mencukupi. Stok tersedia: ' + stok);
                    return;
                }

                totalTransaksi += subtotal;

                const newRow = `
                    <tr>
                        <td><input type="hidden" name="barang[${idBarang}][id_barang]" value="${idBarang}">${namaBarang}</td>
                        <td><input type="hidden" name="barang[${idBarang}][jumlah_beli]" value="${jumlahBeli}">${jumlahBeli}</td>
                        <td>${formatRupiah(hargaJual)}</td>
                        <td>${formatRupiah(subtotal)}</td>
                        <td><button type="button" class="btn btn-danger btn-delete">Hapus</button></td>
                    </tr>
                `;

                $('#daftarBarang').append(newRow);
                $('#totalTransaksi').text(formatRupiah(totalTransaksi));

                $('#barang').val('');
                $('#harga_jual').val('');
                $('#jumlah_beli').val('1');
            });

            // Hapus barang dari daftar
            $('#daftarBarang').on('click', '.btn-delete', function () {
                const subtotal = parseFloat($(this).closest('tr').find('td:nth-child(4)').text().replace(/[^\d]/g, ''));
                totalTransaksi -= subtotal;
                $('#totalTransaksi').text(formatRupiah(totalTransaksi));
                $(this).closest('tr').remove();
            });

            // Update kembalian
            $('#uang_dibayar').on('input', function () {
                const uangDibayar = parseFloat($(this).val());
                const kembalian = uangDibayar - totalTransaksi;
                $('#kembalian').text(formatRupiah(kembalian >= 0 ? kembalian : 0));
            });
        });
     </script>
</body>
</html>
