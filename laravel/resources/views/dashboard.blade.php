<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0d0d2b, #1a1a4e);
            padding: 20px;
        }
        .navbar {
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.04);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 16px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }
        .navbar .brand {
            color: #ffffff;
            font-size: 1.3rem;
            font-weight: 700;
        }
        .navbar .brand span {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .navbar .user-info .name {
            color: rgba(255,255,255,0.7);
            font-size: 0.95rem;
        }
        .navbar .user-info .email {
            color: rgba(255,255,255,0.3);
            font-size: 0.85rem;
        }
        .navbar .user-info .logout-btn {
            padding: 8px 20px;
            border-radius: 50px;
            border: 1px solid rgba(245,87,108,0.2);
            background: transparent;
            color: #f5576c;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .navbar .user-info .logout-btn:hover {
            background: rgba(245,87,108,0.1);
        }
        .dashboard-container {
            max-width: 700px;
            margin: 0 auto;
        }
        .welcome-card {
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,0.06);
            padding: 50px 40px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.4);
            text-align: center;
        }
        .welcome-card h1 {
            font-size: 2.2rem;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
        }
        .welcome-card h1 span {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .welcome-card .subtitle {
            color: rgba(255,255,255,0.3);
            font-size: 1rem;
            margin-top: 8px;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 15px;
            margin: 30px 0 35px;
        }
        .stat-card {
            background: rgba(255,255,255,0.03);
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.04);
            padding: 20px 15px;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            border-color: rgba(102,126,234,0.2);
        }
        .stat-card .label {
            color: rgba(255,255,255,0.2);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .stat-card .value {
            color: #ffffff;
            font-size: 1.8rem;
            font-weight: 700;
            margin-top: 4px;
        }
        .actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 12px;
        }
        .actions a {
            padding: 12px 32px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            font-size: 0.95rem;
            color: #fff;
        }
        .actions a:hover {
            transform: translateY(-2px);
        }
        .btn-purple {
            background: linear-gradient(135deg, #667eea, #764ba2);
            box-shadow: 0 8px 30px rgba(102,126,234,0.15);
        }
        .btn-purple:hover {
            box-shadow: 0 12px 40px rgba(102,126,234,0.25);
        }
        .btn-green {
            background: linear-gradient(135deg, #38ef7d, #11998e);
            box-shadow: 0 8px 30px rgba(56,239,125,0.15);
        }
        .btn-green:hover {
            box-shadow: 0 12px 40px rgba(56,239,125,0.25);
        }
        .btn-blue {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            box-shadow: 0 8px 30px rgba(79,172,254,0.15);
        }
        .btn-blue:hover {
            box-shadow: 0 12px 40px rgba(79,172,254,0.25);
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .footer p {
            color: rgba(255,255,255,0.06);
            font-size: 0.75rem;
        }
        @media (max-width: 600px) {
            .navbar { flex-direction: column; text-align: center; }
            .welcome-card { padding: 30px 20px; }
            .welcome-card h1 { font-size: 1.6rem; }
            .stats { grid-template-columns: 1fr 1fr; }
            .actions a { width: 100%; text-align: center; }
        }
    </style>
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <div class="navbar">
        <div class="brand"><span>Student</span>Manager</div>
        <div class="user-info">
            <span class="name">{{ Auth::user()->name }}</span>
            <span class="email">{{ Auth::user()->email }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Log Out</button>
            </form>
        </div>
    </div>

    <!-- ===== DASHBOARD ===== -->
    <div class="dashboard-container">

        <div class="welcome-card">
            <h1>Welcome, <span>{{ Auth::user()->name }}</span></h1>
            <p class="subtitle">You are logged in to your dashboard</p>

            <!-- Stats -->
            <div class="stats">
                <div class="stat-card">
                    <div class="label">Students</div>
                    <div class="value">{{ \App\Models\Student::count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="label">Courses</div>
                    <div class="value">{{ \App\Models\Course::count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="label">Enrollments</div>
                    <div class="value">{{ \App\Models\Student::with('courses')->get()->sum(fn($s) => $s->courses->count()) }}</div>
                </div>
            </div>

            <!-- Actions -->
            <div class="actions">
                <a href="/students" class="btn-purple">View Students</a>
                <a href="/students/create" class="btn-green">Add Student</a>
                <a href="/courses" class="btn-blue">View Courses</a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Laravel Internship Program • Day 12</p>
        </div>

    </div>

</body>
</html>