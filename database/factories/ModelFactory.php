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
        'email' => $faker->email,
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

$factory->define(App\Like::class, function (Faker\Generator $faker) {
    $comment = $faker->text(20);
    return [
        'book_id' => $faker->randomNumber(2),
        'user_id' => $faker->randomNumber(3),
        'comment' => $comment,
    ];
});

$factory->define(App\Topic::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'description' => $faker->sentence(20),
        'slug' => str_slug($name),
        'cover_photo' => 'http://books.google.com/books?id=gt7EQgH8-b4C&dq=thin+air&hl=&as_pt=BOOKS&source=gbs_api',
    ];
});

$factory->define(App\Note::class, function (Faker\Generator $faker) {
    return [
        'text' => $faker->realText(100),
        'is_private' => true,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'book_id' => function () {
            return factory(App\Book::class)->create()->id;
        }
    ];
});
