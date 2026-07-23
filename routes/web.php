<?php

use Illuminate\Support\Facades\Route;

// ============================================
// DAY 4 -  LARAVEL PROGRAM
// ============================================

// ========== HOME PAGE ==========
Route::get('/', function () {
    $name = "Bisma Khan";
    $course = "Laravel Internship";
    $institute = "POF";
    $year = date('Y');
    $time = date('h:i A');
    $date = date('l, F j, Y');
    
    return "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Laravel - Day 4</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
            }

            .card {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(20px);
                padding: 40px;
                border-radius: 24px;
                border: 1px solid rgba(255, 255, 255, 0.08);
                max-width: 550px;
                width: 100%;
                text-align: center;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
                transition: 0.3s;
            }

            .card:hover {
                transform: translateY(-5px);
                border-color: rgba(255, 255, 255, 0.15);
            }

            .title {
                font-size: 2.5rem;
                font-weight: 700;
                background: linear-gradient(135deg, #667eea, #764ba2);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .subtitle {
                color: rgba(255, 255, 255, 0.6);
                font-size: 1rem;
                margin-top: 5px;
            }

            .divider {
                height: 1px;
                background: rgba(255, 255, 255, 0.08);
                margin: 20px 0;
            }

            .grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .box {
                background: rgba(255, 255, 255, 0.04);
                padding: 14px;
                border-radius: 12px;
                border: 1px solid rgba(255, 255, 255, 0.05);
                transition: 0.3s;
            }

            .box:hover {
                background: rgba(255, 255, 255, 0.08);
            }

            .box .label {
                font-size: 0.65rem;
                text-transform: uppercase;
                color: rgba(255, 255, 255, 0.3);
                letter-spacing: 1px;
            }

            .box .value {
                color: #fff;
                font-size: 1rem;
                font-weight: 600;
                margin-top: 4px;
            }

            .status {
                margin-top: 20px;
                display: inline-block;
                background: rgba(56, 239, 125, 0.15);
                padding: 8px 25px;
                border-radius: 50px;
                color: #38ef7d;
                font-weight: 600;
                font-size: 0.9rem;
                border: 1px solid rgba(56, 239, 125, 0.2);
            }

            .footer {
                color: rgba(255, 255, 255, 0.2);
                font-size: 0.75rem;
                margin-top: 20px;
            }

            .nav-links {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
                margin-top: 20px;
            }

            .nav-links a {
                color: #fff;
                text-decoration: none;
                padding: 8px 20px;
                border-radius: 50px;
                font-size: 0.9rem;
                font-weight: 600;
                background: linear-gradient(135deg, #667eea, #764ba2);
                transition: 0.3s;
            }

            .nav-links a:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            }
        </style>
    </head>
    <body>

        <div class='card'>

            <div class='title'>Laravel</div>
            <p class='subtitle'>Day 4 - First Laravel Program</p>

            <div class='divider'></div>

            <div class='grid'>
                <div class='box'>
                    <div class='label'>Name</div>
                    <div class='value'>$name</div>
                </div>
                <div class='box'>
                    <div class='label'>Course</div>
                    <div class='value'>$course</div>
                </div>
                <div class='box'>
                    <div class='label'>Organization</div>
                    <div class='value'>$institute</div>
                </div>
                <div class='box'>
                    <div class='label'>Year</div>
                    <div class='value'>$year</div>
                </div>
            </div>

            <div style='margin-top: 15px;'>
                <div class='box' style='display: inline-block; padding: 12px 30px;'>
                    <div class='label'>Current Time</div>
                    <div class='value'>$time | $date</div>
                </div>
            </div>

            <!-- ========== NAVIGATION LINKS ========== -->
            <div class='nav-links'>
                <a href='/welcome'>Welcome</a>
                <a href='/hello/Bisma'>Hello</a>
                <a href='/add/10/20'>Calculator</a>
            </div>

            <div class='status'> Laravel is working perfectly!</div>

            <div class='footer'>
                Laravel Framework • PHP &amp; Laravel Internship Program
            </div>

        </div>

    </body>
    </html>
    ";
});

