<?php

namespace LittleNinja\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use LittleNinja\Category;
use LittleNinja\Post;
use LittleNinja\Tag;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'LittleNinja\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        $router->bind('categories', function ($slug) {
            return Category::withTrashed()->whereSlug($slug)->first();
        });

        $router->bind('news', function ($slug) {
            return Post::withTrashed()->whereSlug($slug)->first();
        });

        $router->bind('tags', function ($slug) {
            return Tag::withTrashed()->whereSlug($slug)->first();
        });

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->loadRoutesFrom(app_path('Http/routes.php'));
    }
}
