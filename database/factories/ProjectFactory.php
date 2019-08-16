<?php

$factory->define(App\Project::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "additional" => $faker->name,
        "year" => $faker->randomNumber(2),
        "order" => $faker->randomNumber(2),
        "active" => 1,
        "city_id" => factory('App\City')->create(),
    ];
});
