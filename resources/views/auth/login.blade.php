<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Task Management') }} - Login</title>
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
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 50px 40px;
            max-width: 450px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }
        
        .login-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 10px;
        }
        
        .login-header p {
            font-size: 14px;
            color: #706f6c;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
        }
        
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            font-size: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            background-color: #fafafa;
            color: #1a1a1a;
            transition: all 0.3s ease;
            font-family: 'Instrument Sans', sans-serif;
        }
        
        .form-group input[type="email"]:hover,
        .form-group input[type="password"]:hover {
            border-color: #667eea;
            background-color: #fff;
        }
        
        .form-group input[type="email"]:focus,
        .form-group input[type="password"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background-color: #fff;
        }
        
        .form-group input.is-invalid,
        .form-group input.is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
        }
        
        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            cursor: pointer;
            accent-color: #667eea;
        }
        
        .remember-me label {
            font-size: 14px;
            color: #706f6c;
            cursor: pointer;
            margin: 0;
        }

        .role-selector {
            margin-bottom: 25px;
            text-align: left;
        }

        .role-selector label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .role-selector select {
            width: 100%;
            padding: 12px 15px;
            font-size: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            background-color: #fafafa;
            color: #1a1a1a;
            transition: all 0.3s ease;
            font-family: 'Instrument Sans', sans-serif;
            cursor: pointer;
        }

        .role-selector select:hover {
            border-color: #667eea;
            background-color: #fff;
        }

        .role-selector select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background-color: #fff;
        }

        .role-selector select option {
            padding: 10px;
            background-color: #fff;
            color: #1a1a1a;
        }
        
        .login-button {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            background-color: #667eea;
            border: 2px solid #667eea;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 15px;
        }
        
        .login-button:hover {
            background-color: #5a6fd8;
            border-color: #5a6fd8;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        
        .forgot-password {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .forgot-password a {
            font-size: 14px;
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .forgot-password a:hover {
            color: #5a6fd8;
            text-decoration: underline;
        }
        
        .signup-link {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }
        
        .signup-link p {
            font-size: 14px;
            color: #706f6c;
            margin: 0;
        }
        
        .signup-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .signup-link a:hover {
            color: #5a6fd8;
            text-decoration: underline;
        }
        
        @media (max-width: 600px) {
            .login-container {
                padding: 40px 25px;
            }
            
            .login-header h1 {
                font-size: 2rem;
            }
            
            .form-group input[type="email"],
            .form-group input[type="password"] {
                font-size: 14px;
                padding: 10px 12px;
            
                        .role-selector select {
                            font-size: 14px;
                            padding: 10px 12px;
                        }
            }
            
            .login-button {
                padding: 12px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Login</h1>
            <p>Welcome back to Task Management</p>
        </div>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="role-selector">
                <label for="role">{{ __('Select Your Role') }}</label>
                <select id="role" name="role" required>
                    <option value="">-- Choose a role --</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="developer" {{ old('role') === 'developer' ? 'selected' : '' }}>Developer</option>
                    <option value="tester" {{ old('role') === 'tester' ? 'selected' : '' }}>Tester</option>
                    <option value="pm" {{ old('role') === 'pm' ? 'selected' : '' }}>Project Manager</option>
                </select>
            </div>
                        <div class="remember-me">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">{{ __('Remember Me') }}</label>
            </div>
            <button type="submit" class="login-button">{{ __('Login') }}</button>
            
            @if (Route::has('password.request'))
                <div class="forgot-password">
                    <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                </div>
            @endif
            
            <div class="signup-link">
                <p>Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
            </div>
        </form>
    </div>
</body>
</html>
