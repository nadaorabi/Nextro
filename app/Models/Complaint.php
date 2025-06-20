<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'course_id', 'message', 'status', 'assigned_to'];

    public function student() 
    { 
        return $this->belongsTo(User::class, 'student_id'); 
    }

    public function course() 
    { 
        return $this->belongsTo(Course::class); 
    }

    public function assignedAdmin() 
    { 
        return $this->belongsTo(User::class, 'assigned_to'); 
    }
}
