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
        $posts = $category->posts()->whereIsPublished(1)->orderBy('created_at', 'desc')->paginate(10);
        $title = '';

        return view('posts.index', compact('posts', 'title'));
    }
}
