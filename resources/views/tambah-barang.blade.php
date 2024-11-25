<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #8A5E41;
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-section {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #8A5E41;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"], input[type="number"], select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn-save {
            padding: 12px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            background-color: #8A5E41;
            transition: background-color 0.3s ease;
            width: 100%;
            text-align: center;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .btn-save:hover {
            background-color: #7A4B31;
        }

        .btn-cancel {
            background-color: #d50000;
        }

        .btn-cancel:hover {
            background-color: #a70000;
        }
    </style>
</head>
<body>
    <h1>Tambah Barang</h1>
    <div class="form-section">
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            
            <label for="id_barang_masuk">Barang Masuk</label>
            <select name="id_barang_masuk" id="id_barang_masuk" required>
                <option value="">Pilih Barang Masuk</option>
                @foreach($barangMasuk as $item)
                    <option value="{{ $item->id_barang_masuk }}">
                        {{ $item->nama_barang }} - {{ $item->kategori }} - Stok: {{ $item->stok_barang }}
                    </option>
                @endforeach
            </select>

            <label for="harga_jual">Harga Jual</label>
            <input type="number" name="harga_jual" id="harga_jual" placeholder="Harga Jual" required min="0" step="0.01">

            <button type="submit" class="btn-save">Simpan</button>
            
            <!-- Tombol Batal -->
            <button type="button" onclick="location.href='{{ route('barang.index') }}'" class="btn-cancel">Batal</button>
        </form>
    </div>
</body>
</html>
