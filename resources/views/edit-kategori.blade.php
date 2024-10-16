<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>
<body>
    <div class="container">
        <h1>Ubah Data Kategori</h1>
        <form action="/edit-kategori/{{$kategori->id_kategori}}" method="POST">
            @csrf
            @method('PUT')
            <div class="table-section"> 
            <div class="form-group">
                <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" placeholder="Nama Kategori" required>
            </div>
            <button type="submit">Simpan</button>
        </form>
    </div>
</div>
</body>
</html>
