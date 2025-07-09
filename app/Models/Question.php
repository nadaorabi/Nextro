<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'exam_id',
        'question_text',
        'type',
        'grade'
    ];

    protected $casts = [
        'grade' => 'decimal:2'
    ];

    // Relationships
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}
