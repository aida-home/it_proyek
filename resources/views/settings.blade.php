<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ganti Nomor Whatsapp</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ time() }}">
</head>

<body>
    @extends('layouts.sidebar')

    @section('title', 'Integrasi')

    @section('header', 'Ubah Nomor Tujuan Notifikasi')

    @section('content')
    <div class="form-container">
            <form action="{{ route('settings.update') }}" method="POST">
                @csrf
                @method('PUT') <!-- Karena ini menggunakan metode PUT untuk update data -->
                <div class="table-section">
                <div class="form-group">
                    <label for="whatsapp_number">Nomor WhatsApp:</label>
                    <input type="text" id="whatsapp_number" name="whatsapp_number" class="form-control"
                        value="{{ old('whatsapp_number', $setting->whatsapp_number) }}" required>
                </div>

                <button type="submit" class="save-btn">Simpan Perubahan</button>
                <button type="button" onclick="location.href='{{ route('dashboard') }}'"
                    class="btn btn-cancel">Batal</button>
            </form>
        </div>
        </div>
    @endsection

</body>

</html>
