<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Management')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #0d0d2b !important;
            min-height: 100vh;
            color: #ffffff !important;
        }

        /* ===== ANIMATED BACKGROUND ===== */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(135deg, #0d0d2b 0%, #1a1a4e 50%, #0d0d2b 100%);
        }
        .bg-animation::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
            top: -200px;
            right: -200px;
            animation: float 20s ease-in-out infinite;
        }
        .bg-animation::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(118, 75, 162, 0.08) 0%, transparent 70%);
            bottom: -150px;
            left: -150px;
            animation: float 25s ease-in-out infinite reverse;
        }
        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(50px, -50px) scale(1.1); }
            66% { transform: translate(-30px, 30px) scale(0.9); }
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: rgba(255,255,255,0.03) !important;
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: 18px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar-custom .navbar-brand {
            color: #fff !important;
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
        }
        .navbar-custom .navbar-brand i {
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 10px;
            border-radius: 12px;
            margin-right: 12px;
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
        }
        .navbar-custom .navbar-brand span {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .navbar-custom .nav-link {
            color: rgba(255,255,255,0.6) !important;
            font-weight: 600;
            padding: 8px 22px !important;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        .navbar-custom .nav-link:hover {
            color: #fff !important;
            transform: translateY(-2px);
        }
        .navbar-custom .nav-link.active {
            color: #fff !important;
            background: rgba(102, 126, 234, 0.15);
        }
        .navbar-custom .nav-link i {
            margin-right: 8px;
        }
        .navbar-toggler {
            border-color: rgba(255,255,255,0.1);
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255,255,255,0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            padding: 50px 20px;
            min-height: 80vh;
            position: relative;
            z-index: 1;
        }

        /* ===== CARDS ===== */
        .card-custom {
            background: rgba(255,255,255,0.03) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,0.06);
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        }

        /* ===== BUTTONS ===== */
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: #fff !important;
            padding: 12px 32px;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 45px rgba(102, 126, 234, 0.4);
            color: #fff !important;
        }
        .btn-primary-custom i {
            margin-right: 10px;
        }

        .btn-outline-custom {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.12);
            color: rgba(255,255,255,0.7);
            padding: 6px 18px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 0.85rem;
        }
        .btn-outline-custom:hover {
            background: rgba(255,255,255,0.05);
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-danger-custom {
            background: linear-gradient(135deg, #f093fb, #f5576c);
            border: none;
            color: #fff !important;
            padding: 6px 18px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.85rem;
            cursor: pointer;
        }
        .btn-danger-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(245, 87, 108, 0.3);
            color: #fff !important;
        }

        /* ===== ALERTS ===== */
        .alert-custom-success {
            background: rgba(56, 239, 125, 0.08);
            border: 1px solid rgba(56, 239, 125, 0.12);
            color: #38ef7d;
            border-radius: 16px;
            padding: 15px 20px;
            backdrop-filter: blur(10px);
        }
        .alert-custom-error {
            background: rgba(245, 87, 108, 0.08);
            border: 1px solid rgba(245, 87, 108, 0.12);
            color: #f5576c;
            border-radius: 16px;
            padding: 15px 20px;
            backdrop-filter: blur(10px);
        }

        /* ===== TABLE ===== */
        .table-custom {
            color: #ffffff !important;
            border-collapse: separate;
            border-spacing: 0 8px;
            width: 100%;
        }
        .table-custom thead th {
            color: rgba(255,255,255,0.5) !important;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 14px 18px;
            border: none;
            background: transparent !important;
        }
        .table-custom tbody tr {
            background: rgba(255,255,255,0.04) !important;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .table-custom tbody tr:hover {
            background: rgba(255,255,255,0.08) !important;
            transform: scale(1.01);
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
        }
        .table-custom tbody td {
            padding: 14px 18px;
            border: none;
            color: #ffffff !important;
            vertical-align: middle;
            font-size: 0.95rem;
        }
        .table-custom tbody td:first-child {
            border-radius: 12px 0 0 12px;
        }
        .table-custom tbody td:last-child {
            border-radius: 0 12px 12px 0;
        }

        /* ===== BADGE ===== */
        .badge-custom {
            background: rgba(102, 126, 234, 0.15);
            border: 1px solid rgba(255,255,255,0.06);
            padding: 5px 18px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.8rem;
            color: #ffffff !important;
        }

        /* ===== FORM ===== */
        .form-control-custom {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 14px;
            padding: 14px 20px;
            color: #fff !important;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            outline: none;
        }
        .form-control-custom:focus {
            border-color: #667eea;
            background: rgba(255,255,255,0.05);
            box-shadow: 0 0 40px rgba(102, 126, 234, 0.05);
        }
        .form-control-custom::placeholder {
            color: rgba(255,255,255,0.2);
        }
        .form-label-custom {
            color: rgba(255,255,255,0.6);
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 8px;
        }
        .text-error {
            color: #f5576c;
            font-size: 0.8rem;
            margin-top: 6px;
        }

        /* ===== HEADINGS ===== */
        .page-title {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .page-subtitle {
            color: rgba(255,255,255,0.3);
            font-size: 0.95rem;
        }

        /* ===== FOOTER ===== */
        .footer-custom {
            background: rgba(255,255,255,0.01);
            border-top: 1px solid rgba(255,255,255,0.02);
            padding: 25px 0;
            text-align: center;
            color: rgba(255,255,255,0.1);
            font-size: 0.85rem;
            margin-top: 40px;
        }
        .footer-custom a {
            color: rgba(102, 126, 234, 0.5);
            text-decoration: none;
            font-weight: 600;
        }
        .footer-custom a:hover {
            color: #667eea;
        }

        @media (max-width: 600px) {
            .main-content { padding: 20px 10px; }
            .page-title { font-size: 1.6rem; }
            .card-custom { padding: 20px; }
            .table-custom { font-size: 0.75rem; }
            .table-custom thead th, .table-custom tbody td { padding: 10px 12px; }
        }
    </style>
</head>
<body>

    <div class="bg-animation"></div>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('students.index') }}">
                <i class="fas fa-graduation-cap"></i> 
                <span>Student</span>Manager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('students.index') ? 'active' : '' }}" 
                           href="{{ route('students.index') }}">
                            <i class="fas fa-users"></i> Students
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('students.create') ? 'active' : '' }}" 
                           href="{{ route('students.create') }}">
                            <i class="fas fa-user-plus"></i> Add Student
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/courses">
                            <i class="fas fa-book"></i> Courses
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="container main-content">
        @yield('content')
    </div>

    <!-- ===== FOOTER ===== -->
    <div class="footer-custom">
        <div class="container">
            <p class="mb-0">
                &copy; {{ date('Y') }} <a href="#">Bisma Khan</a> • 
                Laravel Internship • Day 11
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>