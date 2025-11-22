<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Task Management') }} - Register</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        html,body { height:100%; font-family:'Instrument Sans',sans-serif; }
        body { display:flex; align-items:center; justify-content:center; background:linear-gradient(135deg,#667eea 0%,#764ba2 100%); min-height:100vh; padding:20px; }
        .register-container { background:rgba(255,255,255,0.95); border-radius:20px; padding:32px 28px; max-width:520px; width:100%; box-shadow:0 20px 60px rgba(0,0,0,0.15); }
        .register-header { text-align:center; margin-bottom:20px; }
        .register-header h1 { font-size:2.25rem; font-weight:700; color:#1a1a1a; margin-bottom:6px; }
        .register-header p { font-size:13px; color:#706f6c; }
        .form-group { margin-bottom:12px; text-align:left; }
        .form-group label { display:block; font-size:14px; font-weight:600; color:#1a1a1a; margin-bottom:8px; }
        .form-group input[type="text"], .form-group input[type="email"], .form-group input[type="password"], .form-group select { width:100%; padding:12px 15px; font-size:15px; border:2px solid #e0e0e0; border-radius:8px; background-color:#fafafa; color:#1a1a1a; transition:all .3s ease; }
        .form-group input:hover, .form-group select:hover { border-color:#667eea; background-color:#fff; }
        .form-group input:focus, .form-group select:focus { outline:none; border-color:#667eea; box-shadow:0 0 0 3px rgba(102,126,234,0.1); }
        .invalid-feedback { display:block; color:#dc3545; font-size:13px; margin-top:6px; }
        .submit-button { width:100%; padding:14px; font-size:16px; font-weight:600; color:white; background-color:#667eea; border:2px solid #667eea; border-radius:8px; cursor:pointer; transition:all .3s ease; }
        .submit-button:hover { background-color:#5a6fd8; border-color:#5a6fd8; transform:translateY(-2px); box-shadow:0 10px 25px rgba(102,126,234,0.3); }
        .bottom-note { text-align:center; padding-top:18px; border-top:1px solid #e9e9e9; margin-top:14px; }
        .bottom-note a { color:#667eea; font-weight:600; text-decoration:none; }
        @media (max-width:600px) { .register-container{ padding:36px 22px } .register-header h1{ font-size:2rem } .form-group input, .form-group select{ font-size:14px; padding:10px 12px } .submit-button{ padding:12px } }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h1>Register</h1>
            <p>Create your account for Task Management</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus class="@error('name') is-invalid @enderror">
                @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="@error('email') is-invalid @enderror">
                @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" class="@error('password') is-invalid @enderror">
                @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="form-group">
                <label for="role">{{ __('Select Your Role') }}</label>
                <select id="role" name="role" required>
                    <option value="">-- Choose a role --</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="developer" {{ old('role') === 'developer' ? 'selected' : '' }}>Developer</option>
                    <option value="tester" {{ old('role') === 'tester' ? 'selected' : '' }}>Tester</option>
                    <option value="pm" {{ old('role') === 'pm' ? 'selected' : '' }}>Project Manager</option>
                </select>
                @error('role')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>

            <button type="submit" class="submit-button">{{ __('Register') }}</button>

            <div class="bottom-note">
                <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>
