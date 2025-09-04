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

    // show form of adding a new product  
    public function create()
    {
        return view('shop.create-product');
    }

    //To process the creation of a new product
    public function store(Request $request)
    {
        // validation
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'price' => 'required|numeric|min:0',
            'on_sale' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // To process the image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // create product
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'on_sale' => $request->has('on_sale'),
            'image_path' => $imagePath
        ]);

        return redirect()->route('products.index')
                        ->with('success', 'Product created successfully!');
    }

    // show form of updating a product 
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.edit-product', compact('product'));
    }

    //To process the update of a new product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        // validation
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'price' => 'required|numeric|min:0',
            'on_sale' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // To process the image upload
        if ($request->hasFile('image')) {
            // Delete old imag
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image_path = $imagePath;
        }

        //  update product
        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'on_sale' => $request->has('on_sale'),
            'image_path' => $product->image_path
        ]);

        return redirect()->route('products.index')
                        ->with('success', 'Product updated successfully!');
    }
}