// ========== WELCOME PAGE ==========
Route::get('/welcome', function () {
    $user = "Bisma Khan";
    $time = date('h:i A');
    
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Welcome</title>
        <style>
            body {
                font-family: 'Segoe UI', sans-serif;
                background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 0;
            }
            .card {
                background: rgba(255,255,255,0.05);
                backdrop-filter: blur(20px);
                padding: 50px;
                border-radius: 24px;
                border: 1px solid rgba(255,255,255,0.08);
                text-align: center;
                box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            }
            h1 {
                font-size: 3rem;
                background: linear-gradient(135deg, #667eea, #764ba2);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            p {
                color: #fff;
                font-size: 1.2rem;
            }
            .time {
                color: rgba(255,255,255,0.5);
                margin-top: 10px;
            }
            a {
                display: inline-block;
                margin-top: 20px;
                color: #667eea;
                text-decoration: none;
                padding: 10px 30px;
                border: 2px solid #667eea;
                border-radius: 50px;
            }
            a:hover {
                background: #667eea;
                color: #fff;
            }
        </style>
    </head>
    <body>
        <div class='card'>
            <h1>Welcome</h1>
            <p>Hello, <strong style='color:#fff;'>$user</strong>!</p>
            <p class='time'>Current Time: $time</p>
            <a href='/'> Go Back</a>
        </div>
    </body>
    </html>
    ";
});

// ========== HELLO PAGE (With Parameter) ==========
Route::get('/hello/{name}', function ($name) {
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Hello</title>
        <style>
            body {
                font-family: 'Segoe UI', sans-serif;
                background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 0;
            }
            .card {
                background: rgba(255,255,255,0.05);
                backdrop-filter: blur(20px);
                padding: 50px;
                border-radius: 24px;
                border: 1px solid rgba(255,255,255,0.08);
                text-align: center;
                box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            }
            h1 {
                font-size: 3rem;
                background: linear-gradient(135deg, #667eea, #764ba2);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            p {
                color: #fff;
                font-size: 1.5rem;
            }
            a {
                display: inline-block;
                margin-top: 20px;
                color: #667eea;
                text-decoration: none;
                padding: 10px 30px;
                border: 2px solid #667eea;
                border-radius: 50px;
            }
            a:hover {
                background: #667eea;
                color: #fff;
            }
        </style>
    </head>
    <body>
        <div class='card'>
            <h1>Hello, $name!</h1>
            <p>Welcome to Laravel!</p>
            <a href='/'> Go Back</a>
        </div>
    </body>
    </html>
    ";
});

// ========== CALCULATOR PAGE ==========
Route::get('/add/{a}/{b}', function ($a, $b) {
    $result = $a + $b;
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Calculator</title>
        <style>
            body {
                font-family: 'Segoe UI', sans-serif;
                background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 0;
            }
            .card {
                background: rgba(255,255,255,0.05);
                backdrop-filter: blur(20px);
                padding: 50px;
                border-radius: 24px;
                border: 1px solid rgba(255,255,255,0.08);
                text-align: center;
                box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            }
            h1 {
                font-size: 2.5rem;
                color: #fff;
            }
            .result {
                font-size: 3rem;
                font-weight: 700;
                color: #38ef7d;
                margin: 20px 0;
            }
            .calc {
                font-size: 2rem;
                color: rgba(255,255,255,0.7);
            }
            a {
                display: inline-block;
                margin-top: 20px;
                color: #667eea;
                text-decoration: none;
                padding: 10px 30px;
                border: 2px solid #667eea;
                border-radius: 50px;
            }
            a:hover {
                background: #667eea;
                color: #fff;
            }
        </style>
    </head>
    <body>
        <div class='card'>
            <h1>Calculator</h1>
            <div class='calc'>$a + $b = </div>
            <div class='result'>$result</div>
            <a href='/'> Go Back</a>
        </div>
    </body>
    </html>
    ";
});