<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define('LittleNinja\User', function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define('LittleNinja\Post', function ($faker) {
    return [
        'post_title' => $faker->catchPhrase,
        'post_slug' => $faker->slug,
        'post_content' => $faker->realText,
        'is_published' => true,
        'author_id' => rand(1, 10)
    ];
});
