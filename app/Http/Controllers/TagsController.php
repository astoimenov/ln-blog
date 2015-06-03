<?php

namespace LittleNinja\Http\Controllers;

use LittleNinja\Http\Controllers\Controller;
use LittleNinja\Tag;

class TagsController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return Response
     */
    public function show(Tag $tag)
    {
        $title = 'Таг: ' . $tag->name;
        $posts = $tag->posts()->paginate(10);

        return view('tags.show', compact('title', 'posts'));
    }
}
