<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Laravel</title>
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
            max-width: 650px;
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

        .contact-item {
            background: rgba(255,255,255,0.03);
            padding: 16px 20px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,0.05);
            margin: 12px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }
        .contact-item:hover {
            background: rgba(255,255,255,0.07);
            border-color: rgba(102, 126, 234, 0.2);
            transform: scale(1.02);
        }
        .contact-item .label {
            color: rgba(255,255,255,0.4);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .contact-item .value {
            color: #fff;
            font-weight: 500;
            font-size: 1rem;
        }
        .contact-item .value.highlight {
            color: #667eea;
            font-weight: 600;
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
            .contact-item { flex-direction: column; gap: 5px; }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="/">Home</a>
        <a href="/about">About</a>
        <a href="/services">Services</a>
        <a href="/contact" class="active">Contact</a>
    </div>

    <div class="hero">
        <span class="badge">Get in Touch</span>
        <h1>Contact Us</h1>
        <p>Feel free to reach out to us anytime.</p>

        <div class="contact-item">
            <span class="label">Email</span>
            <span class="value highlight">bisma@example.com</span>
        </div>
        <div class="contact-item">
            <span class="label">Phone</span>
            <span class="value">+92-300-1234567</span>
        </div>
        <div class="contact-item">
            <span class="label">Address</span>
            <span class="value">Wah Cantt, Pakistan</span>
        </div>
        <div class="contact-item">
            <span class="label">Organization</span>
            <span class="value">POF</span>
        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Bisma Khan. All rights reserved.
    </div>

</body>
</html>