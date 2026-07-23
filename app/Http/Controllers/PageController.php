<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Home Page
    public function home()
    {
        $name = "Bisma Khan";
        $course = "Laravel Internship";
        $institute = "POF";
        
        return view('home', compact('name', 'course', 'institute'));
    }

    // About Page
    public function about()
    {
        $title = "About Us";
        $description = "This is the about page of my Laravel website.";
        $author = "Bisma Khan";
        
        return view('about', compact('title', 'description', 'author'));
    }

    // Contact Page
    public function contact()
    {
        $email = "bisma@example.com";
        $phone = "+92-300-1234567";
        $address = "Wah Cantt, Pakistan";
        
        return view('contact', compact('email', 'phone', 'address'));
    }

    // Services Page
    public function services()
    {
        $services = [
            "Web Development",
            "Mobile App Development",
            "Laravel Development",
            "Database Management",
            "API Development"
        ];
        
        return view('services', compact('services'));
    }
}