<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'uploaded_by', 'title', 'file_url', 'type', 'upload_date'];

    public function course() 
    { 
        return $this->belongsTo(Course::class); 
    }

    public function uploader() 
    { 
        return $this->belongsTo(User::class, 'uploaded_by'); 
    }
}
