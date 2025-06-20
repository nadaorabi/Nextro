<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPackage extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'package_id', 'amount_paid', 'purchase_date'];

    public function student() 
    { 
        return $this->belongsTo(User::class, 'student_id'); 
    }

    public function package() 
    { 
        return $this->belongsTo(Package::class); 
    }
}
