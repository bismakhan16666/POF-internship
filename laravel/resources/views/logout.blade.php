<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0d0d2b, #1a1a4e);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,0.06);
            text-align: center;
            max-width: 400px;
        }
        h1 { color: #fff; }
        p { color: rgba(255,255,255,0.4); }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 50px;
            background: linear-gradient(135deg, #f5576c, #f093fb);
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(245,87,108,0.3); }
        .btn-cancel {
            background: linear-gradient(135deg, #667eea, #764ba2);
            margin-left: 10px;
        }
        .btn-cancel:hover { box-shadow: 0 10px 30px rgba(102,126,234,0.3); }
    </style>
</head>
<body>
    <div class="card">
        <h1>Logout</h1>
        <p>Are you sure you want to logout?</p>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn">Yes, Logout</button>
        </form>
        <a href="/dashboard" class="btn btn-cancel">Cancel</a>
    </div>
</body>
</html>