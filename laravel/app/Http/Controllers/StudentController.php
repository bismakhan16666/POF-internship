<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Show Registration Form
    public function create()
    {
        return view('student.create');
    }

    // Store Student Data
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'age' => 'required|integer|min:1|max:150',
            'course' => 'required|string|max:255'
        ]);

        // Insert Data
        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'course' => $request->course
        ]);

        return redirect('/students')->with('success', 'Student added successfully!');
    }

    // Show All Students
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
    }
}