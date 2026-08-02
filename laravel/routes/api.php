<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

// ============================================
// DAY 18 - API AUTHENTICATION (SANCTUM)
// ============================================

// ========== 1. REGISTER API ==========
Route::post('/register', function (Request $request) {
    // Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Create User
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'student',
    ]);

    // Create Token
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'success' => true,
        'message' => 'User registered successfully',
        'data' => [
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer'
        ]
    ], 201);
});

// ========== 2. LOGIN API ==========
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'success' => true,
        'message' => 'Login successful',
        'data' => [
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer'
        ]
    ], 200);
});

// ========== 3. LOGOUT API ==========
Route::post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();
    return response()->json([
        'success' => true,
        'message' => 'Logout successful'
    ], 200);
})->middleware('auth:sanctum');

// ========== 4. GET USER PROFILE ==========
Route::get('/user', function (Request $request) {
    return response()->json([
        'success' => true,
        'message' => 'User retrieved successfully',
        'data' => $request->user()
    ], 200);
})->middleware('auth:sanctum');

// ========== 5. STUDENT CRUD (Protected) ==========
Route::middleware('auth:sanctum')->group(function () {
    // Get all students
    Route::get('/students', function () {
        $students = Student::all();
        return response()->json([
            'success' => true,
            'message' => 'Students retrieved successfully',
            'data' => $students
        ], 200);
    });

    // Get single student
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

    // Create student
    Route::post('/students', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'age' => 'required|integer|min:1|max:150',
            'course' => 'required|string|max:255'
        ]);

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

    // Update student
    Route::put('/students/{id}', function (Request $request, $id) {
        $student = Student::find($id);
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'age' => 'required|integer|min:1|max:150',
            'course' => 'required|string|max:255'
        ]);

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

    // Delete student
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
});

// ========== 6. SEED STUDENTS (Public) ==========
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

// ========== 7. HEALTH CHECK (Public) ==========
Route::get('/health', function () {
    return response()->json([
        'status' => 'OK',
        'message' => 'API is working perfectly',
        'timestamp' => now()
    ], 200);
});