<?php

namespace LittleNinja\Http\Controllers\Admin;

use Illuminate\Support\Str;
use LittleNinja\Category;
use LittleNinja\Http\Controllers\Controller;
use LittleNinja\Http\Requests\CategoryRequest;
use Redirect;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::withTrashed()->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        $slug = Str::slug($request->input('category_name'));
        Category::create(array_merge($request->all(), [
            'category_slug' => $slug
        ]));

        return redirect('admin/categories');
    }

    public function show(Category $category)
    {
        return $category->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Category $category
     * @param CategoryRequest $request
     * @return Response
     */
    public function update(Category $category, CategoryRequest $request)
    {
        $slug = Str::slug($request->input('category_name'));
        $category->update(array_merge($request->all(), [
            'category_slug' => $slug
        ]));

        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return Redirect::back();
    }

    public function restore(Category $category)
    {
        $category->restore();

        return Redirect::back();
    }
}
