<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Show All Students
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    // Show Registration Form
    public function create()
    {
        return view('student.create');
    }

    // Store Student Data
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'age' => 'required|integer|min:1|max:150',
            'course' => 'required|string|max:255'
        ]);

        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'course' => $request->course
        ]);

        return redirect('/students')->with('success', 'Student added successfully!');
    }

    // Show Edit Form
    public function edit($id)
    {
        $student = Student::find($id);

        if ($student) {
            return view('student.edit', compact('student'));
        } else {
            return redirect('/students')->with('error', 'Student not found!');
        }
    }

    // Update Student Data
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return redirect('/students')->with('error', 'Student not found!');
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

        return redirect('/students')->with('success', 'Student updated successfully!');
    }

    // Delete Student
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