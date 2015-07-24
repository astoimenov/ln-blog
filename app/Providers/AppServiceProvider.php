<?php

namespace LittleNinja\Providers;

use AlgoliaSearch\Client;
use Illuminate\Support\ServiceProvider;
use LittleNinja\Contracts\Search;
use LittleNinja\Services\AlgoliaSearch;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Search::class, function () {
            $config = config('services.algolia');
             return new AlgoliaSearch(
                 new Client($config['app_id'], $config['api_key'])
             );
        });
    }
}
