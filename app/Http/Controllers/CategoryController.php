<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keywords = $request->keywords;
        $data = Category::when($keywords, function ($query) use ($keywords) {
            $query->where('name', 'like', '%' . $keywords . '%');
        })
            ->paginate(20)
            ->withQueryString();
        return view('admin.category.index', compact('data', 'keywords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.category.index')
                         ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $category = Category::findOrFail($category->id);
        return view('admin.category.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($category->id);
        $category->update($request->all());

        return redirect()->route('admin.category.index')
                         ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category = Category::findOrFail($category->id);
        $category->delete();

        return redirect()->route('admin.category.index')
                         ->with('success', 'Category deleted successfully.');
    }
}
