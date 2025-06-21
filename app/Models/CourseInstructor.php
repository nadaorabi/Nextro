<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseInstructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 
        'instructor_id', 
        'role',
        'notes',
        'semester'
    ];

    public function course() 
    { 
        return $this->belongsTo(Course::class); 
    }

    public function user() 
    { 
        return $this->belongsTo(User::class, 'instructor_id'); 
    }

    public function instructor() 
    { 
        return $this->belongsTo(User::class, 'instructor_id'); 
    }
}
