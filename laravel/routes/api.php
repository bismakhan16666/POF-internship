<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;

// ============================================
// DAY 16 - REST API FUNDAMENTALS
// ============================================

// ========== 1. GET ALL STUDENTS ==========
Route::get('/students', function () {
    $students = Student::all();
    
    return response()->json([
        'success' => true,
        'message' => 'Students retrieved successfully',
        'data' => $students
    ], 200);
});

// ========== 2. GET SINGLE STUDENT ==========
Route::get('/students/{id}', function ($id) {
    $student = Student::find($id);
    
    if (!$student) {
        return response()->json([
            'success' => false,
            'message' => 'Student not found'
        ], 404);
    }
    
    return response()->json([
        'success' => true,
        'message' => 'Student retrieved successfully',
        'data' => $student
    ], 200);
});

// ========== 3. GET STUDENTS WITH PAGINATION ==========
Route::get('/students-paginated', function () {
    $students = Student::paginate(5);
    
    return response()->json([
        'success' => true,
        'message' => 'Students retrieved successfully',
        'data' => $students->items(),
        'pagination' => [
            'current_page' => $students->currentPage(),
            'last_page' => $students->lastPage(),
            'per_page' => $students->perPage(),
            'total' => $students->total(),
            'next_page_url' => $students->nextPageUrl(),
            'prev_page_url' => $students->previousPageUrl(),
        ]
    ], 200);
});

// ========== 4. HEALTH CHECK ==========
Route::get('/health', function () {
    return response()->json([
        'status' => 'OK',
        'message' => 'API is working perfectly',
        'timestamp' => now()
    ], 200);
});

// ========== 5. SEED STUDENTS VIA API (FIXED) ==========
Route::get('/seed', function () {
    // Pehle saare students delete karein
    Student::truncate();
    
    $students = [
        ['name' => 'Bisma Khan', 'email' => 'bisma_' . rand(1, 99999) . '@example.com', 'age' => 22, 'course' => 'Laravel Internship', 'avatar' => null],
        ['name' => 'Ahmed Ali', 'email' => 'ahmed_' . rand(1, 99999) . '@example.com', 'age' => 24, 'course' => 'Web Development', 'avatar' => null],
        ['name' => 'Fatima Khan', 'email' => 'fatima_' . rand(1, 99999) . '@example.com', 'age' => 23, 'course' => 'Laravel Internship', 'avatar' => null],
        ['name' => 'Hassan Ali', 'email' => 'hassan_' . rand(1, 99999) . '@example.com', 'age' => 25, 'course' => 'Database Management', 'avatar' => null],
        ['name' => 'Ayesha Khan', 'email' => 'ayesha_' . rand(1, 99999) . '@example.com', 'age' => 21, 'course' => 'Laravel Internship', 'avatar' => null],
    ];
    
    foreach ($students as $student) {
        Student::create($student);
    }
    
    return response()->json([
        'success' => true,
        'message' => '5 students seeded successfully',
        'data' => Student::all()
    ], 201);
});