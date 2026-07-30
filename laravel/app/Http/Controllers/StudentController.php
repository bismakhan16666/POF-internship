<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     */
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created student in the database.
     */
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

    /**
     * Show the form for editing the specified student.
     */
    public function edit($id)
    {
        $student = Student::find($id);

        if ($student) {
            return view('student.edit', compact('student'));
        } else {
            return redirect('/students')->with('error', 'Student not found!');
        }
    }

    /**
     * Update the specified student in the database.
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return redirect('/students')->with('error', 'Student not found!');
        }

        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'age' => 'required|integer|min:1|max:150',
            'course' => 'required|string|max:255'
        ]);

        // Update Data
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'course' => $request->course
        ]);

        return redirect('/students')->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified student from the database.
     */
    public function destroy($id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->delete();
            return redirect('/students')->with('success', 'Student deleted successfully!');
        } else {
            return redirect('/students')->with('error', 'Student not found!');
        }
    }
}