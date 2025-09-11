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

    //Get the category associated with this product.    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Get reviews related to this product.
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    //Inquiry range for products offered for sale.
    public function scopeOnSale($query)
    {
        return $query->where('on_sale', true);
    }

    //Query scope for products within a specific category.
    public function scopeInCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    //Get the discounted price attribute.
    public function getDiscountedPriceAttribute()
    {
        if ($this->on_sale) {
            return $this->price * 0.8; // 20% discount for products on sale
        }
        
        return $this->price;
    }

    // Get the products count for the category.
    public function getProductsCountAttribute()
    {
        return $this->products()->count();
    }

    //Get average product rating.
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    //Get the number of reviews for the product.
    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }
}
