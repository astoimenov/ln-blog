<?php

namespace LittleNinja\Http\Controllers\Admin;

use LittleNinja\Comment;
use LittleNinja\Http\Controllers\Controller;
use Redirect;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $comments = Comment::withTrashed()->paginate(15);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return Redirect::back();
    }

    public function restore($id)
    {
        $comment = Comment::withTrashed()->find($id);
        $comment->restore();

        return Redirect::back();
    }
}
