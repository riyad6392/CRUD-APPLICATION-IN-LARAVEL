<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function products(){
        return $this->hasMany(product::class);
    }
}
