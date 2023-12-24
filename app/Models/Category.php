<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // name category
    protected $fillable = ['name'];
    // relationship with products
    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
