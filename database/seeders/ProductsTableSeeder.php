<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // حذف المنتجات الموجودة إذا كانت موجودة
        Product::query()->delete();
        
        // الحصول على جميع الفئات
        $categories = Category::all();
        
        if ($categories->isEmpty()) {
            $this->command->info('No categories found. Please run Categories seeder first.');
            return;
        }
        
        $this->command->info("Creating products for {$categories->count()} categories...");
        
        // إنشاء منتجات لكل فئة
        foreach ($categories as $category) {
            $productsCount = rand(3, 8); // عدد أقل من المنتجات لكل فئة
            
            Product::factory()
                ->count($productsCount)
                ->forCategory($category->id)
                ->create();
                
            $this->command->info("   - Created {$productsCount} products for category: {$category->name}");
        }
        
        // إنشاء بعض المنتجات الإضافية المعروضة للبيع
        $onSaleCount = 15;
        Product::factory()
            ->count($onSaleCount)
            ->onSale()
            ->create();
            
        $this->command->info("   - Created {$onSaleCount} additional products on sale");
        
        // إنشاء بعض المنتجات الإضافية الغالية
        $expensiveCount = 8;
        Product::factory()
            ->count($expensiveCount)
            ->expensive()
            ->create();
            
        $this->command->info("   - Created {$expensiveCount} additional expensive products");
        
        // إنشاء بعض المنتجات الإضافية الرخيصة
        $cheapCount = 10;
        Product::factory()
            ->count($cheapCount)
            ->cheap()
            ->create();
            
        $this->command->info("   - Created {$cheapCount} additional cheap products");
        
        $totalProducts = Product::count();
        $onSaleProducts = Product::where('on_sale', true)->count();
        
        $this->command->info("\n✅ Products created successfully!");
        $this->command->info("✅ Total products: {$totalProducts}");
        $this->command->info("✅ Products on sale: {$onSaleProducts}");
        
        // عرض إحصاءات حسب الفئة
        $this->command->info("\n📊 Products by category:");
        $categoryStats = Category::withCount('products')->get();
        
        foreach ($categoryStats as $category) {
            $this->command->info("   - {$category->name}: {$category->products_count} products");
        }
    }
}