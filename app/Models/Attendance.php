<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id', 
        'schedule_id', 
        'student_id',
        'date', 
        'status', 
        'method',
        'marked_by',
        'marked_at'
    ];

    public function enrollment() 
    { 
        return $this->belongsTo(Enrollment::class); 
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function markedBy()
    {
        return $this->belongsTo(User::class, 'marked_by');
    }
}
