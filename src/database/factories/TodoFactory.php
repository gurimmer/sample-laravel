<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CompleteTodo;
use App\Models\Todo;
use Faker\Generator as Faker;

$factory->define(Todo::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->sentence(5),
    ];
});

$factory->define(CompleteTodo::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->sentence(5),
    ];
});
