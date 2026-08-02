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
        'course',
        'avatar'
    ];

    // Many-to-Many relationship with Courses
    public function courses()
    {
        return $this->belongsToMany(Course::class)
                    ->withPivot('enrollment_date')
                    ->withTimestamps();
    }

    // Get all enrolled courses
    public function getEnrolledCoursesAttribute()
    {
        return $this->courses()->get();
    }

    // Check if student is enrolled in a specific course
    public function isEnrolledIn($courseId)
    {
        return $this->courses()->where('course_id', $courseId)->exists();
    }

    // Get total credit hours
    public function getTotalCreditHoursAttribute()
    {
        return $this->courses()->sum('credit_hours');
    }
}