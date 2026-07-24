<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Yeh fields database mein insert ki ja sakti hain
    protected $fillable = [
        'name',
        'email',
        'age',
        'course'
    ];
}