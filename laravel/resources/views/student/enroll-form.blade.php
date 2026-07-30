@extends('layouts.app')

@section('title', 'Enroll Student')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card-custom">
            <h1 class="page-title text-center mb-4" style="font-size: 1.8rem;">
                Enroll Student in Course
            </h1>

            <!-- Student Details -->
            <div style="background: rgba(255,255,255,0.03); padding: 15px 20px; border-radius: 12px; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.06);">
                <p style="color: rgba(255,255,255,0.4); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Student Information</p>
                <p style="color: #ffffff; font-size: 1.1rem; font-weight: 600;">{{ $student->name }}</p>
                <p style="color: rgba(255,255,255,0.5); font-size: 0.95rem;">{{ $student->email }}</p>
            </div>

            @if(session('success'))
                <div class="alert alert-custom-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-custom-error">
                    {{ session('error') }}
                </div>
            @endif

            <form action="/enroll-store" method="POST">
                @csrf
                <input type="hidden" name="student_id" value="{{ $student->id }}">

                <div class="mb-3">
                    <label for="course_id" class="form-label-custom">Select Course</label>
                    <select name="course_id" id="course_id" class="form-control-custom" required>
                        <option value="">-- Select a course --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" style="color: #000;">
                                {{ $course->name }} ({{ $course->code }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn-primary-custom w-100">
                    Enroll Student
                </button>
            </form>
        </div>
    </div>
</div>

@endsection