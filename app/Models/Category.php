<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    //الحصول على المنتجات المرتبطة بهذه الفئة.
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    //إنشاء slug تلقائيًا عند حفظ النموذج.
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    //الحصول على عدد المنتجات في هذه الفئة.
    public function getProductsCountAttribute()
    {
        return $this->products()->count();
    }
}


