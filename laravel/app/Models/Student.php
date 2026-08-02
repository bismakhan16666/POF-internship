<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'age', 'course_id', 'avatar'
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class)
                    ->withPivot('enrollment_date')
                    ->withTimestamps();
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function isEnrolledIn($courseId)
    {
        return $this->courses()->where('course_id', $courseId)->exists();
    }

    public function getTotalCreditHoursAttribute()
    {
        return $this->courses()->sum('credit_hours');
    }
}