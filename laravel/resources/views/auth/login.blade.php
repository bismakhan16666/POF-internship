<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: linear-gradient(135deg, #0d0d2b, #1a1a4e);
        }
        .container { width: 100%; max-width: 420px; }
        .title { text-align: center; margin-bottom: 35px; }
        .title h1 { font-size: 2rem; font-weight: 700; color: #ffffff; }
        .title p { color: rgba(255,255,255,0.35); font-size: 0.95rem; margin-top: 8px; }
        .card {
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.06);
            padding: 40px 35px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.4);
        }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            color: rgba(255,255,255,0.5);
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .form-group input {
            width: 100%;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.06);
            background: rgba(255,255,255,0.02);
            color: #ffffff;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }
        .form-group input:focus {
            border-color: #667eea;
            box-shadow: 0 0 30px rgba(102,126,234,0.05);
        }
        .form-group input::placeholder { color: rgba(255,255,255,0.2); }
        .error-msg { color: #f5576c; font-size: 0.8rem; margin-top: 6px; }
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .form-options label {
            color: rgba(255,255,255,0.35);
            font-size: 0.85rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .form-options a {
            color: rgba(255,255,255,0.4);
            text-decoration: none;
            font-size: 0.85rem;
            transition: 0.3s;
        }
        .form-options a:hover { color: #667eea; }
        .btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(102,126,234,0.25);
        }
        .footer-text {
            text-align: center;
            margin-top: 22px;
            color: rgba(255,255,255,0.25);
            font-size: 0.9rem;
        }
        .footer-text a {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }
        .footer-text a:hover { color: #667eea; }
        .alert-success {
            color: #38ef7d;
            background: rgba(56,239,125,0.06);
            padding: 12px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid rgba(56,239,125,0.08);
            text-align: center;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="title">
            <h1>Welcome Back</h1>
            <p>Sign in to your account</p>
        </div>

        <div class="card">

            @if(session('status'))
                <div class="alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                    @error('email')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required placeholder="Enter your password">
                    @error('password')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-options">
                    <label>
                        <input type="checkbox" name="remember" style="accent-color: #667eea; width: 16px; height: 16px; cursor: pointer;">
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="btn">Sign In</button>

                <div class="footer-text">
                    Don't have an account? <a href="{{ route('register') }}">Create one</a>
                </div>
            </form>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <p style="color: rgba(255,255,255,0.08); font-size: 0.75rem;">Laravel Internship Program</p>
        </div>

    </div>
</body>
</html>