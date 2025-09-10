<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryNames = [
            'Electronics', 'Clothing', 'Home & Kitchen', 'Books', 'Sports & Outdoors',
            'Beauty & Personal Care', 'Toys & Games', 'Automotive', 'Health & Household',
            'Jewelry', 'Tools & Home Improvement', 'Baby', 'Movies & Music', 'Pet Supplies',
            'Grocery & Gourmet Food', 'Office Products', 'Arts & Crafts', 'Shoes', 'Watches',
            'Furniture', 'Industrial & Scientific', 'Luggage', 'Cell Phones & Accessories',
            'Computer Components', 'Video Games', 'Musical Instruments', 'Gardening', 'Patio',
            'Lighting', 'Bedding', 'Bath', 'Storage', 'Kitchenware', 'Cookware', 'Tableware',
            'Home Decor', 'Wall Art', 'Rugs', 'Curtains', 'Pillows', 'Candles', 'Clocks'
        ];
        
        $name = $this->faker->unique()->randomElement($categoryNames);
        
        // إنشاء slug فريد
        $slug = Str::slug($name);
        $counter = 1;
        
        // التحقق من أن الـ Slug فريد
        while (Category::where('slug', $slug)->exists()) {
            $slug = Str::slug($name) . '-' . $counter;
            $counter++;
        }
        
        return [
            'name' => $name,
            'slug' => $slug,
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }

    /**
     * إنشاء فئة مع اسم محدد.
     */
    public function withName(string $name): static
    {
        // إنشاء slug فريد للاسم المحدد
        $slug = Str::slug($name);
        $counter = 1;
        
        while (Category::where('slug', $slug)->exists()) {
            $slug = Str::slug($name) . '-' . $counter;
            $counter++;
        }
        
        return $this->state(fn (array $attributes) => [
            'name' => $name,
            'slug' => $slug,
        ]);
    }

    /**
     * إنشاء فئة مع تاريخ إنشاء محدد.
     */
    public function withCreatedAt($date): static
    {
        return $this->state(fn (array $attributes) => [
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}