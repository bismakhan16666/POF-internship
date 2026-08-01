<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Seeded</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #0d0d2b, #1a1a4e);
            padding: 20px;
        }
        .card {
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(20px);
            padding: 50px 40px;
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,0.06);
            max-width: 550px;
            width: 100%;
            text-align: center;
            box-shadow: 0 25px 60px rgba(0,0,0,0.4);
        }
        h1 {
            color: #38ef7d;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        p {
            color: rgba(255,255,255,0.4);
            font-size: 1rem;
            margin-bottom: 20px;
        }
        .list {
            text-align: left;
            margin: 20px 0;
            padding: 0;
            list-style: none;
        }
        .list li {
            color: rgba(255,255,255,0.7);
            padding: 10px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px;
            transition: 0.3s;
        }
        .list li:hover {
            background: rgba(255,255,255,0.03);
        }
        .list li .name {
            color: #ffffff;
            font-weight: 500;
        }
        .list li .email {
            color: rgba(255,255,255,0.4);
            font-size: 0.85rem;
        }
        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 12px 35px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            box-shadow: 0 8px 30px rgba(102,126,234,0.15);
        }
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(102,126,234,0.25);
        }
        .footer-text {
            color: rgba(255,255,255,0.08);
            font-size: 0.75rem;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="card">
        <h1>5 Students Seeded</h1>
        <p>Students have been successfully added to the database.</p>

        <ul class="list">
            <li><span class="name">Bisma Khan</span> <span class="email">bisma@example.com</span></li>
            <li><span class="name">Ahmed Ali</span> <span class="email">ahmed@example.com</span></li>
            <li><span class="name">Fatima Khan</span> <span class="email">fatima@example.com</span></li>
            <li><span class="name">Hassan Ali</span> <span class="email">hassan@example.com</span></li>
            <li><span class="name">Ayesha Khan</span> <span class="email">ayesha@example.com</span></li>
        </ul>

        <a href="/students" class="btn">View Students</a>
        <div class="footer-text">Laravel Internship</div>
    </div>

</body>
</html>