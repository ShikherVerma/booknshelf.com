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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'password' => bcrypt(str_random(10)),
    ];
});

$factory->define(App\Shelf::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'description' => $faker->sentence(20),
        'slug' => str_slug($name),
        'cover' => 'http://books.google.com/books?id=gt7EQgH8-b4C&dq=thin+air&hl=&as_pt=BOOKS&source=gbs_api',
    ];
});

$factory->define(App\Book::class, function (Faker\Generator $faker) {
    $title = $faker->name;
    return [
        'title' => $title,
        'google_volume_id' => $faker->uuid,
    ];
});