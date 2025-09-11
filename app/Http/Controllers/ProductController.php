<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class ProductController extends Controller
{
     // Show all products
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // Display form to create new product in admin interface
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    //To process the creation of a new product
    public function store(Request $request)
    {
        // validation
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'on_sale' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Processing image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Create product using fillable properties
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'on_sale' => $request->has('on_sale'),
            'image_path' => $imagePath
        ]);

        return redirect()->route('admin.products')
                        ->with('success', 'Product created successfully!');
    }

    // Display product details in admin interface
    public function show($id)
    {
        // Find the product with category relationship loaded
        $product = Product::with('category')->findOrFail($id);  
        return view('admin.products.show', compact('product'));
    }

    // Display form to edit product in admin interface
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));
    }

    // Product update processing
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        // validation
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
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

        // update product using fillable properties
        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'on_sale' => $request->has('on_sale'),
            'image_path' => $product->image_path
        ]);
        
        return redirect()->route('admin.products')
                        ->with('success', 'Product updated successfully!');
    }

    //  Delete product function
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Delete image if is exist
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        
        $product->delete();
        
        return redirect()->route('admin.products')
                        ->with('success', 'Product deleted successfully!');
    }

    //Change sale state
    public function toggleSale(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            
            $product->update([
                'on_sale' => $request->on_sale
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Product sale status updated successfully',
                'on_sale' => $product->on_sale
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating product status: ' . $e->getMessage()
            ], 500);
        }
    }
}
