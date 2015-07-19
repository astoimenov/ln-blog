<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'as' => 'home',
    'uses' => 'PostsController@index'
]);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('posts/search', [
    'as' => 'posts.search',
    'uses' => 'PostsController@search'
]);

Route::resource('posts', 'PostsController', [
    'only' => ['show']
]);

Route::resource('categories', 'CategoriesController', [
    'only' => ['show']
]);

Route::resource('comments', 'CommentsController', [
    'only' => ['store']
]);

Route::resource('tags', 'TagsController', [
    'only' => ['show']
]);

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth'
], function () {

    Route::get('posts/awaiting', [
        'as' => 'admin.awaiting_posts.index',
        'uses' => 'Admin\PostsController@posts'
    ]);

    Route::get('posts/{posts}/restore', [
        'as' => 'admin.posts.restore',
        'uses' => 'Admin\PostsController@restore'
    ]);

    Route::get('posts/search', [
        'as' => 'admin.posts.search',
        'uses' => 'Admin\PostsController@search'
    ]);

    Route::resource('posts', 'Admin\PostsController', [
        'except' => ['show']
    ]);

    Route::get('categories/{categories}/restore', [
        'as' => 'admin.categories.restore',
        'uses' => 'Admin\CategoriesController@restore'
    ]);

    Route::resource('categories', 'Admin\CategoriesController', [
        'except' => ['create', 'edit']
    ]);

    Route::get('comments/{comments}/restore', [
        'as' => 'admin.comments.restore',
        'uses' => 'Admin\CommentsController@restore'
    ]);

    Route::resource('comments', 'Admin\CommentsController', [
        'only' => ['index', 'destroy']
    ]);

});
