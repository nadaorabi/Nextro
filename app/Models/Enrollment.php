<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'course_id', 'package_id', 'enrollment_date'];

    public function student() 
    { 
        return $this->belongsTo(User::class, 'student_id'); 
    }

    public function course() 
    { 
        return $this->belongsTo(Course::class); 
    }

    public function package() 
    { 
        return $this->belongsTo(Package::class); 
    }

    public function grades() 
    { 
        return $this->hasMany(Grade::class); 
    }

    public function attendance() 
    { 
        return $this->hasMany(Attendance::class); 
    }
}
