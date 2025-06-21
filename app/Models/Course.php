<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'credit_hours', 'status', 'category_id'];

    public function category() 
    { 
        return $this->belongsTo(Category::class); 
    }

    public function instructors() 
    { 
        return $this->hasMany(CourseInstructor::class); 
    }

    public function enrollments() 
    { 
        return $this->hasMany(Enrollment::class); 
    }

    public function schedules() 
    { 
        return $this->hasMany(Schedule::class); 
    }

    public function materials() 
    { 
        return $this->hasMany(Material::class); 
    }

    public function exams() 
    { 
        return $this->hasMany(Exam::class); 
    }

    public function messages() 
    { 
        return $this->hasMany(Message::class); 
    }

    public function complaints() 
    { 
        return $this->hasMany(Complaint::class); 
    }

    public function packages() 
    { 
        return $this->belongsToMany(Package::class, 'package_courses'); 
    }

    // في app/Models/Course.php

public function course_instructors()
{
    return $this->hasMany(CourseInstructor::class, 'course_id');
}
}
