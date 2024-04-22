<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id', 'image'];
     public function getImageAttribute($value)
    { 
        return $value ? Storage::url('uploads/'.$value) : NULL; // Assuming the image path is stored in the database
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

     public function brand(){
        return $this->belongsTo(Brand::class);
    }
}

