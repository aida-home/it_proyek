<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
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

        input[type="text"], input[type="password"], input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .password-hint {
            color: #888;
            font-size: 12px;
            margin-top: -15px;
            margin-bottom: 20px;
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
    </style>
</head>
<body>
    <h1>Tambah Pengguna</h1>
    <div class="form-section">
        <form action="{{ route('penggunas.store') }}" method="POST">
            @csrf
            <label for="nama_pengguna">Nama Pengguna</label>
            <input type="text" id="nama_pengguna" name="nama_pengguna" placeholder="Nama Pengguna" required>
            @error('nama_pengguna')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="no_telepon">No. Telepon</label>
            <input type="text" id="no_telepon" name="no_telepon" placeholder="No. Telepon" required>
            @error('no_telepon')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username" required>
            @error('username')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required pattern=".{8,}" title="Password minimal 8 karakter">
            <div class="password-hint">Password minimal 8 karakter.</div>
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
            
            <button type="submit" class="btn">Simpan</button>
            <button type="button" onclick="location.href='{{ route('penggunas.index') }}'" class="btn btn-cancel">Batal</button>
        </form>
    </div>
</body>
</html>
