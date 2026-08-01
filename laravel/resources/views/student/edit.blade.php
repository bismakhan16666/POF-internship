@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card-custom">
            <h1 class="page-title text-center mb-4" style="font-size: 1.8rem;">
                Edit Student
            </h1>

            @if($errors->any())
                <div class="alert alert-custom-error">
                    <ul class="mb-0 mt-1" style="padding-left:20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="text-center mb-4">
                <img src="{{ $student->avatar ? asset('storage/' . $student->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($student->name) . '&background=667eea&color=fff&size=100&rounded=true' }}" 
                     alt="{{ $student->name }}" 
                     style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid rgba(255,255,255,0.1);">
                <p style="color: rgba(255,255,255,0.3); font-size: 0.8rem; margin-top: 5px;">Current Avatar</p>
            </div>

            <!-- ===== FIX: route() mein $student pass karein ===== -->
            <form action="{{ route('students.update', $student) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label-custom">Full Name</label>
                    <input type="text" name="name" id="name" 
                           class="form-control-custom" 
                           placeholder="Enter student name" 
                           value="{{ old('name', $student->name) }}" required>
                    @error('name')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label-custom">Email Address</label>
                    <input type="email" name="email" id="email" 
                           class="form-control-custom" 
                           placeholder="Enter student email" 
                           value="{{ old('email', $student->email) }}" required>
                    @error('email')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label-custom">Age</label>
                    <input type="number" name="age" id="age" 
                           class="form-control-custom" 
                           placeholder="Enter student age" 
                           value="{{ old('age', $student->age) }}" required>
                    @error('age')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="course" class="form-label-custom">Course</label>
                    <input type="text" name="course" id="course" 
                           class="form-control-custom" 
                           placeholder="Enter course name" 
                           value="{{ old('course', $student->course) }}" required>
                    @error('course')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="avatar" class="form-label-custom">Change Profile Picture</label>
                    <input type="file" name="avatar" id="avatar" 
                           class="form-control-custom" 
                           accept="image/*">
                    <p style="color: rgba(255,255,255,0.3); font-size: 0.75rem; margin-top: 5px;">
                        Supported formats: JPEG, PNG, JPG, GIF (Max: 2MB)
                    </p>
                    @error('avatar')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-primary-custom w-100">
                    Update Student
                </button>
            </form>
        </div>
    </div>
</div>

@endsection