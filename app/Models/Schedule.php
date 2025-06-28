<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 
        'day_of_week',
        'session_date',
        'start_time',
        'end_time',
        'room_id',
        'title',
        'description',
        'day', 
        'time',
        'duration',
        'location',
        'status'
    ];

    public function course() 
    { 
        return $this->belongsTo(Course::class); 
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
