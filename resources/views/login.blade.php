<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/new.css') }}?v={{ time() }}">
    <title>Login</title>
</head>

<body>
    @auth
        <div class="login-container">
            <form action="{{ route('logout.submit') }}" method="POST">
                @csrf
                <button>Log Out</button>
            </form>
        </div>
    @else
        <div class="login-container">
            <h1>Welcome Back to RPS Collection!</h1>

            <!-- Menampilkan pesan error jika login gagal -->
            @if ($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Username Input -->
                <div>
                    <input type="text" id="username" name="username" placeholder="Masukkan username" required>
                </div>

                <!-- Password Input -->
                <div>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit">Login</button>
            </form>
        </div>
    @endauth
</body>

</html>
