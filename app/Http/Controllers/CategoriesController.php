<?php

namespace LittleNinja\Http\Controllers;

use LittleNinja\Category;
use LittleNinja\Http\Controllers\Controller;

class CategoriesController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function show(Category $category)
    {
        $categoryPosts = $category->posts()->whereIsPublished(1)->orderBy('created_at', 'desc')->paginate(10);

        return view('categories.show', compact('categoryPosts'));
    }
}
