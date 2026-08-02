<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'credit_hours', 'description'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class)
                    ->withPivot('enrollment_date')
                    ->withTimestamps();
    }

    public function getStudentsCountAttribute()
    {
        return $this->students()->count();
    }
}