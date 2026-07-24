<?php

use Illuminate\Support\Facades\Route;
use App\Models\Student;

// ============================================
// DAY 7 - ELOQUENT ORM
// ============================================

// ========== HOME PAGE ==========
Route::get('/', function () {
    $students = Student::all();
    $count = Student::count();
    
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Day 7 - Eloquent ORM</title>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body {
                font-family: 'Poppins', sans-serif;
                background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
                min-height: 100vh;
                padding: 40px 20px;
            }
            .container { max-width: 900px; margin: 0 auto; }
            
            .header {
                text-align: center;
                padding: 40px 30px;
                background: rgba(255,255,255,0.05);
                backdrop-filter: blur(20px);
                border-radius: 24px;
                border: 1px solid rgba(255,255,255,0.08);
                margin-bottom: 30px;
            }
            .header h1 {
                font-size: 2.8rem;
                background: linear-gradient(135deg, #667eea, #764ba2);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .header .subtitle {
                color: rgba(255,255,255,0.6);
                font-size: 1rem;
                margin-top: 5px;
            }
            .header .stats {
                display: flex;
                justify-content: center;
                gap: 30px;
                margin-top: 15px;
            }
            .header .stats span {
                color: rgba(255,255,255,0.4);
                font-size: 0.9rem;
            }
            .header .stats strong {
                color: #667eea;
                font-size: 1.2rem;
            }
            
            .card {
                background: rgba(255,255,255,0.04);
                backdrop-filter: blur(20px);
                border-radius: 18px;
                padding: 25px 30px;
                margin-bottom: 20px;
                border: 1px solid rgba(255,255,255,0.06);
                transition: all 0.3s ease;
            }
            .card:hover {
                transform: translateY(-3px);
                border-color: rgba(255,255,255,0.12);
                box-shadow: 0 15px 40px rgba(0,0,0,0.3);
            }
            .card h2 {
                color: #fff;
                font-size: 1.3rem;
                margin-bottom: 10px;
            }
            .card h2 small {
                color: rgba(255,255,255,0.3);
                font-size: 0.8rem;
                font-weight: 400;
            }
            .card p {
                color: rgba(255,255,255,0.6);
                font-size: 0.95rem;
                margin-bottom: 12px;
            }
            
            .links {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }
            .links a {
                color: #fff;
                text-decoration: none;
                padding: 8px 20px;
                border-radius: 50px;
                font-size: 0.85rem;
                font-weight: 600;
                background: linear-gradient(135deg, #667eea, #764ba2);
                transition: all 0.3s ease;
                display: inline-block;
            }
            .links a:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            }
            .links a.danger {
                background: linear-gradient(135deg, #f093fb, #f5576c);
            }
            .links a.danger:hover {
                box-shadow: 0 8px 25px rgba(245, 87, 108, 0.4);
            }
            .links a.success {
                background: linear-gradient(135deg, #11998e, #38ef7d);
            }
            .links a.success:hover {
                box-shadow: 0 8px 25px rgba(56, 239, 125, 0.4);
            }
            .links a.warning {
                background: linear-gradient(135deg, #f093fb, #f5576c);
            }
            
            .footer {
                text-align: center;
                padding: 20px;
                color: rgba(255,255,255,0.15);
                font-size: 0.8rem;
                margin-top: 20px;
            }
            
            @media (max-width: 600px) {
                .header h1 { font-size: 2rem; }
                .header .stats { flex-direction: column; gap: 8px; }
                .links { flex-direction: column; }
                .links a { text-align: center; }
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>Day 7 - Eloquent ORM</h1>
                <p class='subtitle'>Interactive CRUD Operations</p>
                <div class='stats'>
                    <span>Total Students: <strong>$count</strong></span>
                    <span>Laravel Version: <strong>".app()->version()."</strong></span>
                </div>
            </div>
            
            <div class='card'>
                <h2>1. Insert Data <small>(Create)</small></h2>
                <p>Add new students to the database</p>
                <div class='links'>
                    <a href='/add-student'>Add Student (Object)</a>
                    <a href='/add-student-eloquent'>Add Student (create())</a>
                    <a href='/add-multiple'>Add Multiple</a>
                    <a href='/seed' class='success'>Seed 5 Students</a>
                </div>
            </div>
            
            <div class='card'>
                <h2>2. Fetch Data <small>(Read)</small></h2>
                <p>View students from the database</p>
                <div class='links'>
                    <a href='/students'>All Students</a>
                    <a href='/student/1'>Student ID 1</a>
                    <a href='/first-student'>First Student</a>
                    <a href='/students/course/Laravel%20Internship'>Filter by Course</a>
                </div>
            </div>
            
            <div class='card'>
                <h2>3. Update Data <small>(Update)</small></h2>
                <p>Modify existing student records</p>
                <div class='links'>
                    <a href='/update-student/1' class='warning'>Update ID 1 (save())</a>
                    <a href='/update-student-eloquent/1' class='warning'>Update ID 1 (update())</a>
                    <a href='/update-all' class='warning'>Update All</a>
                </div>
            </div>
            
            <div class='card'>
                <h2>4. Delete Data <small>(Delete)</small></h2>
                <p>Remove students from the database</p>
                <div class='links'>
                    <a href='/delete-student/1' class='danger'>Delete ID 1</a>
                    <a href='/delete-student-eloquent/2' class='danger'>Delete ID 2</a>
                    <a href='/delete-multiple' class='danger'>Delete All</a>
                </div>
            </div>
            
            <div class='footer'>
                &copy; 2026 Bisma Khan • Laravel Internship
            </div>
        </div>
    </body>
    </html>
    ";
});

// ========== 1. INSERT DATA ==========

// Method 1: Object se insert
Route::get('/add-student', function () {
    $random = rand(1, 99999);
    
    $student = new Student();
    $student->name = "Bisma Khan";
    $student->email = "bisma_" . $random . "@example.com";
    $student->age = 22;
    $student->course = "Laravel Internship";
    $student->save();

    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Success</title>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
        <style>
            body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px; }
            .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); text-align: center; max-width: 500px; }
            h1 { color: #38ef7d; font-size: 2.5rem; }
            p { color: rgba(255,255,255,0.7); font-size: 1rem; margin: 10px 0; }
            a { display: inline-block; margin-top: 15px; color: #667eea; text-decoration: none; padding: 10px 30px; border: 2px solid #667eea; border-radius: 50px; }
            a:hover { background: #667eea; color: #fff; }
        </style>
    </head>
    <body>
        <div class='card'>
            <h1> Student Added!</h1>
            <p><strong>Name:</strong> Bisma Khan</p>
            <p><strong>Email:</strong> bisma_$random@example.com</p>
            <a href='/'>⬅ Go Home</a>
        </div>
    </body>
    </html>
    ";
});

// Method 2: create() method se insert
Route::get('/add-student-eloquent', function () {
    $random = rand(1, 99999);
    
    Student::create([
        'name' => 'Ahmed Ali',
        'email' => 'ahmed_' . $random . '@example.com',
        'age' => 24,
        'course' => 'Web Development'
    ]);

    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Success</title>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
        <style>
            body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px; }
            .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); text-align: center; max-width: 500px; }
            h1 { color: #38ef7d; font-size: 2.5rem; }
            p { color: rgba(255,255,255,0.7); font-size: 1rem; margin: 10px 0; }
            a { display: inline-block; margin-top: 15px; color: #667eea; text-decoration: none; padding: 10px 30px; border: 2px solid #667eea; border-radius: 50px; }
            a:hover { background: #667eea; color: #fff; }
        </style>
    </head>
    <body>
        <div class='card'>
            <h1> Student Added!</h1>
            <p><strong>Name:</strong> Ahmed Ali</p>
            <p><strong>Email:</strong> ahmed_$random@example.com</p>
            <p><strong>Method:</strong> create()</p>
            <a href='/'>⬅ Go Home</a>
        </div>
    </body>
    </html>
    ";
});

// Add multiple students
Route::get('/add-multiple', function () {
    Student::create(['name' => 'Fatima Khan', 'email' => 'fatima_' . rand(1,99999) . '@example.com', 'age' => 23, 'course' => 'Laravel Internship']);
    Student::create(['name' => 'Hassan Ali', 'email' => 'hassan_' . rand(1,99999) . '@example.com', 'age' => 25, 'course' => 'Database Management']);
    
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Success</title>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
        <style>
            body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px; }
            .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); text-align: center; max-width: 500px; }
            h1 { color: #38ef7d; font-size: 2.5rem; }
            p { color: rgba(255,255,255,0.7); font-size: 1rem; }
            a { display: inline-block; margin-top: 15px; color: #667eea; text-decoration: none; padding: 10px 30px; border: 2px solid #667eea; border-radius: 50px; }
            a:hover { background: #667eea; color: #fff; }
        </style>
    </head>
    <body>
        <div class='card'>
            <h1> 2 Students Added!</h1>
            <p>Fatima Khan & Hassan Ali</p>
            <a href='/'>⬅ Go Home</a>
        </div>
    </body>
    </html>
    ";
});

// ========== 2. FETCH DATA ==========

// All Students
Route::get('/students', function () {
    $students = Student::all();
    
    if ($students->isEmpty()) {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <title>No Students</title>
            <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
            <style>
                body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px; }
                .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); text-align: center; max-width: 500px; }
                h1 { color: #f5576c; font-size: 2.5rem; }
                p { color: rgba(255,255,255,0.7); font-size: 1rem; }
                a { display: inline-block; margin-top: 15px; color: #667eea; text-decoration: none; padding: 10px 30px; border: 2px solid #667eea; border-radius: 50px; }
                a:hover { background: #667eea; color: #fff; }
            </style>
        </head>
        <body>
            <div class='card'>
                <h1> No Students Found!</h1>
                <p>Please add some students first.</p>
                <a href='/'>⬅ Go Home</a>
            </div>
        </body>
        </html>
        ";
    }
    
    $html = "
    <!DOCTYPE html>
    <html>
    <head>
        <title>All Students</title>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; padding: 40px 20px; }
            .container { max-width: 900px; margin: 0 auto; }
            .header { text-align: center; padding: 30px; background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); margin-bottom: 30px; }
            .header h1 { color: #fff; font-size: 2.5rem; }
            .header h1 span { background: linear-gradient(135deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
            .header .count { color: rgba(255,255,255,0.4); font-size: 0.9rem; margin-top: 5px; }
            .table-wrapper { background: rgba(255,255,255,0.04); border-radius: 16px; padding: 20px; border: 1px solid rgba(255,255,255,0.06); overflow-x: auto; }
            table { width: 100%; border-collapse: collapse; }
            th { background: rgba(102, 126, 234, 0.2); color: #667eea; padding: 12px 15px; text-align: left; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
            td { color: rgba(255,255,255,0.85); padding: 12px 15px; border-bottom: 1px solid rgba(255,255,255,0.04); }
            tr:hover td { background: rgba(255,255,255,0.03); }
            .back-link { display: inline-block; margin-top: 20px; color: #667eea; text-decoration: none; padding: 10px 30px; border: 2px solid #667eea; border-radius: 50px; }
            .back-link:hover { background: #667eea; color: #fff; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1> All <span>Students</span></h1>
                <p class='count'>Total: " . $students->count() . " students</p>
            </div>
            <div class='table-wrapper'>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Course</th>
                    </tr>";
    
    foreach ($students as $student) {
        $html .= "
                    <tr>
                        <td>" . $student->id . "</td>
                        <td>" . $student->name . "</td>
                        <td>" . $student->email . "</td>
                        <td>" . $student->age . "</td>
                        <td>" . $student->course . "</td>
                    </tr>";
    }
    
    $html .= "
                </table>
            </div>
            <br>
            <a href='/' class='back-link'>⬅ Go Home</a>
        </div>
    </body>
    </html>
    ";
    
    return $html;
});

// Single Student
Route::get('/student/{id}', function ($id) {
    $student = Student::find($id);

    if ($student) {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Student Details</title>
            <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
            <style>
                body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px; }
                .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); max-width: 500px; width: 100%; }
                h1 { color: #fff; font-size: 2rem; text-align: center; }
                h1 span { background: linear-gradient(135deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
                .info { margin: 20px 0; }
                .info p { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.05); color: rgba(255,255,255,0.7); }
                .info p strong { color: #fff; }
                .links { display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; margin-top: 20px; }
                .links a { color: #fff; text-decoration: none; padding: 8px 20px; border-radius: 50px; font-size: 0.85rem; font-weight: 600; }
                .links a.home { background: linear-gradient(135deg, #667eea, #764ba2); }
                .links a.danger { background: linear-gradient(135deg, #f093fb, #f5576c); }
            </style>
        </head>
        <body>
            <div class='card'>
                <h1>Student <span>Details</span></h1>
                <div class='info'>
                    <p><strong>ID</strong> " . $student->id . "</p>
                    <p><strong>Name</strong> " . $student->name . "</p>
                    <p><strong>Email</strong> " . $student->email . "</p>
                    <p><strong>Age</strong> " . $student->age . "</p>
                    <p><strong>Course</strong> " . $student->course . "</p>
                </div>
                <div class='links'>
                    <a href='/' class='home'>⬅ Home</a>
                    <a href='/update-student/$id' class='danger'> Update</a>
                    <a href='/delete-student/$id' class='danger'> Delete</a>
                </div>
            </div>
        </body>
        </html>
        ";
    } else {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Not Found</title>
            <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
            <style>
                body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px; }
                .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); text-align: center; max-width: 500px; }
                h1 { color: #f5576c; font-size: 2.5rem; }
                p { color: rgba(255,255,255,0.7); }
                a { display: inline-block; margin-top: 15px; color: #667eea; text-decoration: none; padding: 10px 30px; border: 2px solid #667eea; border-radius: 50px; }
                a:hover { background: #667eea; color: #fff; }
            </style>
        </head>
        <body>
            <div class='card'>
                <h1> Student Not Found!</h1>
                <p>Student with ID $id does not exist.</p>
                <a href='/'>⬅ Go Home</a>
            </div>
        </body>
        </html>
        ";
    }
});

// First Student
Route::get('/first-student', function () {
    $student = Student::first();

    if ($student) {
        return redirect('/student/' . $student->id);
    } else {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <title>No Students</title>
            <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
            <style>
                body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px; }
                .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); text-align: center; max-width: 500px; }
                h1 { color: #f5576c; }
                p { color: rgba(255,255,255,0.7); }
                a { display: inline-block; margin-top: 15px; color: #667eea; text-decoration: none; padding: 10px 30px; border: 2px solid #667eea; border-radius: 50px; }
                a:hover { background: #667eea; color: #fff; }
            </style>
        </head>
        <body>
            <div class='card'>
                <h1> No Students Found!</h1>
                <p>Please add some students first.</p>
                <a href='/'>⬅ Go Home</a>
            </div>
        </body>
        </html>
        ";
    }
});

// Filter by Course
Route::get('/students/course/{course}', function ($course) {
    $students = Student::where('course', $course)->get();
    
    if ($students->isEmpty()) {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <title>No Students</title>
            <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
            <style>
                body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px; }
                .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); text-align: center; max-width: 500px; }
                h1 { color: #f5576c; }
                p { color: rgba(255,255,255,0.7); }
                a { display: inline-block; margin-top: 15px; color: #667eea; text-decoration: none; padding: 10px 30px; border: 2px solid #667eea; border-radius: 50px; }
                a:hover { background: #667eea; color: #fff; }
            </style>
        </head>
        <body>
            <div class='card'>
                <h1> No Students in '$course' Course</h1>
                <a href='/'>⬅ Go Home</a>
            </div>
        </body>
        </html>
        ";
    }
    
    $html = "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Filtered Students</title>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; padding: 40px 20px; }
            .container { max-width: 800px; margin: 0 auto; }
            .header { text-align: center; padding: 30px; background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); margin-bottom: 30px; }
            .header h1 { color: #fff; font-size: 2rem; }
            .header h1 span { background: linear-gradient(135deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
            .table-wrapper { background: rgba(255,255,255,0.04); border-radius: 16px; padding: 20px; border: 1px solid rgba(255,255,255,0.06); overflow-x: auto; }
            table { width: 100%; border-collapse: collapse; }
            th { background: rgba(102, 126, 234, 0.2); color: #667eea; padding: 12px 15px; text-align: left; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; }
            td { color: rgba(255,255,255,0.85); padding: 12px 15px; border-bottom: 1px solid rgba(255,255,255,0.04); }
            tr:hover td { background: rgba(255,255,255,0.03); }
            .back-link { display: inline-block; margin-top: 20px; color: #667eea; text-decoration: none; padding: 10px 30px; border: 2px solid #667eea; border-radius: 50px; }
            .back-link:hover { background: #667eea; color: #fff; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>Students in <span>$course</span></h1>
            </div>
            <div class='table-wrapper'>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                    </tr>";
    
    foreach ($students as $student) {
        $html .= "
                    <tr>
                        <td>" . $student->id . "</td>
                        <td>" . $student->name . "</td>
                        <td>" . $student->email . "</td>
                        <td>" . $student->age . "</td>
                    </tr>";
    }
    
    $html .= "
                </table>
            </div>
            <br>
            <a href='/' class='back-link'>⬅ Go Home</a>
        </div>
    </body>
    </html>
    ";
    
    return $html;
});

// ========== 3. UPDATE DATA ==========

// Update using save()
Route::get('/update-student/{id}', function ($id) {
    $student = Student::find($id);

    if ($student) {
        $student->course = "Advanced Laravel";
        $student->save();
        
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Updated</title>
            <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
            <style>
                body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px; }
                .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); text-align: center; max-width: 500px; }
                h1 { color: #38ef7d; font-size: 2.5rem; }
                p { color: rgba(255,255,255,0.7); font-size: 1rem; margin: 10px 0; }
                a { display: inline-block; margin-top: 15px; color: #667eea; text-decoration: none; padding: 10px 30px; border: 2px solid #667eea; border-radius: 50px; }
                a:hover { background: #667eea; color: #fff; }
            </style>
        </head>
        <body>
            <div class='card'>
                <h1> Student Updated!</h1>
                <p><strong>Name:</strong> " . $student->name . "</p>
                <p><strong>New Course:</strong> Advanced Laravel</p>
                <p><strong>Method:</strong> save()</p>
                <a href='/student/$id'>View Student</a>
                <a href='/'>⬅ Home</a>
            </div>
        </body>
        </html>
        ";
    } else {
        return redirect('/');
    }
});

// Update using update()
Route::get('/update-student-eloquent/{id}', function ($id) {
    $student = Student::find($id);

    if ($student) {
        $student->update([
            'age' => 26,
            'course' => 'Full Stack Development'
        ]);
        
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Updated</title>
            <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
            <style>
                body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px; }
                .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); text-align: center; max-width: 500px; }
                h1 { color: #38ef7d; font-size: 2.5rem; }
                p { color: rgba(255,255,255,0.7); }
                a { display: inline-block; margin-top: 15px; color: #667eea; text-decoration: none; padding: 10px 30px; border: 2px solid #667eea; border-radius: 50px; }
                a:hover { background: #667eea; color: #fff; }
            </style>
        </head>
        <body>
            <div class='card'>
                <h1> Student Updated!</h1>
                <p><strong>Name:</strong> " . $student->name . "</p>
                <p><strong>New Course:</strong> Full Stack Development</p>
                <p><strong>New Age:</strong> 26</p>
                <p><strong>Method:</strong> update()</p>
                <a href='/student/$id'>View Student</a>
                <a href='/'>⬅ Home</a>
            </div>
        </body>
        </html>
        ";
    } else {
        return redirect('/');
    }
});

// Update all
Route::get('/update-all', function () {
    Student::where('course', 'Laravel Internship')->update([
        'course' => 'Laravel Advanced'
    ]);

    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Updated All</title>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
        <style>
            body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px; }
            .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); text-align: center; max-width: 500px; }
            h1 { color: #38ef7d; font-size: 2.5rem; }
            p { color: rgba(255,255,255,0.7); }
            a { display: inline-block; margin-top: 15px; color: #667eea; text-decoration: none; padding: 10px 30px; border: 2px solid #667eea; border-radius: 50px; }
            a:hover { background: #667eea; color: #fff; }
        </style>
    </head>
    <body>
        <div class='card'>
            <h1> All Students Updated!</h1>
            <p>All 'Laravel Internship' → 'Laravel Advanced'</p>
            <a href='/students'>View All Students</a>
            <a href='/'>⬅ Home</a>
        </div>
    </body>
    </html>
    ";
});

// ========== 4. DELETE DATA ==========

// Delete using delete()
Route::get('/delete-student/{id}', function ($id) {
    $student = Student::find($id);

    if ($student) {
        $name = $student->name;
        $student->delete();
        
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Deleted</title>
            <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
            <style>
                body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px; }
                .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); text-align: center; max-width: 500px; }
                h1 { color: #f5576c; font-size: 2.5rem; }
                p { color: rgba(255,255,255,0.7); }
                a { display: inline-block; margin-top: 15px; color: #667eea; text-decoration: none; padding: 10px 30px; border: 2px solid #667eea; border-radius: 50px; }
                a:hover { background: #667eea; color: #fff; }
            </style>
        </head>
        <body>
            <div class='card'>
                <h1> Student Deleted!</h1>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Method:</strong> delete()</p>
                <a href='/students'>View All Students</a>
                <a href='/'>⬅ Home</a>
            </div>
        </body>
        </html>
        ";
    } else {
        return redirect('/');
    }
});

// Delete using destroy()
Route::get('/delete-student-eloquent/{id}', function ($id) {
    $student = Student::find($id);
    $name = $student ? $student->name : "Unknown";
    $deleted = Student::destroy($id);

    if ($deleted) {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Deleted</title>
            <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
            <style>
                body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px; }
                .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); text-align: center; max-width: 500px; }
                h1 { color: #f5576c; font-size: 2.5rem; }
                p { color: rgba(255,255,255,0.7); }
                a { display: inline-block; margin-top: 15px; color: #667eea; text-decoration: none; padding: 10px 30px; border: 2px solid #667eea; border-radius: 50px; }
                a:hover { background: #667eea; color: #fff; }
            </style>
        </head>
        <body>
            <div class='card'>
                <h1> Student Deleted!</h1>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Method:</strong> destroy()</p>
                <a href='/students'>View All Students</a>
                <a href='/'>⬅ Home</a>
            </div>
        </body>
        </html>
        ";
    } else {
        return redirect('/');
    }
});

// Delete multiple
Route::get('/delete-multiple', function () {
    $count = Student::where('course', 'Web Development')->count();
    Student::where('course', 'Web Development')->delete();

    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Deleted All</title>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
        <style>
            body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px; }
            .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); text-align: center; max-width: 500px; }
            h1 { color: #f5576c; font-size: 2.5rem; }
            p { color: rgba(255,255,255,0.7); }
            a { display: inline-block; margin-top: 15px; color: #667eea; text-decoration: none; padding: 10px 30px; border: 2px solid #667eea; border-radius: 50px; }
            a:hover { background: #667eea; color: #fff; }
        </style>
    </head>
    <body>
        <div class='card'>
            <h1>🗑️ All Deleted!</h1>
            <p>$count Web Development students deleted.</p>
            <a href='/students'>View All Students</a>
            <a href='/'>⬅ Home</a>
        </div>
    </body>
    </html>
    ";
});

// ========== 5. SEED STUDENTS ==========
Route::get('/seed', function () {
    Student::truncate();
    
    Student::create(['name' => 'Bisma Khan', 'email' => 'bisma_' . rand(1,99999) . '@example.com', 'age' => 22, 'course' => 'Laravel Internship']);
    Student::create(['name' => 'Ahmed Ali', 'email' => 'ahmed_' . rand(1,99999) . '@example.com', 'age' => 24, 'course' => 'Web Development']);
    Student::create(['name' => 'Fatima Khan', 'email' => 'fatima_' . rand(1,99999) . '@example.com', 'age' => 23, 'course' => 'Laravel Internship']);
    Student::create(['name' => 'Hassan Ali', 'email' => 'hassan_' . rand(1,99999) . '@example.com', 'age' => 25, 'course' => 'Database Management']);
    Student::create(['name' => 'Ayesha Khan', 'email' => 'ayesha_' . rand(1,99999) . '@example.com', 'age' => 21, 'course' => 'Laravel Internship']);
    
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Seeded</title>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
        <style>
            body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px; }
            .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.08); text-align: center; max-width: 500px; }
            h1 { color: #38ef7d; font-size: 2.5rem; }
            p { color: rgba(255,255,255,0.7); }
            a { display: inline-block; margin-top: 15px; color: #667eea; text-decoration: none; padding: 10px 30px; border: 2px solid #667eea; border-radius: 50px; }
            a:hover { background: #667eea; color: #fff; }
        </style>
    </head>
    <body>
        <div class='card'>
            <h1> 5 Students Seeded!</h1>
            <p>All previous data cleared.</p>
            <a href='/students'>View All Students</a>
            <a href='/'>⬅ Home</a>
        </div>
    </body>
    </html>
    ";
});