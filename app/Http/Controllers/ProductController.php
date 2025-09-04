<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
     // Show all products
    public function index()
    {
        $products = Product::all();
        return view('shop.products', compact('products'));
    }

    // Show single product
    public function show($id)
    {
        $product = Product::findOrFail($id);// هذه الدالة تقوم بالبحث عن الايدي المطلوب واذا لم تجده ترجع خطأ 404
        return view('shop.product-details', compact('product'));
    }
}
