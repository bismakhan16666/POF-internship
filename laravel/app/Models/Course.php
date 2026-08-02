<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'credit_hours',
        'description'
    ];

    // Many-to-Many relationship with Students
    public function students()
    {
        return $this->belongsToMany(Student::class)
                    ->withPivot('enrollment_date')
                    ->withTimestamps();
    }

    // Get total students count
    public function getStudentsCountAttribute()
    {
        return $this->students()->count();
    }

    // Get course duration in weeks (if needed)
    public function getDurationInWeeksAttribute()
    {
        // Assuming each credit hour = 1 week
        return $this->credit_hours * 1;
    }
}