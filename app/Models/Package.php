<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'category_id', 'price', 'discount_percentage', 'is_active'];

    public function category() 
    { 
        return $this->belongsTo(Category::class); 
    }

    public function courses() 
    { 
        return $this->belongsToMany(Course::class, 'package_courses'); 
    }

    public function students() 
    { 
        return $this->hasMany(StudentPackage::class); 
    }
}
