<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageCourse extends Model
{
    use HasFactory;

    protected $fillable = ['package_id', 'course_id', 'discount_percentage'];

    public function package() 
    { 
        return $this->belongsTo(Package::class); 
    }

    public function course() 
    { 
        return $this->belongsTo(Course::class); 
    }
}
