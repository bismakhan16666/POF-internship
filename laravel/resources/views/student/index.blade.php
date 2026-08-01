@extends('layouts.app')

@section('title', 'Students List')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="page-title">Students List</h1>
        <p class="page-subtitle">Total: {{ $students->total() }} students</p>
    </div>
    <a href="{{ route('students.create') }}" class="btn-primary-custom">
        <i class="fas fa-plus"></i> Add New Student
    </a>
</div>

<!-- ===== SEARCH FORM ===== -->
<div class="card-custom mb-4">
    <form method="GET" action="{{ route('students.index') }}" class="d-flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}" 
               placeholder="Search by name, email or course..." 
               class="form-control-custom" style="flex: 1;">
        <button type="submit" class="btn-primary-custom" style="padding: 10px 25px;">
            <i class="fas fa-search"></i> Search
        </button>
        @if(request('search'))
            <a href="{{ route('students.index') }}" class="btn-primary-custom" style="background: #f5576c; padding: 10px 25px;">
                <i class="fas fa-times"></i> Clear
            </a>
        @endif
    </form>
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
                        <th style="background: rgba(255,255,255,0.03); color: rgba(255,255,255,0.5); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 14px 18px; border: none;">Avatar</th>
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
                        @php
                            $boyNames = ['Ahmed Ali', 'Hassan Ali', 'Usman Ali', 'Omar Farooq', 'Rayan Ahmed', 'Hamza Ali', 'Zain Ahmed', 'Hasan Raza', 'Daniyal Ahmed', 'Fahad Khan'];
                            if (in_array($student->name, $boyNames)) {
                                $defaultAvatar = asset('storage/images/default-boy-avatar.png');
                            } else {
                                $defaultAvatar = asset('storage/images/default-avatar.png');
                            }
                        @endphp
                        <tr style="background: rgba(255,255,255,0.03); border-radius: 12px; transition: all 0.3s ease;">
                            <td style="padding: 14px 18px; border: none; border-radius: 12px 0 0 12px;">
                                <img src="{{ $student->avatar ? asset('storage/' . $student->avatar) : $defaultAvatar }}" 
                                     alt="{{ $student->name }}" 
                                     style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid rgba(255,255,255,0.1);">
                            </td>
                            <td style="color: #667eea; font-weight: 700; padding: 14px 18px; border: none;">#{{ $student->id }}</td>
                            <td style="color: #ffffff; font-weight: 600; padding: 14px 18px; border: none;">{{ $student->name }}</td>
                            <td style="color: #ffffff; padding: 14px 18px; border: none;">{{ $student->email }}</td>
                            <td style="color: #ffffff; padding: 14px 18px; border: none;">{{ $student->age }}</td>
                            <td style="padding: 14px 18px; border: none;">
                                <span style="background: #667eea; border: none; padding: 4px 14px; border-radius: 50px; font-size: 0.8rem; color: #ffffff; font-weight: 600;">
                                    {{ $student->course }}
                                </span>
                            </td>
                            <td style="padding: 14px 18px; border: none; border-radius: 0 12px 12px 0; text-align: center;">
                                <a href="{{ route('students.edit', $student) }}" 
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
                                <form action="{{ route('students.destroy', $student) }}" 
                                      method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            style="background: transparent; border: 1px solid rgba(245, 87, 108, 0.3); color: #f5576c; padding: 4px 14px; border-radius: 50px; font-weight: 500; font-size: 0.75rem; cursor: pointer; transition: all 0.3s ease;"
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
        
        <!-- ===== PAGINATION ===== -->
        <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3" style="padding: 15px 0; border-top: 1px solid rgba(255,255,255,0.04);">
            <p style="color: rgba(255,255,255,0.3); font-size: 0.85rem; margin: 0;">
                Showing <strong style="color: rgba(255,255,255,0.6);">{{ $students->firstItem() }}</strong> 
                to <strong style="color: rgba(255,255,255,0.6);">{{ $students->lastItem() }}</strong> 
                of <strong style="color: #667eea;">{{ $students->total() }}</strong> results
            </p>
            <div>
                {{ $students->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    @endif
</div>

<style>
    .table-custom tbody tr:hover {
        background: rgba(255,255,255,0.06) !important;
        transform: scale(1.01);
        box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    }
    
    /* ===== BOOTSTRAP 4 PAGINATION STYLES ===== */
    .pagination {
        display: flex;
        gap: 6px;
        list-style: none;
        padding: 0;
        margin: 0;
        flex-wrap: wrap;
        justify-content: flex-end;
    }
    .pagination li {
        display: inline-block;
    }
    .pagination li a, 
    .pagination li span {
        display: block;
        padding: 8px 16px;
        border-radius: 10px;
        color: rgba(255,255,255,0.5);
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        font-size: 0.85rem;
        font-weight: 500;
        min-width: 38px;
        text-align: center;
        cursor: pointer;
    }
    .pagination li a:hover {
        background: rgba(102, 126, 234, 0.15);
        color: #ffffff;
        border-color: rgba(102, 126, 234, 0.3);
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
    }
    .pagination li.active span {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
        border-color: transparent;
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
        transform: scale(1.08);
        font-weight: 700;
    }
    .pagination li.disabled span {
        opacity: 0.15;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }
    .pagination li:first-child a,
    .pagination li:last-child a {
        background: rgba(255,255,255,0.04);
        border-color: rgba(255,255,255,0.08);
        padding: 8px 20px;
        font-weight: 600;
        font-size: 0.85rem;
        color: rgba(255,255,255,0.5);
        min-width: auto;
        border-radius: 10px;
    }
    .pagination li:first-child a:hover,
    .pagination li:last-child a:hover {
        background: rgba(102, 126, 234, 0.15);
        border-color: rgba(102, 126, 234, 0.3);
        color: #ffffff;
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
    }
    .pagination li .page-link {
        background: transparent !important;
        border: none !important;
        color: rgba(255,255,255,0.15) !important;
        padding: 8px 6px;
        min-width: auto;
        font-size: 0.85rem;
        cursor: default;
    }
    .pagination li .page-link:hover {
        transform: none !important;
        box-shadow: none !important;
        background: transparent !important;
    }
    @media (max-width: 600px) {
        .pagination li a, 
        .pagination li span {
            padding: 6px 11px;
            font-size: 0.75rem;
            min-width: 32px;
            border-radius: 8px;
        }
        .pagination li:first-child a,
        .pagination li:last-child a {
            padding: 6px 14px;
            font-size: 0.75rem;
        }
        .d-flex.justify-content-between {
            flex-direction: column;
            align-items: center !important;
            gap: 8px;
        }
        .pagination {
            justify-content: center;
        }
    }
</style>

@endsection