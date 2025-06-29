<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['enrollment_id', 'schedule_id', 'date', 'status', 'method'];

    public function enrollment() 
    { 
        return $this->belongsTo(Enrollment::class); 
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
