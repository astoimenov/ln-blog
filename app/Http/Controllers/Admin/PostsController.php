<?php

namespace LittleNinja\Http\Controllers\Admin;

use Illuminate\Http\Request;
use LittleNinja\Http\Controllers\Controller;
use LittleNinja\Http\Requests\PostRequest;
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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return Response
     */
    public function store(PostRequest $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Post $post
     * @param PostRequest $request
     * @return Response
     */
    public function update(Post $post, PostRequest $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function restore(Post $post)
    {

    }

    public function search(Request $request)
    {

    }
}
