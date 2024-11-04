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

/* Container untuk membagi form dan tabel */
.container {
    display: flex;
    flex-direction: column; /* Mengatur elemen secara vertikal */
    gap: 20px; /* Jarak antara elemen */
    max-width: 800px; /* Lebar maksimum container */
    margin: 0 auto; /* Mengatur container di tengah */
}

h1 {
    text-align: center;
    color: #d5006d; /* Warna teks header */
    font-size: 28px;
    margin-bottom: 20px; /* Jarak bawah header */
}

.form-section {
    padding: 20px;
    border: 1px solid #d5006d; /* Warna border */
    border-radius: 8px;
    background-color: #fff; /* Latar belakang putih */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Bayangan pada form */
}

h2 {
    color: #4e4e4e;
    margin-bottom: 15px;
    font-size: 24px;
}

/* Styling untuk input form */
.form-group {
    margin-bottom: 15px; /* Jarak bawah antar input */
}

label {
    display: block; /* Memastikan label berada di baris terpisah */
    margin-bottom: 5px; /* Jarak bawah label */
    font-weight: bold; /* Membuat label lebih menonjol */
}

input[type="text"], input[type="number"], input[type="date"], select {
    width: calc(100% - 20px); /* Lebar penuh input dengan margin */
    padding: 10px;
    border: 1px solid #ddd; /* Border input */
    border-radius: 5px;
}

/* Styling tombol umum */
.btn {
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    color: white;
    transition: background-color 0.3s ease, transform 0.2s; /* Animasi transisi warna dan ukuran */
    width: 100%; /* Lebar penuh tombol */
    text-decoration: none; /* Hilangkan garis bawah pada tombol link */
}

/* Warna tombol */
.btn-primary {
    background-color:  #d5006d; /* Warna biru untuk tombol tambah */
}

.btn-success {
    background-color:  #d5006d; /* Hijau untuk tombol simpan */
}

/* Efek hover untuk tombol */
.btn:hover {
    opacity: 0.9; /* Efek opacity saat hover */
    transform: scale(1.05); /* Sedikit memperbesar tombol saat hover */
}

.table-section {
    border: 1px solid #d5006d; /* Warna border */
    border-radius: 8px;
    background-color: #fff; /* Latar belakang putih */
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Bayangan pada tabel */
}

table {
    width: 100%; /* Lebar penuh tabel */
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #ffeef8; /* Warna latar belakang tabel */
}

/* Pengaturan border dan tampilan tabel */
table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 8px;
    text-align: left;
    font-size: 14px; /* Ukuran teks tabel */
    white-space: nowrap; /* Menghindari teks terpotong */
    overflow: hidden;
    text-overflow: ellipsis;
}

th {
    background-color: #ff80ab; /* Warna header tabel */
    color: white;
}

.action-buttons {
    display: flex;
    gap: 10px; /* Jarak antara tombol */
    justify-content: flex-end; /* Mengatur tombol ke kanan */
    margin-bottom: 20px; /* Jarak bawah untuk memisahkan tombol dan tabel */
}

</style>    
</head>

<div class="container">
    <h2>Tambah Transaksi</h2>
    <form action="{{ route('transaksi.store') }}" method="POST" id="transaksiForm">
        @csrf
        <div class="form-group">
            <label for="tanggal_transaksi">Tanggal Transaksi:</label>
            <input type="date" class="form-control" name="tanggal_transaksi" required>
        </div>

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

        <div class="form-group">
            <label for="harga_jual">Harga Jual:</label>
            <input type="text" class="form-control" id="harga_jual" readonly>
        </div>

        <div class="form-group">
            <label for="jumlah_beli">Jumlah Beli:</label>
            <input type="number" class="form-control" id="jumlah_beli" min="1" name="jumlah_beli">
        </div>

        <button type="button" class="btn btn-primary" id="tambahBarang">Tambah Barang</button>

        <hr>

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
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Transaksi</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>
<body>
    <div class="container">
        <h2>Tambah Transaksi</h2>
        <form action="{{ route('transaksi.store') }}" method="POST" id="transaksiForm">
            @csrf
            <div class="table-section">
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
                <input type="number" class="form-control" id="harga_jual" readonly>
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
