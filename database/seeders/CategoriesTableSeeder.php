<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // حذف الفئات الموجودة إذا كانت موجودة
        Category::query()->delete();
        
        // إنشاء الفئات الأساسية مع ضمان عدم تكرار الـ slugs
        $categories = [
            ['name' => 'Electronics'],
            ['name' => 'Clothing'],
            ['name' => 'Home & Kitchen'],
            ['name' => 'Books'],
            ['name' => 'Sports & Outdoors'],
            ['name' => 'Beauty & Personal Care'],
            ['name' => 'Toys & Games'],
            ['name' => 'Automotive'],
            ['name' => 'Health & Household'],
            ['name' => 'Jewelry'],
            ['name' => 'Tools & Home Improvement'],
            ['name' => 'Baby Products'],
            ['name' => 'Movies & Music'],
            ['name' => 'Pet Supplies'],
            ['name' => 'Grocery & Gourmet Food'],
        ];
        
        foreach ($categories as $category) {
            $slug = Str::slug($category['name']);
            $originalSlug = $slug;
            $counter = 1;
            
            // التأكد من أن الـ Slug فريد
            while (Category::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            
            Category::create([
                'name' => $category['name'],
                'slug' => $slug
            ]);
        }
        
        // إنشاء فئات إضافية باستخدام الفاكتوري (عدد أقل لتجنب التكرار)
        Category::factory()->count(15)->create();
        
        $this->command->info('✅ Categories created successfully!');
        $this->command->info('✅ Total categories: ' . Category::count());
        
        // عرض جميع الفئات التي تم إنشاؤها
        $this->command->info("\n📋 List of created categories:");
        $allCategories = Category::all();
        
        foreach ($allCategories as $category) {
            $this->command->info("   - {$category->name} (slug: {$category->slug})");
        }
    }
}