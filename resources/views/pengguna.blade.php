<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #8A5E41;
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 20px;
            color: #333;
            padding-bottom: 10px;
            border-bottom: 2px solid #ccc;
            margin-bottom: 0;
        }

        .btn {
            background-color: #8A5E41;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #7A4B31;
        }

        .btn-delete {
            background-color: #d50000;
        }

        .btn-delete:hover {
            background-color: #a70000;
        }

        .btn-edit {
            background-color: #f0ad4e;
        }

        .btn-edit:hover {
            background-color: #ec971f;
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
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .container {
            background-color: #f9f9f9;
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
    <h1>Data Pengguna</h1>

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
                    @foreach ($pengguna as $user)
                    <tr>
                        <td>{{ str_pad($user->id_pengguna, 2, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $user->nama_pengguna }}</td>
                        <td>{{ $user->no_telepon }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('pengguna.edit', $user->id_pengguna) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('pengguna.destroy', $user->id_pengguna) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
