@extends('layouts.app')

@section('title', 'Add Student')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card-custom">
            <div class="text-center mb-4">
                <h1 class="page-title" style="font-size: 1.8rem;">
                    <i class="fas fa-user-plus" style="background: linear-gradient(135deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                    Add Student
                </h1>
                <p class="page-subtitle">Fill in the details to add a new student</p>
            </div>

            @if(session('success'))
                <div class="alert alert-custom-success">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-custom-error">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <ul class="mb-0 mt-1" style="padding-left:20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('students.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label-custom">
                        <i class="fas fa-user me-1" style="color: #667eea;"></i> Full Name
                    </label>
                    <input type="text" name="name" id="name" 
                           class="form-control-custom" 
                           placeholder="Enter student name" 
                           value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label-custom">
                        <i class="fas fa-envelope me-1" style="color: #667eea;"></i> Email Address
                    </label>
                    <input type="email" name="email" id="email" 
                           class="form-control-custom" 
                           placeholder="Enter student email" 
                           value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label-custom">
                        <i class="fas fa-calendar me-1" style="color: #667eea;"></i> Age
                    </label>
                    <input type="number" name="age" id="age" 
                           class="form-control-custom" 
                           placeholder="Enter student age" 
                           value="{{ old('age') }}" required>
                    @error('age')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="course" class="form-label-custom">
                        <i class="fas fa-book me-1" style="color: #667eea;"></i> Course
                    </label>
                    <input type="text" name="course" id="course" 
                           class="form-control-custom" 
                           placeholder="Enter course name" 
                           value="{{ old('course') }}" required>
                    @error('course')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-primary-custom w-100">
                    <i class="fas fa-save"></i> Add Student
                </button>
            </form>
        </div>
    </div>
</div>

@endsection