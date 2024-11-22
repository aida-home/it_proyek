<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Styling dasar */
        body {
            margin: 0;
            padding: 0;
            background-color: #8A5E41; /* Warna background cokelat */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container form login */
        .login-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 350px;
            text-align: center;
        }

        .login-container h1 {
            font-size: 24px;
            color: #8A5E41;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        /* Input dan button styling */
        .login-container input,
        .login-container button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box; /* Memastikan padding dan border dihitung dalam lebar elemen */
        }

        .login-container input {
            border: 1px solid #ccc;
        }

        .login-container input:focus {
            border-color: #8A5E41;
            outline: none;
        }

        .login-container button {
            background-color: #8A5E41;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #6f4c32;
        }

        /* Styling untuk pesan error */
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        /* Styling untuk pesan selamat datang */
        .welcome-message {
            font-size: 18px;
            color: #8A5E41;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    @auth
    <div class="login-container">
        <p class="welcome-message">Selamat datang, {{ Auth::user()->username }}!</p>
        <form action="{{ route('logout.submit') }}" method="POST">
            @csrf
            <button>Log Out</button>
        </form>
    </div>
    @else
    <div class="login-container">
        <h1>Welcome Back to<br>RPS Collection!</h1>

        <!-- Menampilkan pesan error jika login gagal -->
        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
        
            <!-- Username Input -->
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
        
            <!-- Password Input -->
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
        
            <button type="submit">Login</button>
        </form>
              
        
    </div>
    @endauth
</body>
</html>
