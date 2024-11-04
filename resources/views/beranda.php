<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beranda</title>
</head>
<body>
    <a href="/beranda"> Beranda </a>
    <h1> Halaman Beranda </h1>

    {{-- login masuk sini --}}
    @auth
    <p>Anda berhasil login</p>
    <form action="/logout" method="POST">
    @csrf
    <button>Log Out</button>
    </form>

    {{-- tidak login masuk sini --}}
    @else
    <div style="border: 3px solid black;">
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="name">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="text" placeholder="password">
            <button>Register</button>
        </form>
    </div>

    <div style="border: 3px solid black;">
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="name">
            <input name="loginpassword" type="text" placeholder="password">
        </form>
    </div>
    @endauth
</body>
</html>
