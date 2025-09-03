<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    // Sample products data
    private $products = [
        [
            'id' => 1,
            'name' => 'Hand Watch AI',
            'price' => 79.99,
            'on_sale' => true,
            'description' => 'High-quality wireless watch with against water.'
        ],
        [
            'id' => 2,
            'name' => 'Hand Watch PR',
            'price' => 499.99,
            'on_sale' => false,
            'description' => 'Latest smart watch with advanced features.'
        ],
        [
            'id' => 3,
            'name' => 'Iso Watch',
            'price' => 899.99,
            'on_sale' => true,
            'description' => 'Watch against water.'
        ],
        [
            'id' => 4,
            'name' => 'Smart Watch',
            'price' => 199.99,
            'on_sale' => false,
            'description' => 'Track your fitness and receive notifications on your wrist.'
        ]
    ];

    // Home page
    public function index()
    {
        return view('shop.index');
    }

    // Products page
    public function products()
    {
        return view('shop.products', ['products' => $this->products]);
    }

    // Product details page
    public function productDetails($id)
    {
        $product = collect($this->products)->firstWhere('id', $id);
        
        if (!$product) {
            abort(404);
        }
        
        return view('shop.product-details', compact('product'));
    }

    // Cart page
    public function cart()
    {
        return view('shop.cart');
    }

    // About Us page
    public function about()
    {
        $aboutData = [
            'title' => 'About Our Store',
            'description' => 'We are a leading e-commerce store dedicated to providing high-quality products at competitive prices. Our mission is to make online shopping convenient and enjoyable for everyone.',
            'rawHtml' => '<p>Founded in <strong>2020</strong>, we have served over <em>10,000</em> satisfied customers worldwide.</p>'
        ];
        
        return view('shop.about-us', $aboutData);
    }

    // Contact page
    public function contact()
    {
        return view('shop.contact');
    }
}