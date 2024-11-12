<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
    
        .subtitle {
            font-size: 24px;
            color: #8A5E41; /* Coklat untuk judul */
            padding-bottom: 10px;
            border-bottom: 2px solid #ccc;
            margin-bottom: 20px;
        }
    
        .btn {
            background-color: #8A5E41; /* Warna coklat untuk tombol */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }
    
        .btn:hover {
            background-color: #7A4B31; /* Warna coklat gelap saat hover */
        }
    
        .btn-delete {
            background-color: #d9534f; /* Warna merah untuk tombol hapus */
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
    
        .btn-delete:hover {
            background-color: #a70000; /* Warna merah gelap saat hover */
        }
    
        .btn-edit {
            background-color: #f0ad4e; /* Warna oranye untuk tombol edit */
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
    
        .btn-edit:hover {
            background-color: #ec971f; /* Warna oranye gelap saat hover */
        }
    
        .box {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
    
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
    
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
    
        th {
            background-color: #8A5E41; /* Warna coklat untuk header tabel */
            color: white;
            text-align: center; /* Menengahkan teks header */
        }
    
        td {
            background-color: white;
        }
    
        .action-buttons {
            display: flex;
            gap: 10px;
        }
    
        .container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
        }
    
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            color: white;
            background-color: #28a745;
        }
    </style>  
</head>
<body>
    <div class="container">
        <div class="subtitle">Daftar Pengguna</div>
        <div class="box">
            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif
            <a href="{{ route('pengguna.create') }}" class="btn">Tambah Pengguna</a>
            <table>
                <thead>
                    <tr>
                        <th>ID Pengguna</th>
                        <th>Nama Pengguna</th>
                        <th>No. Telepon</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengguna as $pengguna)
                    <tr>
                        <td>{{ $pengguna->id_pengguna }}</td>
                        <td>{{ $pengguna->nama_pengguna }}</td>
                        <td>{{ $pengguna->no_telepon }}</td>
                        <td>{{ $pengguna->username }}</td>
                        <td class="action-buttons">
                            <a href="{{ route('pengguna.edit', $pengguna->id_pengguna) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('pengguna.destroy', $pengguna->id_pengguna) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
