<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description', 
        'price',
        'on_sale',
        'image_path',
        'category_id'
    ];

    //الحصول على الفئة المرتبطة بهذا المنتج.
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    //الحصول على المراجعات المرتبطة بهذا المنتج.
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
