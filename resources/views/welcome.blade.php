<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Task Management') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            height: 100%;
            font-family: 'Instrument Sans', sans-serif;
        }
        
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 60px 40px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            text-align: center;
        }
        
        h1 {
            font-size: 3.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 50px;
            letter-spacing: -1px;
        }
        
        .button-group {
            display: flex;
            gap: 20px;
            flex-direction: column;
        }
        
        .btn {
            padding: 14px 32px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 10px;
            border: 2px solid;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-block;
            text-align: center;
        }
        
        .btn-login {
            background-color: #667eea;
            color: white;
            border-color: #667eea;
        }
        
        .btn-login:hover {
            background-color: #5a6fd8;
            border-color: #5a6fd8;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        
        .btn-signup {
            background-color: #764ba2;
            color: white;
            border-color: #764ba2;
        }
        
        .btn-signup:hover {
            background-color: #663a8f;
            border-color: #663a8f;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(118, 75, 162, 0.3);
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 40px 25px;
            }
            
            h1 {
                font-size: 2.5rem;
                margin-bottom: 40px;
            }
            
            .btn {
                padding: 12px 24px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome</h1>
        <div class="button-group">
            <a href="{{ route('login') }}" class="btn btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn btn-signup">Sign Up</a>
        </div>
    </div>
</body>
</html>
