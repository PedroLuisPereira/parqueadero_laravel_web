<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'numero_documento' => $faker->randomNumber(),
        'nombre' => $faker->firstName(),
        'apellidos' => $faker->lastName(),
    ];
});
