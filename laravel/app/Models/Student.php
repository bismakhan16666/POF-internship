<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'age',
        'course'
    ];

    // Many-to-Many relationship with Courses
    public function courses()
    {
        return $this->belongsToMany(Course::class)->withPivot('enrollment_date')->withTimestamps();
    }
}