<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\StudentController;

// ============================================
// DAY 8 & 9 - STUDENT CRUD
// ============================================

Route::get('/', function () {
    return redirect('/students');
});

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

// ============================================
// DAY 11 - ELOQUENT RELATIONSHIPS
// ============================================

Route::get('/courses', function () {
    $courses = App\Models\Course::all();
    return view('courses.index', compact('courses'));
});

Route::get('/student/{id}/courses', function ($id) {
    $student = App\Models\Student::find($id);
    if ($student) {
        $courses = $student->courses;
        return view('student.courses', compact('student', 'courses'));
    } else {
        return redirect('/students')->with('error', 'Student not found!');
    }
});

Route::get('/students/{id}/enroll-form', function ($id) {
    $student = App\Models\Student::find($id);
    $courses = App\Models\Course::all();
    if ($student) {
        return view('student.enroll-form', compact('student', 'courses'));
    } else {
        return redirect('/students')->with('error', 'Student not found!');
    }
});

Route::get('/enroll/{student_id}/{course_id}', function ($student_id, $course_id) {
    $student = App\Models\Student::find($student_id);
    $course = App\Models\Course::find($course_id);
    if ($student && $course) {
        if ($student->courses()->where('course_id', $course_id)->exists()) {
            return redirect()->back()->with('error', 'Student already enrolled in this course!');
        }
        $student->courses()->attach($course_id, ['enrollment_date' => now()]);
        return redirect()->back()->with('success', 'Student enrolled successfully!');
    } else {
        return redirect()->back()->with('error', 'Student or Course not found!');
    }
});

Route::post('/enroll-store', function () {
    $student_id = request('student_id');
    $course_id = request('course_id');
    $student = App\Models\Student::find($student_id);
    $course = App\Models\Course::find($course_id);
    if ($student && $course) {
        if ($student->courses()->where('course_id', $course_id)->exists()) {
            return redirect()->back()->with('error', 'Student already enrolled in this course!');
        }
        $student->courses()->attach($course_id, ['enrollment_date' => now()]);
        return redirect()->back()->with('success', 'Student enrolled successfully!');
    } else {
        return redirect()->back()->with('error', 'Student or Course not found!');
    }
});

Route::get('/unenroll/{student_id}/{course_id}', function ($student_id, $course_id) {
    $student = App\Models\Student::find($student_id);
    if ($student) {
        $student->courses()->detach($course_id);
        return redirect()->back()->with('success', 'Student unenrolled successfully!');
    } else {
        return redirect()->back()->with('error', 'Student not found!');
    }
});

// ============================================
// SEED COURSES
// ============================================

Route::get('/seed-courses', function () {
    if (Schema::hasTable('course_student')) {
        DB::table('course_student')->truncate();
    }
    if (Schema::hasTable('courses')) {
        DB::table('courses')->truncate();
    }
    
    $courses = [
        ['name' => 'Laravel Basics', 'code' => 'LAR-101', 'credit_hours' => 3, 'description' => 'Introduction to Laravel'],
        ['name' => 'Advanced Laravel', 'code' => 'LAR-201', 'credit_hours' => 4, 'description' => 'Advanced Laravel concepts'],
        ['name' => 'Database Management', 'code' => 'DB-101', 'credit_hours' => 3, 'description' => 'MySQL and database design'],
        ['name' => 'Web Development', 'code' => 'WEB-101', 'credit_hours' => 3, 'description' => 'HTML, CSS, JavaScript'],
        ['name' => 'PHP Programming', 'code' => 'PHP-101', 'credit_hours' => 3, 'description' => 'PHP basics']
    ];
    
    foreach ($courses as $course) {
        App\Models\Course::create($course);
    }
    
    return "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Courses Seeded</title>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
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
                margin: 10px 0;
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
                transition: 0.3s;
                border-radius: 8px;
            }
            .list li:hover {
                background: rgba(255,255,255,0.03);
            }
            .list li .code {
                color: #667eea;
                font-weight: 600;
            }
            .list li .name {
                color: #ffffff;
                font-weight: 500;
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
        <div class='card'>
            <h1>5 Courses Seeded</h1>
            <p>Courses have been successfully added to the database.</p>
            <ul class='list'>
                <li><span class='code'>LAR-101</span> <span class='name'>Laravel Basics</span></li>
                <li><span class='code'>LAR-201</span> <span class='name'>Advanced Laravel</span></li>
                <li><span class='code'>DB-101</span> <span class='name'>Database Management</span></li>
                <li><span class='code'>WEB-101</span> <span class='name'>Web Development</span></li>
                <li><span class='code'>PHP-101</span> <span class='name'>PHP Programming</span></li>
            </ul>
            <a href='/courses' class='btn'>View Courses</a>
            <div class='footer-text'>Laravel Internship</div>
        </div>
    </body>
    </html>
    ";
});

// ============================================
// SEED STUDENTS
// ============================================

Route::get('/seed-students', function () {
    App\Models\Student::truncate();
    
    $students = [
        ['name' => 'Bisma Khan', 'email' => 'bisma@example.com', 'age' => 22, 'course' => 'Laravel Internship'],
        ['name' => 'Ahmed Ali', 'email' => 'ahmed@example.com', 'age' => 24, 'course' => 'Web Development'],
        ['name' => 'Fatima Khan', 'email' => 'fatima@example.com', 'age' => 23, 'course' => 'Laravel Internship'],
        ['name' => 'Hassan Ali', 'email' => 'hassan@example.com', 'age' => 25, 'course' => 'Database Management'],
        ['name' => 'Ayesha Khan', 'email' => 'ayesha@example.com', 'age' => 21, 'course' => 'Laravel Internship']
    ];
    
    foreach ($students as $student) {
        App\Models\Student::create($student);
    }
    
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Students Seeded</title>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
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
                margin: 10px 0;
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
            .list li:hover { background: rgba(255,255,255,0.03); }
            .list li .name { color: #ffffff; font-weight: 500; }
            .list li .email { color: rgba(255,255,255,0.4); font-size: 0.85rem; }
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
        <div class='card'>
            <h1>5 Students Seeded</h1>
            <p>Students have been successfully added to the database.</p>
            <ul class='list'>
                <li><span class='name'>Bisma Khan</span> <span class='email'>bisma@example.com</span></li>
                <li><span class='name'>Ahmed Ali</span> <span class='email'>ahmed@example.com</span></li>
                <li><span class='name'>Fatima Khan</span> <span class='email'>fatima@example.com</span></li>
                <li><span class='name'>Hassan Ali</span> <span class='email'>hassan@example.com</span></li>
                <li><span class='name'>Ayesha Khan</span> <span class='email'>ayesha@example.com</span></li>
            </ul>
            <a href='/students' class='btn'>View Students</a>
            <div class='footer-text'>Laravel Internship</div>
        </div>
    </body>
    </html>
    ";
});