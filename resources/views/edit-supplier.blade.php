<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/form.css') }}" rel="stylesheet"> <!-- Link ke form.css -->
    <title>Ubah Supplier</title>
</head>
<body>
    @extends('layouts.sidebar')

    @section('title', 'Ubah Supplier')

    @section('header', 'Ubah Supplier')

    @section('content')
    <div class="form-container"> <!-- Menambahkan form-container -->
        <form action="{{ route('suppliers.update', $supplier->id_supplier) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nama_supplier">Nama Supplier</label>
            <input type="text" id="nama_supplier" name="nama_supplier" value="{{ $supplier->nama_supplier }}" required>
            
            <label for="no_telp">No. Telepon</label>
            <input type="number" id="no_telp" name="no_telp" value="{{ $supplier->no_telp }}" required>
            
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" value="{{ $supplier->alamat }}" required>
            
            <!-- Tombol untuk menyimpan perubahan -->
            <button type="submit" class="save-btn">Simpan Perubahan</button>
            
            <!-- Tombol untuk batal -->
            <button type="button" onclick="location.href='{{ route('suppliers.index') }}'" class="btn-cancel">Batal</button>
        </form>
    </div>
    @endsection

    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>
</html>
