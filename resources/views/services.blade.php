<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Laravel</title>
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
            color: rgba(255,255,255,0.6);
            font-size: 1rem;
            margin-bottom: 15px;
        }

        .service-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            margin: 20px 0 10px;
        }
        .service-item {
            background: rgba(255,255,255,0.03);
            padding: 20px 18px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.05);
            transition: all 0.3s ease;
            text-align: center;
        }
        .service-item:hover {
            background: rgba(255,255,255,0.07);
            transform: translateY(-5px) scale(1.02);
            border-color: rgba(102, 126, 234, 0.25);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .service-item .name {
            color: #fff;
            font-weight: 600;
            font-size: 1.1rem;
        }
        .service-item .desc {
            color: rgba(255,255,255,0.4);
            font-size: 0.85rem;
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
            .service-list { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="/">Home</a>
        <a href="/about">About</a>
        <a href="/services" class="active">Services</a>
        <a href="/contact">Contact</a>
    </div>

    <div class="hero">
        <span class="badge">What We Offer</span>
        <h1>Our Services</h1>
        <p>We provide high-quality web development solutions.</p>

        <div class="service-list">
            <div class="service-item">
                <div class="name">Web Development</div>
                <div class="desc">Responsive websites</div>
            </div>
            <div class="service-item">
                <div class="name">Mobile Apps</div>
                <div class="desc">Android & iOS apps</div>
            </div>
            <div class="service-item">
                <div class="name">Laravel Development</div>
                <div class="desc">PHP framework</div>
            </div>
            <div class="service-item">
                <div class="name">Database Management</div>
                <div class="desc">MySQL, PostgreSQL</div>
            </div>
            <div class="service-item">
                <div class="name">API Development</div>
                <div class="desc">RESTful APIs</div>
            </div>
            <div class="service-item">
                <div class="name">Security Solutions</div>
                <div class="desc">Secure applications</div>
            </div>
        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Bisma Khan. All rights reserved.
    </div>

</body>
</html>