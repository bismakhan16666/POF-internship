@extends('layouts.app')

@section('title', 'Courses List')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="page-title">Courses List</h1>
        <p class="page-subtitle">Total: {{ count($courses) }} courses</p>
    </div>
    <div>
        <a href="/students" class="btn-primary-custom" style="margin-right: 10px;">
            Back to Students
        </a>
        <a href="/seed-courses" class="btn-primary-custom" style="background: linear-gradient(135deg, #38ef7d, #11998e);">
            Seed Courses
        </a>
    </div>
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

<div class="card-custom">
    @if($courses->isEmpty())
        <div class="text-center py-5">
            <p style="color: rgba(255,255,255,0.4); font-size: 1.1rem;">No courses found.</p>
            <a href="/seed-courses" class="btn-primary-custom" style="margin-top: 10px; background: linear-gradient(135deg, #38ef7d, #11998e);">
                Seed Courses
            </a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table-custom" style="width: 100%; border-collapse: collapse; color: #ffffff;">
                <thead>
                    <tr>
                        <th style="background: rgba(255,255,255,0.03); color: rgba(255,255,255,0.5); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 14px 18px; border: none;">ID</th>
                        <th style="background: rgba(255,255,255,0.03); color: rgba(255,255,255,0.5); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 14px 18px; border: none;">Name</th>
                        <th style="background: rgba(255,255,255,0.03); color: rgba(255,255,255,0.5); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 14px 18px; border: none;">Code</th>
                        <th style="background: rgba(255,255,255,0.03); color: rgba(255,255,255,0.5); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 14px 18px; border: none;">Credit Hours</th>
                        <th style="background: rgba(255,255,255,0.03); color: rgba(255,255,255,0.5); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; padding: 14px 18px; border: none;">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr style="background: rgba(255,255,255,0.03); border-radius: 12px; transition: all 0.3s ease;">
                            <td style="color: #667eea; font-weight: 700; padding: 14px 18px; border: none; border-radius: 12px 0 0 12px;">#{{ $course->id }}</td>
                            <td style="color: #ffffff; font-weight: 600; padding: 14px 18px; border: none;">{{ $course->name }}</td>
                            <td style="padding: 14px 18px; border: none;">
                                <span style="background: rgba(102, 126, 234, 0.2); border: 1px solid rgba(102, 126, 234, 0.2); padding: 4px 14px; border-radius: 50px; font-size: 0.8rem; color: #ffffff; font-weight: 600;">
                                    {{ $course->code }}
                                </span>
                            </td>
                            <td style="color: #ffffff; padding: 14px 18px; border: none;">{{ $course->credit_hours }}</td>
                            <td style="color: #dddddd; padding: 14px 18px; border: none; border-radius: 0 12px 12px 0;">{{ $course->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<style>
    .table-custom {
        width: 100%;
        border-collapse: collapse;
        color: #ffffff !important;
    }
    .table-custom thead th {
        background: rgba(255,255,255,0.03);
        color: rgba(255,255,255,0.5) !important;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 14px 18px;
        border: none;
    }
    .table-custom tbody tr {
        background: rgba(255,255,255,0.03);
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    .table-custom tbody tr:hover {
        background: rgba(255,255,255,0.06) !important;
        transform: scale(1.01);
        box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    }
    .table-custom tbody td {
        padding: 14px 18px;
        border: none;
        color: #ffffff !important;
        vertical-align: middle;
        font-size: 0.95rem;
    }
    .table-custom tbody td:first-child {
        border-radius: 12px 0 0 12px;
    }
    .table-custom tbody td:last-child {
        border-radius: 0 12px 12px 0;
    }
    /* ===== YEH LINE ADD KAREIN ===== */
    .table-custom tbody td span {
        color: #ffffff !important;
    }
</style>

@endsection