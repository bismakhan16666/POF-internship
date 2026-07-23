<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Laravel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(15px);
            padding: 18px 30px;
            display: flex;
            justify-content: center;
            gap: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            flex-wrap: wrap;
        }
        .navbar a {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            padding: 10px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        .navbar a:hover, .navbar a.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .hero {
            max-width: 800px;
            margin: 60px auto;
            padding: 50px 40px;
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(20px);
            border-radius: 28px;
            border: 1px solid rgba(255,255,255,0.06);
            text-align: center;
            box-shadow: 0 25px 60px rgba(0,0,0,0.4);
            transition: transform 0.4s ease;
        }
        .hero:hover {
            transform: translateY(-8px);
            border-color: rgba(255,255,255,0.12);
        }
        .hero .badge {
            display: inline-block;
            background: rgba(102, 126, 234, 0.15);
            padding: 6px 22px;
            border-radius: 50px;
            color: #667eea;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 1px;
            border: 1px solid rgba(102, 126, 234, 0.15);
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 15px 0 10px;
        }
        .hero p {
            color: rgba(255,255,255,0.7);
            font-size: 1.1rem;
            line-height: 1.8;
        }
        .hero .highlight {
            color: #667eea;
            font-weight: 600;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin: 25px 0 10px;
        }
        .info-card {
            background: rgba(255,255,255,0.03);
            padding: 18px 15px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.05);
            transition: all 0.3s ease;
        }
        .info-card:hover {
            background: rgba(255,255,255,0.07);
            transform: scale(1.03);
            border-color: rgba(102, 126, 234, 0.2);
        }
        .info-card .label {
            font-size: 0.65rem;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            letter-spacing: 1px;
        }
        .info-card .value {
            color: #fff;
            font-size: 1.05rem;
            font-weight: 600;
            margin-top: 4px;
        }

        .footer {
            text-align: center;
            padding: 25px;
            color: rgba(255,255,255,0.15);
            font-size: 0.8rem;
            margin-top: 30px;
        }

        @media (max-width: 600px) {
            .hero { padding: 30px 20px; margin: 30px 15px; }
            .hero h1 { font-size: 2rem; }
            .navbar { gap: 8px; padding: 12px 15px; }
            .navbar a { padding: 8px 16px; font-size: 0.8rem; }
            .info-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="/">Home</a>
        <a href="/about" class="active">About</a>
        <a href="/services">Services</a>
        <a href="/contact">Contact</a>
    </div>

    <div class="hero">
        <span class="badge">About Us</span>
        <h1>About Me</h1>
        <p>
            I am <span class="highlight">Bisma Khan</span>, a passionate learner
            doing <span class="highlight">Laravel Internship</span> at
            <span class="highlight">POF</span>.
        </p>
        <p>
            This website is a part of my internship training.
            I am learning web development with Laravel framework.
        </p>

        <div class="info-grid">
            <div class="info-card">
                <div class="label">Name</div>
                <div class="value">Bisma Khan</div>
            </div>
            <div class="info-card">
                <div class="label">Course</div>
                <div class="value">Laravel Internship</div>
            </div>
            <div class="info-card">
                <div class="label">Organization</div>
                <div class="value">POF</div>
            </div>
            <div class="info-card">
                <div class="label">Location</div>
                <div class="value">Wah Cantt</div>
            </div>
        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Bisma Khan. All rights reserved.
    </div>

</body>
</html>