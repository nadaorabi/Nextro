<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'created_by', 'title', 'exam_date', 'duration'];

    public function course() 
    { 
        return $this->belongsTo(Course::class); 
    }

    public function creator() 
    { 
        return $this->belongsTo(User::class, 'created_by'); 
    }
}
