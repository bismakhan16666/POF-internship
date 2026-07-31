@extends('layouts.app')

@section('title', 'Add Student')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card-custom">
            <h1 class="page-title text-center mb-4" style="font-size: 1.8rem;">
                Add Student
            </h1>

            @if(session('success'))
                <div class="alert alert-custom-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-custom-error">
                    <ul class="mb-0 mt-1" style="padding-left:20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label-custom">Full Name</label>
                    <input type="text" name="name" id="name" 
                           class="form-control-custom" 
                           placeholder="Enter student name" 
                           value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label-custom">Email Address</label>
                    <input type="email" name="email" id="email" 
                           class="form-control-custom" 
                           placeholder="Enter student email" 
                           value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label-custom">Age</label>
                    <input type="number" name="age" id="age" 
                           class="form-control-custom" 
                           placeholder="Enter student age" 
                           value="{{ old('age') }}" required>
                    @error('age')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="course" class="form-label-custom">Course</label>
                    <input type="text" name="course" id="course" 
                           class="form-control-custom" 
                           placeholder="Enter course name" 
                           value="{{ old('course') }}" required>
                    @error('course')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ===== AVATAR FIELD ===== -->
                <div class="mb-4">
                    <label for="avatar" class="form-label-custom">Profile Picture</label>
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
                    Add Student
                </button>
            </form>
        </div>
    </div>
</div>

@endsection