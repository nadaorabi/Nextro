<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseInstructor extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'instructor_id', 'semester'];

    public function course() 
    { 
        return $this->belongsTo(Course::class); 
    }

    public function instructor() 
    { 
        return $this->belongsTo(User::class, 'instructor_id'); 
    }
}
