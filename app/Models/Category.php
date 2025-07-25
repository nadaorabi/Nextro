<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status', 'image'];

    public function courses() 
    { 
        return $this->hasMany(Course::class); 
    }

    public function packages() 
    { 
        return $this->hasMany(Package::class); 
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
