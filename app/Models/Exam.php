<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 
        'teacher_id',
        'title', 
        'description',
        'type',
        'delivery_type',
        'file_path',
        'start_at',
        'end_at',
        'total_grade',
        'exam_date', 
        'duration',
        'created_by'
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'exam_date' => 'date',
        'total_grade' => 'decimal:2'
    ];

    public function course() 
    { 
        return $this->belongsTo(Course::class); 
    }

    public function teacher() 
    { 
        return $this->belongsTo(User::class, 'teacher_id'); 
    }

    public function creator() 
    { 
        return $this->belongsTo(User::class, 'created_by'); 
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function submissions()
    {
        return $this->hasMany(ExamSubmission::class);
    }
}
