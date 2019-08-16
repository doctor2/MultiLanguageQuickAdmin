<?php

$factory->define(App\City::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "key" => $faker->name,
        "order" => $faker->randomNumber(2),
        "active" => 1,
    ];
});
