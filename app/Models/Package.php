<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function packageCourses()
    {
        return $this->hasMany(\App\Models\PackageCourse::class, 'package_id');
    }

    public function hasImage()
    {
        return $this->image && Storage::disk('public')->exists($this->image);
    }

    public function getImageUrl()
    {
        if ($this->hasImage()) {
            return asset('storage/' . $this->image);
        }
        return null;
    }
}
