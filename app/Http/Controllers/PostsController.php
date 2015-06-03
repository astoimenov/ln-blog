<?php

namespace LittleNinja\Http\Controllers;

use Illuminate\Http\Request;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        //
    }

    public function search(Request $request)
    {

    }
}
