var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    elixir.config.sourcemaps = false;
    //mix.sass('style.scss', 'resources/assets/css');
    mix.styles([
        'material.css',
        'tt.css',
        'styles.css'
    ]);

    mix.scripts([
        'jquery.min.js',
        //'bootstrap.min.js',
        'main.js'
    ]);
});
