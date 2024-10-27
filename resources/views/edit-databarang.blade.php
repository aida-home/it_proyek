<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
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
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"], input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn {
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

        .btn:hover {
            background-color: #7A4B31;
        }

        .btn-cancel {
            background-color: #d50000;
        }

        .error {
            color: red;
            margin-bottom: 20px;
            font-size: 14px; /* Ukuran font error lebih kecil */
        }
    </style>
</head>
<body>
    <h1>Edit Barang</h1>

    <div class="form-section">
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('databarang.update', $databarang->id_databarang) }}" method="POST">
            @csrf
            @method('PUT') <!-- Method untuk update data -->

            <label for="nama_barang">Nama Barang</label>
            <input type="text" id="nama_barang" name="nama_barang" value="{{ $databarang->nama_barang }}" required>

            <label for="kategori">Kategori</label>
            <input type="text" id="kategori" name="kategori" value="{{ $databarang->kategori }}" required>

            <label for="stok_barang">Stok Barang</label>
            <input type="number" id="stok_barang" name="stok_barang" value="{{ $databarang->stok_barang }}" required min="0">

            <label for="harga_jual">Harga Jual</label>
            <input type="number" id="harga_jual" name="harga_jual" value="{{ $databarang->harga_jual }}" required min="0" step="0.01">

            <button type="submit" class="btn">Simpan Perubahan</button>
            <button type="button" onclick="location.href='{{ route('databarang.index') }}'" class="btn btn-cancel">Batal</button>
        </form>
    </div>
</body>
</html>
