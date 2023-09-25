<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;



class CategoryController extends Controller
{



   

    public function index()
    {
        Gate::authorize('manage-dashboard');
        $categories = Category::paginate(30);

        return view('categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('manage-dashboard');
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        Gate::authorize('manage-dashboard');
        Category::create($request->validated());

        return to_route('categories.index')->withMessage('Category has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        Gate::authorize('manage-dashboard');
        return view('categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        Gate::authorize('manage-dashboard');
        return view('categories.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditCategoryRequest $request, Category $category)
    {
        Gate::authorize('manage-dashboard');
        $category->update($request->validated());
        return to_route('categories.index')->withMessage('Category has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Gate::authorize('manage-dashboard');
        $category->delete();
        return to_route('categories.index')->withMessage('Category has been deleted successfully');
    }
}
