<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;

// ============================================
// DAY 17 - API CRUD WITH VALIDATION
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

// ========== 3. CREATE STUDENT (POST) ==========
Route::post('/students', function (Request $request) {
    // Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:students,email',
        'age' => 'required|integer|min:1|max:150',
        'course' => 'required|string|max:255'
    ]);

    // Create student
    $student = Student::create([
        'name' => $request->name,
        'email' => $request->email,
        'age' => $request->age,
        'course' => $request->course
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Student created successfully',
        'data' => $student
    ], 201);
});

// ========== 4. UPDATE STUDENT (PUT) ==========
Route::put('/students/{id}', function (Request $request, $id) {
    $student = Student::find($id);
    
    if (!$student) {
        return response()->json([
            'success' => false,
            'message' => 'Student not found'
        ], 404);
    }

    // Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:students,email,' . $id,
        'age' => 'required|integer|min:1|max:150',
        'course' => 'required|string|max:255'
    ]);

    // Update student
    $student->update([
        'name' => $request->name,
        'email' => $request->email,
        'age' => $request->age,
        'course' => $request->course
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Student updated successfully',
        'data' => $student
    ], 200);
});

// ========== 5. DELETE STUDENT ==========
Route::delete('/students/{id}', function ($id) {
    $student = Student::find($id);
    
    if (!$student) {
        return response()->json([
            'success' => false,
            'message' => 'Student not found'
        ], 404);
    }

    $student->delete();

    return response()->json([
        'success' => true,
        'message' => 'Student deleted successfully'
    ], 200);
});

// ========== 6. SEED STUDENTS ==========
Route::get('/seed', function () {
    Student::truncate();
    
    $students = [
        ['name' => 'Bisma Khan', 'email' => 'bisma_' . rand(1,99999) . '@example.com', 'age' => 22, 'course' => 'Laravel Internship'],
        ['name' => 'Ahmed Ali', 'email' => 'ahmed_' . rand(1,99999) . '@example.com', 'age' => 24, 'course' => 'Web Development'],
        ['name' => 'Fatima Khan', 'email' => 'fatima_' . rand(1,99999) . '@example.com', 'age' => 23, 'course' => 'Laravel Internship'],
        ['name' => 'Hassan Ali', 'email' => 'hassan_' . rand(1,99999) . '@example.com', 'age' => 25, 'course' => 'Database Management'],
        ['name' => 'Ayesha Khan', 'email' => 'ayesha_' . rand(1,99999) . '@example.com', 'age' => 21, 'course' => 'Laravel Internship'],
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

// ========== 7. HEALTH CHECK ==========
Route::get('/health', function () {
    return response()->json([
        'status' => 'OK',
        'message' => 'API is working perfectly',
        'timestamp' => now()
    ], 200);
});