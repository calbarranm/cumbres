<?php

$factory->define(App\Pregunta::class, function (Faker\Generator $faker) {
    return [
        "pregunta" => $faker->name,
        "puntos" => $faker->randomNumber(2),
    ];
});
