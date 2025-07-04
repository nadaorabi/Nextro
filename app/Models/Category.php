<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
