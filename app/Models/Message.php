<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id', 'receiver_id', 'course_id', 'subject', 'message_body', 'is_public', 'sent_at'];

    public function sender() 
    { 
        return $this->belongsTo(User::class, 'sender_id'); 
    }

    public function receiver() 
    { 
        return $this->belongsTo(User::class, 'receiver_id'); 
    }

    public function course() 
    { 
        return $this->belongsTo(Course::class); 
    }
}
