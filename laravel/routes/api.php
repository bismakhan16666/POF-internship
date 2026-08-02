<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Models\Course;
use App\Models\User;
use App\Http\Resources\StudentResource;
use App\Http\Resources\CourseResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

// ============================================
// DAY 20 - COMPLETE REST API
// ============================================

// ========== AUTHENTICATION ==========
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'student',
    ]);

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

Route::post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();
    return response()->json([
        'success' => true,
        'message' => 'Logout successful'
    ], 200);
})->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return response()->json([
        'success' => true,
        'message' => 'User retrieved successfully',
        'data' => $request->user()
    ], 200);
})->middleware('auth:sanctum');

// ============================================
// STUDENT API (Protected)
// ============================================

Route::middleware('auth:sanctum')->group(function () {

    // ===== SEARCH STUDENTS =====
    Route::get('/students/search', function (Request $request) {
        $query = Student::query()->with('courses');

        // Search by name
        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        // Search by email
        if ($request->has('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        // Filter by course
        if ($request->has('course_id')) {
            $query->whereHas('courses', function ($q) use ($request) {
                $q->where('course_id', $request->course_id);
            });
        }

        // Pagination
        $perPage = $request->per_page ?? 10;
        $students = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Students retrieved successfully',
            'data' => StudentResource::collection($students),
            'meta' => [
                'current_page' => $students->currentPage(),
                'per_page' => $students->perPage(),
                'total' => $students->total(),
                'last_page' => $students->lastPage(),
            ]
        ], 200);
    });

    // ===== GET ALL STUDENTS (With Pagination) =====
    Route::get('/students', function (Request $request) {
        $perPage = $request->per_page ?? 10;
        $students = Student::with('courses')->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Students retrieved successfully',
            'data' => StudentResource::collection($students),
            'meta' => [
                'current_page' => $students->currentPage(),
                'per_page' => $students->perPage(),
                'total' => $students->total(),
                'last_page' => $students->lastPage(),
            ]
        ], 200);
    });

    // ===== GET SINGLE STUDENT =====
    Route::get('/students/{id}', function ($id) {
        $student = Student::with('courses')->find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Student retrieved successfully',
            'data' => new StudentResource($student)
        ], 200);
    });

    // ===== CREATE STUDENT (With File Upload) =====
    Route::post('/students', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'age' => 'required|integer|min:1|max:150',
            'course_id' => 'required|exists:courses,id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'course_id' => $request->course_id,
        ]);

        // Handle Avatar Upload
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $student->update(['avatar' => $path]);
        }

        // Enroll in course
        $student->courses()->attach($request->course_id, [
            'enrollment_date' => now()->format('Y-m-d')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Student created successfully',
            'data' => new StudentResource($student->load('courses'))
        ], 201);
    });

    // ===== UPDATE STUDENT =====
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
            'course_id' => 'required|exists:courses,id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'course_id' => $request->course_id,
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $student->update(['avatar' => $path]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully',
            'data' => new StudentResource($student->load('courses'))
        ], 200);
    });

    // ===== DELETE STUDENT =====
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

    // ===== ENROLL STUDENT =====
    Route::post('/students/{studentId}/enroll/{courseId}', function ($studentId, $courseId) {
        $student = Student::find($studentId);
        $course = Course::find($courseId);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        if ($student->isEnrolledIn($courseId)) {
            return response()->json([
                'success' => false,
                'message' => 'Student already enrolled in this course'
            ], 422);
        }

        $student->courses()->attach($courseId, [
            'enrollment_date' => now()->format('Y-m-d')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Student enrolled successfully',
            'data' => new StudentResource($student->load('courses'))
        ], 201);
    });

    // ===== UNENROLL STUDENT =====
    Route::delete('/students/{studentId}/unenroll/{courseId}', function ($studentId, $courseId) {
        $student = Student::find($studentId);
        $course = Course::find($courseId);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        if (!$student->isEnrolledIn($courseId)) {
            return response()->json([
                'success' => false,
                'message' => 'Student is not enrolled in this course'
            ], 422);
        }

        $student->courses()->detach($courseId);

        return response()->json([
            'success' => true,
            'message' => 'Student unenrolled successfully',
            'data' => new StudentResource($student->load('courses'))
        ], 200);
    });
});

