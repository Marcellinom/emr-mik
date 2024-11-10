<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to right, #e0e7ff, #ffffff);
            overflow: hidden;
        }

        .left-side {
            flex: 1;
            height: 100vh;
            width: 80vh;
        }

        .left-side img {
            height: 100%;
        }

        .right-side {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-right: 10vh;
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 150px;
            height: auto;
        }

        .title {
            font-size: 1.5em;
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            font-size: 0.9em;
            color: #666666;
            display: block;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 1em;
        }

        .remember {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .remember input {
            margin-right: 10px;
        }

        .forgot-password {
            text-align: right;
            margin-top: 10px;
            font-size: 0.9em;
        }

        .forgot-password a {
            color: #0073e6;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .login-button {
            background-color: #003366;
            color: #ffffff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
            transition: background-color 0.3s;
        }

        .login-button:hover {
            background-color: #00509e;
        }
    </style>
</head>
<body>
<div class="left-side">
    <img src="{{asset('icon/ueu-bekasi.jpg')}}" alt="Logo">
</div>
<div class="right-side">
    <div class="logo">
        <img src="{{asset('icon/LOGO-fikes-2.webp')}}" alt="Logo"> <!-- Replace with your logo URL -->
    </div>
    <div class="title">Masuk ke Akun Anda</div>
    <form method="post" action="login">
        @csrf
        <div class="input-group">
            <label for="username">Username/ID</label>
            <input type="text" id="username" name="username" placeholder="00001234">
        </div>
        <div class="input-group">
            <label for="password">Kata Sandi</label>
            <input type="password" id="password" name="password" placeholder="********">
        </div>
        <div class="remember">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Ingat Saya</label>
        </div>
{{--        <div class="forgot-password">--}}
{{--            <a href="#">Lupa kata sandi?</a>--}}
{{--        </div>--}}
        <button type="submit" class="login-button">MASUK</button>
    </form>
</div>
</body>
</html>
