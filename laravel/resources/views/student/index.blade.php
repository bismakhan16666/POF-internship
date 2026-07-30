@extends('layouts.app')

@section('title', 'Students List')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="page-title">Students List</h1>
        <p class="page-subtitle">Total: {{ count($students) }} students</p>
    </div>
    <a href="{{ route('students.create') }}" class="btn-primary-custom">
        <i class="fas fa-plus"></i> Add New Student
    </a>
</div>

@if(session('success'))
    <div class="alert alert-custom-success">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-custom-error">
        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
    </div>
@endif

<div class="card-custom">
    @if($students->isEmpty())
        <div class="text-center py-5 empty-state">
            <i class="fas fa-user-graduate"></i>
            <p class="mb-3">No students found.</p>
            <a href="{{ route('students.create') }}" class="btn-primary-custom">
                <i class="fas fa-plus"></i> Add Your First Student
            </a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table-custom" style="width: 100%; border-collapse: collapse; color: #ffffff;">
                <thead>
                    <tr>
                        <th style="background: rgba(255,255,255,0.03); color: rgba(255,255,255,0.5); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 14px 18px; border: none;">ID</th>
                        <th style="background: rgba(255,255,255,0.03); color: rgba(255,255,255,0.5); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 14px 18px; border: none;">Name</th>
                        <th style="background: rgba(255,255,255,0.03); color: rgba(255,255,255,0.5); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 14px 18px; border: none;">Email</th>
                        <th style="background: rgba(255,255,255,0.03); color: rgba(255,255,255,0.5); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 14px 18px; border: none;">Age</th>
                        <th style="background: rgba(255,255,255,0.03); color: rgba(255,255,255,0.5); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 14px 18px; border: none;">Course</th>
                        <th style="background: rgba(255,255,255,0.03); color: rgba(255,255,255,0.5); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 14px 18px; border: none; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr style="background: rgba(255,255,255,0.03); border-radius: 12px; transition: all 0.3s ease;">
                            <td style="color: #667eea; font-weight: 700; padding: 14px 18px; border: none; border-radius: 12px 0 0 12px;">#{{ $student->id }}</td>
                            <td style="color: #ffffff; font-weight: 600; padding: 14px 18px; border: none;">{{ $student->name }}</td>
                            <td style="color: #ffffff; padding: 14px 18px; border: none;">{{ $student->email }}</td>
                            <td style="color: #ffffff; padding: 14px 18px; border: none;">{{ $student->age }}</td>
                            <td style="padding: 14px 18px; border: none;">
                                <span style="background: #667eea; border: none; padding: 4px 14px; border-radius: 50px; font-size: 0.8rem; color: #ffffff; font-weight: 600; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);">
                                    {{ $student->course }}
                                </span>
                            </td>
                            <td style="padding: 14px 18px; border: none; border-radius: 0 12px 12px 0; text-align: center;">
                                <a href="{{ route('students.edit', $student->id) }}" 
                                   style="background: #667eea; border: none; color: #ffffff; padding: 4px 14px; border-radius: 50px; font-weight: 500; font-size: 0.75rem; text-decoration: none; display: inline-block; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="/student/{{ $student->id }}/courses" 
                                   style="background: #38ef7d; border: none; color: #000000; padding: 4px 14px; border-radius: 50px; font-weight: 500; font-size: 0.75rem; text-decoration: none; display: inline-block; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(56, 239, 125, 0.3);">
                                    <i class="fas fa-book"></i> Courses
                                </a>
                                <a href="/students/{{ $student->id }}/enroll-form" 
                                   style="background: #4facfe; border: none; color: #ffffff; padding: 4px 14px; border-radius: 50px; font-weight: 500; font-size: 0.75rem; text-decoration: none; display: inline-block; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);">
                                    <i class="fas fa-plus"></i> Enroll
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" 
                                      method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            style="background: transparent; border: 1px solid rgba(245, 87, 108, 0.3); color: #f5576c; padding: 4px 14px; border-radius: 50px; font-weight: 500; font-size: 0.75rem; cursor: pointer; transition: all 0.3s ease;"
                                            onmouseover="this.style.background='rgba(245,87,108,0.1)'; this.style.color='#ff6b81';"
                                            onmouseout="this.style.background='transparent'; this.style.color='#f5576c';"
                                            onclick="return confirm('Are you sure you want to delete this student?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<style>
    .table-custom tbody tr:hover {
        background: rgba(255,255,255,0.06) !important;
        transform: scale(1.01);
        box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    }
</style>

@endsection