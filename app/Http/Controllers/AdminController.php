<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    // Display all products in admin interface
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // Display form to create new product in admin interface
    public function create()
    {
        return view('admin.products.create');
    }

    // Display product details in admin interface
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    // Display form to edit product in admin interface
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    // Save the new 
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
            'on_sale' => $request->has('on_sale'),
            'image_path' => $imagePath
        ]);

        return redirect()->route('admin.products.index')
                        ->with('success', 'Product created successfully!');
    }

    // Product update processing
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        // التحقق من صحة البيانات
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'price' => 'required|numeric|min:0',
            'on_sale' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // معالجة رفع الصورة إذا تم توفيرها
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image_path = $imagePath;
        }

        // تحديث المنتج باستخدام fillable properties
        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'on_sale' => $request->has('on_sale'),
            'image_path' => $product->image_path
        ]);

        return redirect()->route('admin.products.index')
                        ->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        //
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        
        $product->delete();
        
        return redirect()->route('admin.products.index')
                        ->with('success', 'Product deleted successfully!');
    }
}
