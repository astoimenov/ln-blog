<?php

namespace LittleNinja\Http\Controllers\Admin;

use LittleNinja\Category;
use LittleNinja\Http\Controllers\Controller;
use LittleNinja\Http\Requests\CategoryRequest;

class CategoriesController extends Controller
{

    public function index()
    {

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
     * @param CategoryRequest $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function restore(Category $category)
    {

    }
}
