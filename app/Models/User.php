<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $fillable = [
        'name', 'user_name', 'email', 'gender', 'password', 'father_name', 'mother_name', 'mobile', 'alt_mobile',
        'national_id', 'address', 'birth_date', 'notes', 'role', 'is_active', 'is_graduated', 'login_id','plain_password',
        'specialization', 'note', 'image', 'phone', 'profile_image'
    ];

    protected $hidden = ['password', 'remember_token'];

    public function enrollments() 
    { 
        return $this->hasMany(Enrollment::class, 'student_id'); 
    }

    public function packages() 
    { 
        return $this->hasMany(StudentPackage::class, 'student_id'); 
    }

    public function coursesTaught() 
    { 
        return $this->hasMany(CourseInstructor::class, 'instructor_id'); 
    }

    public function materials() 
    { 
        return $this->hasMany(Material::class, 'uploaded_by'); 
    }

    public function sentMessages() 
    { 
        return $this->hasMany(Message::class, 'sender_id'); 
    }

    public function receivedMessages() 
    { 
        return $this->hasMany(Message::class, 'receiver_id'); 
    }

    public function complaints() 
    { 
        return $this->hasMany(Complaint::class, 'student_id'); 
    }

    public function assignedComplaints() 
    { 
        return $this->hasMany(Complaint::class, 'assigned_to'); 
    }

    public function payments() 
    { 
        return $this->hasMany(Payment::class); 
    }

    public function studentNotes()
    {
        return $this->hasMany(\App\Models\StudentNote::class, 'student_id');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function isUser()
    {
        return $this->role === 'student';
    }

    public function isGraduated()
    {
        return $this->is_graduated === true;
    }

    public function toggleGraduationStatus()
    {
        $this->is_graduated = !$this->is_graduated;
        $this->save();
        return $this->is_graduated;
    }
}
