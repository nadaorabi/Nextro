<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'title', 
        'description', 
        'category_id', 
        'price', 
        'currency',
        'discount_percentage', 
        'is_active',
        'status',
        'image',
        'original_price',
        'discounted_price',
    ];

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
