<?php

use Illuminate\Support\Facades\Route;

// ========== DAY 5 -  MULTI-PAGE WEBSITE ==========

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/contact', function () {
    return view('contact');
});