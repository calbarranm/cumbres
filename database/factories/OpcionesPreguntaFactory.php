<?php

$factory->define(App\OpcionesPregunta::class, function (Faker\Generator $faker) {
    return [
        "pregunta_id" => factory('App\Pregunta')->create(),
        "texto_opcion" => $faker->name,
        "correcto" => 0,
    ];
});
