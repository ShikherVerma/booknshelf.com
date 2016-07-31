<?php

$factory('App\User', [
    'name' => $faker->name,
    'email' => $faker->email,
    'username' => $faker->userName,
    'password' => bcrypt(str_random(10)),
]);


// $factory('App\Shelf', [
//    'name' => 'Test Shelf',
//    'user_id' =>  'factory:App\User',
//    'description' => $faker->sentence(20),
//    $faker->name
// ]);