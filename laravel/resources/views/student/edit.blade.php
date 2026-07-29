<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,0.08);
            max-width: 550px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        }
        h1 {
            color: #fff;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 25px;
        }
        h1 span {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.04);
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
        }
        input:focus {
            border-color: #667eea;
            background: rgba(255,255,255,0.06);
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.1);
        }
        input::placeholder {
            color: rgba(255,255,255,0.2);
        }
        .error {
            color: #f5576c;
            font-size: 0.8rem;
            margin-top: 5px;
            display: block;
        }
        .btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            margin-top: 10px;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }
        .links {
            text-align: center;
            margin-top: 15px;
        }
        .links a {
            color: rgba(255,255,255,0.4);
            text-decoration: none;
            font-size: 0.85rem;
        }
        .links a:hover {
            color: #667eea;
        }
        .error-msg {
            background: rgba(245, 87, 108, 0.12);
            padding: 12px 18px;
            border-radius: 10px;
            color: #f5576c;
            font-size: 0.9rem;
            margin-bottom: 20px;
            border: 1px solid rgba(245, 87, 108, 0.15);
        }
    </style>
</head>
<body>

    <div class="container">

        <h1>Edit <span>Student</span></h1>

        @if($errors->any())
            <div class="error-msg">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="Enter student name" value="{{ old('name', $student->name) }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter student email" value="{{ old('email', $student->email) }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" placeholder="Enter student age" value="{{ old('age', $student->age) }}" required>
                @error('age')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Course</label>
                <input type="text" name="course" placeholder="Enter course name" value="{{ old('course', $student->course) }}" required>
                @error('course')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn">Update Student</button>
        </form>

        <div class="links">
            <a href="{{ route('students.index') }}">Back to Students List</a>
        </div>

    </div>

</body>
</html>