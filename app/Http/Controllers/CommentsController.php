<?php

namespace LittleNinja\Http\Controllers;

use LittleNinja\Comment;
use LittleNinja\Http\Controllers\Controller;
use LittleNinja\Http\Requests\CommentRequest;
use Redirect;

class CommentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     * @return Response
     */
    public function store(CommentRequest $request)
    {
        Comment::create($request->all());

        return Redirect::back();
    }
}
