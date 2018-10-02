<?php

$factory->define(App\Prueba::class, function (Faker\Generator $faker) {
    return [
        "asignatura_id" => factory('App\Asignatura')->create(),
        "asignaturas_id" => factory('App\Asignatura')->create(),
        "titulo" => $faker->name,
        "descripcion" => $faker->name,
        "activo" => 0,
    ];
});
