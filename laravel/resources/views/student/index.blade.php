<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            min-height: 100vh;
            padding: 40px 20px;
        }
        .container { max-width: 1000px; margin: 0 auto; }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px 30px;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(20px);
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.06);
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }
        .header h1 {
            color: #fff;
            font-size: 1.8rem;
        }
        .header h1 span {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .header .count {
            color: rgba(255,255,255,0.4);
            font-size: 0.9rem;
        }
        .btn {
            padding: 10px 25px;
            border: none;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            color: #fff;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }
        .success-msg {
            background: rgba(56, 239, 125, 0.12);
            padding: 12px 18px;
            border-radius: 10px;
            color: #38ef7d;
            font-size: 0.9rem;
            margin-bottom: 20px;
            border: 1px solid rgba(56, 239, 125, 0.15);
        }
        .table-wrapper {
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(20px);
            border-radius: 18px;
            padding: 20px;
            border: 1px solid rgba(255,255,255,0.06);
            overflow-x: auto;
        }
        table { width: 100%; border-collapse: collapse; }
        th {
            background: rgba(102, 126, 234, 0.15);
            color: #667eea;
            padding: 14px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        td {
            color: rgba(255,255,255,0.85);
            padding: 14px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.04);
        }
        tr:hover td { background: rgba(255,255,255,0.03); }
        .empty {
            text-align: center;
            color: rgba(255,255,255,0.3);
            padding: 40px 0;
            font-size: 1.1rem;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: rgba(255,255,255,0.15);
            font-size: 0.8rem;
            margin-top: 25px;
        }
        @media (max-width: 600px) {
            .header { flex-direction: column; text-align: center; }
            .header h1 { font-size: 1.4rem; }
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="header">
            <div>
                <h1>Students <span>List</span></h1>
                <p class="count">Total: {{ count($students) }} students</p>
            </div>
            <a href="{{ route('students.create') }}" class="btn">+ Add New Student</a>
        </div>

        @if(session('success'))
            <div class="success-msg">{{ session('success') }}</div>
        @endif

        <div class="table-wrapper">
            @if($students->isEmpty())
                <div class="empty">No students found. <a href="{{ route('students.create') }}" style="color:#667eea;">Add one</a></div>
            @else
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Course</th>
                    </tr>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->age }}</td>
                            <td>{{ $student->course }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>

        <div class="footer">
            &copy; 2026 Bisma Khan • Laravel Internship • Day 8
        </div>

    </div>

</body>
</html>