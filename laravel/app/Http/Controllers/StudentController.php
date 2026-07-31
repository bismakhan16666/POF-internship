<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    public function create()
    {
        return view('student.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'age' => 'required|integer|min:1|max:150',
            'course' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'course' => $request->course,
            'avatar' => $avatarPath,
        ]);

        return redirect('/students')->with('success', 'Student added successfully!');
    }

    public function edit($id)
    {
        $student = Student::find($id);
        if ($student) {
            return view('student.edit', compact('student'));
        } else {
            return redirect('/students')->with('error', 'Student not found!');
        }
    }

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
            'course' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $avatarPath = $student->avatar;
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($student->avatar && file_exists(storage_path('app/public/' . $student->avatar))) {
                unlink(storage_path('app/public/' . $student->avatar));
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'course' => $request->course,
            'avatar' => $avatarPath,
        ]);

        return redirect('/students')->with('success', 'Student updated successfully!');
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if ($student) {
            // Delete avatar if exists
            if ($student->avatar && file_exists(storage_path('app/public/' . $student->avatar))) {
                unlink(storage_path('app/public/' . $student->avatar));
            }
            $student->delete();
            return redirect('/students')->with('success', 'Student deleted successfully!');
        } else {
            return redirect('/students')->with('error', 'Student not found!');
        }
    }
}