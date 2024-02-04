<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function page()
    {
        $categories = Category::with('barangs')->get();
        return view('category.index', compact('categories'));
    }

    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categoryManagement', compact('categories'));
    }

    public function show(Category $category)
    {
        $category->load('barangs'); 

        return view('category.show', compact('category',));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('dashboard.category.index');
    }

    public function destroy(Category $category)
    {
        // Ensure the category exists
        if (!$category) {
            return redirect()->route('dashboard.category.index')
                ->with('error', 'Category not found');
        }

        // Delete the category and its associated barangs
        $category->delete();

        return redirect()->route('dashboard.category.index')
            ->with('success', 'Category and associated barangs deleted successfully');
    }
}
