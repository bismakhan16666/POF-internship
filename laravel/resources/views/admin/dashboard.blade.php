@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title">Admin Dashboard</h1>
        <p class="page-subtitle">Welcome, {{ Auth::user()->name }}!</p>
    </div>
    
    <!-- ===== LOGOUT BUTTON ===== -->
    <form method="POST" action="{{ url('/logout') }}">
        @csrf
        <button type="submit" 
                style="background: linear-gradient(135deg, #f5576c, #f093fb); border: none; color: #fff; padding: 10px 28px; border-radius: 50px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 8px 30px rgba(245,87,108,0.2);"
                onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 40px rgba(245,87,108,0.3)'"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 30px rgba(245,87,108,0.2)'">
            Logout
        </button>
    </form>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card-custom text-center">
            <h2 style="color: #ffffff; font-size: 2.5rem;">{{ \App\Models\Student::count() }}</h2>
            <p style="color: rgba(255,255,255,0.4);">Total Students</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-custom text-center">
            <h2 style="color: #ffffff; font-size: 2.5rem;">{{ \App\Models\Course::count() }}</h2>
            <p style="color: rgba(255,255,255,0.4);">Total Courses</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-custom text-center">
            <h2 style="color: #ffffff; font-size: 2.5rem;">{{ \App\Models\Student::with('courses')->get()->sum(fn($s) => $s->courses->count()) }}</h2>
            <p style="color: rgba(255,255,255,0.4);">Total Enrollments</p>
        </div>
    </div>
</div>

<div class="card-custom mt-4">
    <h3 style="color: #fff;">Quick Actions</h3>
    <div class="d-flex gap-3 flex-wrap mt-3">
        <a href="/students" class="btn-primary-custom">View Students</a>
        <a href="/students/create" class="btn-primary-custom" style="background: linear-gradient(135deg, #38ef7d, #11998e);">Add Student</a>
        <a href="/courses" class="btn-primary-custom" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">View Courses</a>
    </div>
</div>

@endsection