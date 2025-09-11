<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{


    //Display the main control panel
    public function dashboard()
    {
        // Check validity
        if (!Gate::allows('access-admin-panel')) {
            abort(403);
        }

        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_users' => User::count(),
            'products_on_sale' => Product::where('on_sale', true)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    //Show all products
    public function products()
    {
        // Check validity
        if (!Gate::allows('access-admin-panel')) {
            abort(403);
        }

        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products', compact('products'));
    }

    // Show all categories
    public function categories()
    {
        // Check validity
        if (!Gate::allows('access-admin-panel')) {
            abort(403);
        }

        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('admin.categories', compact('categories'));
    }
}
