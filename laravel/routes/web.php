<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

// ============================================
// DAY 8 - FORMS, VALIDATION, REQUESTS
// ============================================

// Show Registration Form
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');

// Store Student Data
Route::post('/students', [StudentController::class, 'store'])->name('students.store');

// Show All Students
Route::get('/students', [StudentController::class, 'index'])->name('students.index');