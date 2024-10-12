<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <title>Situs Web Sederhana</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #F6F6F6;
            margin: 0;
            padding: 0;
            color: #333;
        }
        header {
            background-color: #E799A3;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            font-size: 2.5em;
            margin: 0;
        }
        .container {
            margin: 40px auto;
            padding: 30px;
            max-width: 800px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            font-size: 1.8em;
            color: #E799A3
        }
        .container p {
            font-size: 1.1em;
            line-height: 1.6;
        }
        .time-box {
            background-color: #E799A3;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 1.2em;
        }
        footer {
            text-align: center;
            padding: 15px;
            background-color: #1E1E1E;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
            box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1);
        }
        footer a {
            color: #E799A3;
            text-decoration: none;
        }
        .social-icons {
            margin-top: 10px;
        }
        .social-icons a {
            margin: 0 10px;
            color: white;
            font-size: 1.2em;
        }
    </style>
</head>
<body>

<header>
    <h1>Selamat Datang di Website Aida!</h1>
</header>

<div class="container">
    <h2>Halo, Pengunjung!</h2>
    <p>Semoga hari-harimu menyenangkan meskipun banyak hal yang harus dihadapi hari</p>
    <div class="time-box">
        <i class="fas fa-clock"></i> Tanggal dan waktu saat ini: 
        <?php
        echo date('d-m-Y H:i:s');
        ?>
    </div>
</div>

<footer>
    &copy; 2024 Situs Web Sederhana | <a href="#">Kebijakan Privasi</a>
    <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
</footer>

</body>
</html>