// ============================================
// COURSE API (Public)
// ============================================

// ===== GET ALL COURSES =====
Route::get('/courses', function (Request $request) {
    $perPage = $request->per_page ?? 10;
    $courses = Course::with('students')->paginate($perPage);

    return response()->json([
        'success' => true,
        'message' => 'Courses retrieved successfully',
        'data' => CourseResource::collection($courses),
        'meta' => [
            'current_page' => $courses->currentPage(),
            'per_page' => $courses->perPage(),
            'total' => $courses->total(),
            'last_page' => $courses->lastPage(),
        ]
    ], 200);
});

// ===== GET SINGLE COURSE =====
Route::get('/courses/{id}', function ($id) {
    $course = Course::with('students')->find($id);

    if (!$course) {
        return response()->json([
            'success' => false,
            'message' => 'Course not found'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'message' => 'Course retrieved successfully',
        'data' => new CourseResource($course)
    ], 200);
});

// ===== CREATE COURSE =====
Route::post('/courses', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50|unique:courses,code',
        'credit_hours' => 'required|integer|min:1|max:10',
        'description' => 'nullable|string'
    ]);

    $course = Course::create([
        'name' => $request->name,
        'code' => $request->code,
        'credit_hours' => $request->credit_hours,
        'description' => $request->description,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Course created successfully',
        'data' => new CourseResource($course)
    ], 201);
});

// ===== UPDATE COURSE =====
Route::put('/courses/{id}', function (Request $request, $id) {
    $course = Course::find($id);

    if (!$course) {
        return response()->json([
            'success' => false,
            'message' => 'Course not found'
        ], 404);
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50|unique:courses,code,' . $id,
        'credit_hours' => 'required|integer|min:1|max:10',
        'description' => 'nullable|string'
    ]);

    $course->update([
        'name' => $request->name,
        'code' => $request->code,
        'credit_hours' => $request->credit_hours,
        'description' => $request->description,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Course updated successfully',
        'data' => new CourseResource($course)
    ], 200);
});

// ===== DELETE COURSE =====
Route::delete('/courses/{id}', function ($id) {
    $course = Course::find($id);

    if (!$course) {
        return response()->json([
            'success' => false,
            'message' => 'Course not found'
        ], 404);
    }

    $course->delete();

    return response()->json([
        'success' => true,
        'message' => 'Course deleted successfully'
    ], 200);
});

// ============================================
// SEED DATA
// ============================================

Route::get('/seed-courses', function () {
    Course::truncate();

    $courses = [
        ['name' => 'Laravel Internship', 'code' => 'LAR-101', 'credit_hours' => 3, 'description' => 'Complete Laravel development course'],
        ['name' => 'Web Development', 'code' => 'WEB-101', 'credit_hours' => 4, 'description' => 'HTML, CSS, JavaScript, PHP'],
        ['name' => 'Database Management', 'code' => 'DB-101', 'credit_hours' => 2, 'description' => 'MySQL, PostgreSQL, MongoDB'],
        ['name' => 'React Native', 'code' => 'RN-101', 'credit_hours' => 3, 'description' => 'Mobile app development'],
        ['name' => 'Python Programming', 'code' => 'PY-101', 'credit_hours' => 3, 'description' => 'Python from basics to advanced'],
    ];

    foreach ($courses as $course) {
        Course::create($course);
    }

    return response()->json([
        'success' => true,
        'message' => '5 courses seeded successfully',
        'data' => Course::all()
    ], 201);
});

// ============================================
// HEALTH CHECK
// ============================================

Route::get('/health', function () {
    return response()->json([
        'status' => 'OK',
        'message' => 'API is working perfectly',
        'timestamp' => now()
    ], 200);
});