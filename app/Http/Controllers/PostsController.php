<?php

namespace LittleNinja\Http\Controllers;

use Illuminate\Http\Request;
use LittleNinja\Category;
use LittleNinja\Http\Controllers\Controller;
use LittleNinja\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::whereIsPublished(1)->orderBy('created_at', 'desc')->paginate(5);
        $title = '';

        return view('posts.index', compact('posts', 'title'));
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @param Post $post
     * @return Response
     */
    public function show(Category $category, Post $post)
    {
        return view('posts.show', compact('category', 'post'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');
        $posts = Post::where(function ($q) use ($keyword) {

            $q->whereRaw("MATCH(post_title, post_content) AGAINST(? IN BOOLEAN MODE)", array($keyword));

        })->paginate(15);

        $title = 'Търсене';

        return view('posts.index', compact('posts', 'title'))->withInput($request->all());
    }
}
