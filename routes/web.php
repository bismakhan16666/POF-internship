<?php

use Illuminate\Support\Facades\Route;
use App\Models\Student;

// ========== DAY 7 - MODELS & ELOQUENT ORM ==========

// 1. INSERT DATA 
Route::get('/add-student', function () {
    $student = new Student();
    $student->name = "Bisma Khan";
    $student->email = "bisma123@example.com";
    $student->age = 22;
    $student->course = "Laravel Internship";
    $student->save();

    return "Student added successfully! ";
});

// 2. INSERT DATA using create() method
Route::get('/add-student-2', function () {
    Student::create([
        'name' => 'Ahmed Ali',
        'email' => 'ahmed123@example.com',
        'age' => 24,
        'course' => 'Web Development'
    ]);

    return "Student added using create() method! ";
});

// 3. FETCH ALL DATA 
Route::get('/students', function () {
    $students = Student::all();

    echo "<h1>All Students</h1>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th><th>Course</th></tr>";
    
    foreach ($students as $student) {
        echo "<tr>";
        echo "<td>" . $student->id . "</td>";
        echo "<td>" . $student->name . "</td>";
        echo "<td>" . $student->email . "</td>";
        echo "<td>" . $student->age . "</td>";
        echo "<td>" . $student->course . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
});

// 4. FETCH SINGLE STUDENT  
Route::get('/student/{id}', function ($id) {
    $student = Student::find($id);

    if ($student) {
        return "Student found: " . $student->name . " (Email: " . $student->email . ")";
    } else {
        return "Student not found! ";
    }
});

// 5. UPDATE DATA 
Route::get('/update-student/{id}', function ($id) {
    $student = Student::find($id);

    if ($student) {
        $student->course = "Advanced Laravel";
        $student->save();
        return "Student updated successfully! ";
    } else {
        return "Student not found! ";
    }
});

// 6. DELETE DATA 
Route::get('/delete-student/{id}', function ($id) {
    $student = Student::find($id);

    if ($student) {
        $student->delete();
        return "Student deleted successfully! ";
    } else {
        return "Student not found! ";
    }
});