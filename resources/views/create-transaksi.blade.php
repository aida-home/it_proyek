<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Transaksi</title>
    <style>
        /* Reset margin dan padding untuk semua elemen */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Roboto, sans-serif;
            background-color: #f9f4f4; /* Latar belakang pastel pink */
            padding: 20px;
        }

        .container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            color: #d5006d;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .form-section, .table-section {
            padding: 20px;
            border: 1px solid #d5006d;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"], input[type="number"], input[type="date"], select {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            width: 100%;
            text-decoration: none;
        }

        .btn-primary {
            background-color:  #d5006d;
        }

        .btn-success {
            background-color:  #d5006d;
        }

        .btn:hover {
            opacity: 0.9;
            transform: scale(1.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffeef8;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #ff80ab;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Transaksi</h2>
        <form action="{{ route('transaksi.store') }}" method="POST" id="transaksiForm">
            @csrf
            <!-- Input Tanggal dengan Filter -->
            <div class="form-group">
                <label for="tanggal_transaksi">Tanggal Transaksi:</label>
                <input type="date" class="form-control" name="tanggal_transaksi" max="{{ date('Y-m-d') }}" required>
            </div>

            <!-- Pilihan Barang -->
            <div class="form-group">
                <label for="barang">Barang:</label>
                <select class="form-control" id="barang" name="barang">
                    <option value="">Pilih Barang</option>
                    @foreach ($barang as $item)
                        <option value="{{ $item->id_barang }}" data-harga="{{ $item->harga_jual }}">
                            {{ $item->nama_barang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Harga Jual Barang -->
            <div class="form-group">
                <label for="harga_jual">Harga Jual:</label>
                <input type="text" class="form-control" id="harga_jual" readonly>
            </div>

            <!-- Jumlah Beli -->
            <div class="form-group">
                <label for="jumlah_beli">Jumlah Beli:</label>
                <input type="number" class="form-control" id="jumlah_beli" min="1" name="jumlah_beli">
            </div>

            <!-- Tombol Tambah Barang -->
            <button type="button" class="btn btn-primary" id="tambahBarang">Tambah Barang</button>

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
                    </tr>
                </thead>
                <tbody id="daftarBarang">
                    <!-- Barang yang ditambahkan akan muncul di sini -->
                </tbody>
            </table>

            <!-- Tombol Simpan Transaksi -->
            <button type="submit" class="btn btn-success">Simpan Transaksi</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
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
            var subtotal = jumlahBeli * hargaJual;

            if (!idBarang || !jumlahBeli || jumlahBeli <= 0) {
                alert('Harap isi semua field dan jumlah beli harus lebih dari 0.');
                return;
            }

            var newRow = `
                <tr>
                    <td><input type="hidden" name="barang[${idBarang}][id_barang]" value="${idBarang}">${namaBarang}</td>
                    <td><input type="hidden" name="barang[${idBarang}][jumlah_beli]" value="${jumlahBeli}">${jumlahBeli}</td>
                    <td>${hargaJual}</td>
                    <td>${subtotal}</td>
                </tr>
            `;

            $('#daftarBarang').append(newRow);

            // Reset form setelah barang ditambahkan
            $('#barang').val('');
            $('#harga_jual').val('');
            $('#jumlah_beli').val('');
        });
    });
    </script>
</body>
</html>
