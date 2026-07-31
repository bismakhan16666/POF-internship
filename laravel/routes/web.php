<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\StudentController;

// ============================================
// HOME PAGE - WELCOME
// ============================================

Route::get('/', function () {
    return view('welcome');
});

// ============================================
// DAY 8 & 9 - STUDENT CRUD
// ============================================

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
// SEED ROUTES
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
    
    return view('seed-courses');
});

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
    
    return view('seed-students');
});

// ============================================
// DAY 13 - ADMIN DASHBOARD (Protected)
// ============================================

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// ============================================
// AUTHENTICATION ROUTES
// ============================================

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    $credentials = request()->only('email', 'password');

    if (auth()->attempt($credentials)) {
        return redirect('/admin/dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});

// Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function () {
    $data = request()->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:8',
    ]);

    $user = App\Models\User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'role' => 'student',
    ]);

    auth()->login($user);

    return redirect('/admin/dashboard');
});

// Logout
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');