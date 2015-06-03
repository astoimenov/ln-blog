<?php

namespace LittleNinja\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Input;
use LittleNinja\Category;
use LittleNinja\Http\Controllers\Controller;
use LittleNinja\Http\Requests\PostRequest;
use LittleNinja\Post;
use LittleNinja\Tag;
use Redirect;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::withTrashed()->orderBy('created_at', 'desc')->whereIsPublished(1)->paginate(15);
        $categories = Category::lists('category_name', 'id');
        $title = 'Публикувани постове';

        return view('admin.news.index', compact('posts', 'categories', 'title'));
    }

    public function awaiting()
    {
        $posts = Post::withTrashed()->orderBy('created_at', 'desc')->whereIsPublished(0)->paginate(15);
        $categories = Category::lists('category_name', 'id');
        $title = 'Чакащи постове';

        return view('admin.news.index', compact('posts', 'categories', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::lists('category_name', 'id');
        $tags = Tag::lists('tag_name', 'tag_name');

        return view('admin.news.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return Response
     */
    public function store(PostRequest $request)
    {
        $categories = $request->input('categories') ? $request->input('categories') : [];
        $params = array_merge($request->all(), [
            'author_id' => Auth::user()->id,
        ]);

        $article = Post::create($params);

        $tags = $request->input('tags') ? $request->input('tags') : [];
        $tagIds = array();
        foreach ($tags as $tag) {
            if ($currentTag = Tag::whereName($tag)->first()) {
                $tagIds[] = $currentTag->id;
            } else {
                $savedTag = Tag::create([
                    'name' => $tag,
                    'slug' => Str::slug($tag)
                ]);
                $tagIds[] = $savedTag->id;
            }
        }

        $article->tags()->attach($tagIds);
        $article->categories()->attach($categories);

        return redirect('admin/news');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        $categories = Category::lists('name', 'id');
        $selectedCategories = $post->categories()->lists('id');

        $tags = Tag::lists('name', 'name');
        $selectedTags = $post->tags()->lists('name');

        return view('admin.news.edit', compact(
            'post',
            'categories',
            'selectedCategories',
            'tags',
            'selectedTags'
        ));
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
        $categories = $request->input('categories') ? $request->input('categories') : [];
        $tags = $request->input('tags') ? $request->input('tags') : [];
        $tagIds = array();
        foreach ($tags as $tag) {
            if ($currentTag = Tag::whereName($tag)->first()) {
                $tagIds[] = $currentTag->id;
            } else {
                $savedTag = Tag::create([
                    'name' => $tag,
                    'slug' => Str::slug($tag)
                ]);
                $tagIds[] = $savedTag->id;
            }
        }

        $post->update($request->all());

        $post->tags()->sync($tagIds);
        $post->categories()->sync($categories);

        return redirect('admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return Redirect::back();
    }

    public function restore(Post $post)
    {
        $post->restore();

        return Redirect::back();
    }

    public function search(Request $request)
    {
        $posts = new Post();

        if ($request->has('category_id')) {
            $posts = $posts::with('categories')->whereHas('categories', function ($q) {
                $q->whereId(Input::get('category_id'));
            });
        }

        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $posts = $posts->where('title', 'LIKE', '%' . $keyword . '%');
        }

        if ($request->has('post_id')) {
            $id = $request->input('post_id');
            $posts = $posts->whereId($id);
        }

        $posts = $posts->withTrashed()->paginate(15);
        $title = 'Търсене';
        $categories = Category::lists('name', 'id');

        return view('admin.news.index', compact('posts', 'title', 'categories'))->withInput(Input::all());
    }
}
