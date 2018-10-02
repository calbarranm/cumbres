<?php

$factory->define(App\Unidade::class, function (Faker\Generator $faker) {
    return [
        "unidad_id" => factory('App\Asignatura')->create(),
        "nombre" => $faker->name,
        "slug" => $faker->name,
        "texto_corto" => $faker->name,
        "texto_largo" => $faker->name,
        "posicion" => $faker->randomNumber(2),
        "activo" => 0,
    ];
});
