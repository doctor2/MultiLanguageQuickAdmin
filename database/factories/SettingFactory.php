<?php

$factory->define(App\Setting::class, function (Faker\Generator $faker) {
    return [
        "key" => $faker->name,
        "order" => $faker->randomNumber(2),
        "description" => $faker->name,
    ];
});
