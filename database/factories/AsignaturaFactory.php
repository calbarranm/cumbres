<?php

$factory->define(App\Asignatura::class, function (Faker\Generator $faker) {
    return [
        "nombre" => $faker->name,
        "slug" => $faker->name,
        "descripcion" => $faker->name,
        "fecha_inicio" => $faker->date("d-m-Y H:i:s", $max = 'now'),
        "activo" => 0,
    ];
});
