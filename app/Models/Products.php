<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    // name product, description, price, image, category_id, and stock
    protected $fillable = ['name', 'description', 'price', 'image', 'category_id', 'stock'];
    // relationship with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
