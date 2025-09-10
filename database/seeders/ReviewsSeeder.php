<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Product;
use App\Models\User;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $products = Product::all();
        $users = User::all();

        // التأكد من وجود منتجات ومستخدمين
        if ($products->isEmpty() || $users->isEmpty()) {
            $this->command->info('No products or users found. Please run Products and Users seeders first.');
            return;
        }

        // إنشاء 200 مراجعة عشوائية
        Review::factory()->count(200)->create([
            'product_id' => function () use ($products) {
                return $products->random()->id;
            },
            'user_id' => function () use ($users) {
                return $users->random()->id;
            },
        ]);

        $this->command->info('200 reviews created successfully!');
        $this->command->info('Reviews linked to existing products and users!');
    }
}
