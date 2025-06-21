<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'credit_hours', 
        'price',
        'currency',
        'discount_percentage',
        'is_free',
        'status', 
        'category_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'is_free' => 'boolean',
    ];

    public function category() 
    { 
        return $this->belongsTo(Category::class); 
    }

    public function instructors() 
    { 
        return $this->hasMany(CourseInstructor::class); 
    }

    public function enrollments() 
    { 
        return $this->hasMany(Enrollment::class); 
    }

    public function schedules() 
    { 
        return $this->hasMany(Schedule::class); 
    }

    public function materials() 
    { 
        return $this->hasMany(Material::class); 
    }

    public function exams() 
    { 
        return $this->hasMany(Exam::class); 
    }

    public function messages() 
    { 
        return $this->hasMany(Message::class); 
    }

    public function complaints() 
    { 
        return $this->hasMany(Complaint::class); 
    }

    public function packages() 
    { 
        return $this->belongsToMany(Package::class, 'package_courses'); 
    }

    // في app/Models/Course.php

public function course_instructors()
{
    return $this->hasMany(CourseInstructor::class, 'course_id');
}

// Get final price after discount
public function getFinalPriceAttribute()
{
    if ($this->is_free) {
        return 0;
    }
    
    if ($this->discount_percentage > 0) {
        $discount = ($this->price * $this->discount_percentage) / 100;
        return $this->price - $discount;
    }
    
    return $this->price;
}

// Get formatted price
public function getFormattedPriceAttribute()
{
    if ($this->is_free) {
        return 'Free';
    }
    
    $price = $this->final_price;
    return number_format($price, 2) . ' ' . $this->currency;
}

// Get original formatted price
public function getFormattedOriginalPriceAttribute()
{
    if ($this->is_free) {
        return 'Free';
    }
    
    return number_format($this->price, 2) . ' ' . $this->currency;
}

// Check if course has discount
public function hasDiscount()
{
    return $this->discount_percentage > 0 && !$this->is_free;
}

// Get discount amount
public function getDiscountAmountAttribute()
{
    if (!$this->hasDiscount()) {
        return 0;
    }
    
    return ($this->price * $this->discount_percentage) / 100;
}
}
