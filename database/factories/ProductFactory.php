<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productNames = [
            'Wireless Headphones', 'Smartphone', 'Laptop', 'Smart Watch',
            'Bluetooth Speaker', 'Gaming Mouse', 'Mechanical Keyboard',
            'External Hard Drive', 'Wireless Charger', 'Fitness Tracker',
            'Tablet', 'Digital Camera', 'Noise Cancelling Earbuds',
            'Portable Monitor', 'VR Headset', 'Drone', 'Action Camera',
            'Smart Home Hub', 'Wireless Router', 'Graphic Drawing Tablet',
            'T-Shirt', 'Jeans', 'Jacket', 'Dress', 'Sneakers', 'Boots',
            'Sweater', 'Shorts', 'Skirt', 'Coat', 'Hat', 'Socks',
            'Coffee Maker', 'Blender', 'Toaster', 'Microwave', 'Vacuum Cleaner',
            'Air Fryer', 'Mixer', 'Food Processor', 'Pressure Cooker'
        ];
        
        $productName = $this->faker->randomElement($productNames);
        
        return [
            'name' => $productName,
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'on_sale' => $this->faker->boolean(30), // 30% chance of being on sale
            'image_path' => $this->faker->optional(0.7)->imageUrl(400, 400, 'technics'), // 70% chance of having an image
            'category_id' => \App\Models\Category::factory(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
    
    /**
     * منتجات معروضة للبيع.
     */
    public function onSale(): static
    {
        return $this->state(fn (array $attributes) => [
            'on_sale' => true,
            'price' => $this->faker->randomFloat(2, 5, 500), // أسعار أقل للعروض
        ]);
    }
    
    /**
     * منتجات غير معروضة للبيع.
     */
    public function notOnSale(): static
    {
        return $this->state(fn (array $attributes) => [
            'on_sale' => false,
        ]);
    }
    
    /**
     * منتجات بسعر مرتفع.
     */
    public function expensive(): static
    {
        return $this->state(fn (array $attributes) => [
            'price' => $this->faker->randomFloat(2, 500, 2000),
        ]);
    }
    
    /**
     * منتجات بسعر منخفض.
     */
    public function cheap(): static
    {
        return $this->state(fn (array $attributes) => [
            'price' => $this->faker->randomFloat(2, 5, 50),
        ]);
    }
    
    /**
     * منتجات بدون صورة.
     */
    public function noImage(): static
    {
        return $this->state(fn (array $attributes) => [
            'image' => null,
        ]);
    }
    
    /**
     * منتجات تابعة لفئة محددة.
     */
    public function forCategory($categoryId): static
    {
        return $this->state(fn (array $attributes) => [
            'category_id' => $categoryId,
        ]);
    }
}