<?php

$factory->define(App\Song::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'artist' => $faker->name,
    ];
});