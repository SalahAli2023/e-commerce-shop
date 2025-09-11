<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    //Show all categories
    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);
        return CategoryResource::collection($categories);
    }

    //Show a specific category
    public function show(Category $category)
    {
        return new CategoryResource($category->load('products'));
    }

    //Create a category
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);

        $category = Category::create($validated);

        return new CategoryResource($category);
    }

    // Update a category
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id
        ]);

        $category->update($validated);

        return new CategoryResource($category);
    }

    //Delete a category 
    public function destroy(Category $category)
    {
        // Check if there are any products associated with the category
        if ($category->products()->exists()) {
            return response()->json([
                'message' => 'Cannot delete category with associated products'
            ], Response::HTTP_CONFLICT);
        }

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully'
        ], Response::HTTP_OK);
    }
}