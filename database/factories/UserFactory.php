<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'dni'=> numberBetween($min = 10000, $max = 90000);
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'apellido' => $faker->lastname,
        'estado_cuenta'=> 'activa',
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Models\Egresado::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'id_usuario' => function () {
            return factory(App\User::class)->create(['tipo_rol' => 'egresado'])->id;
        },
        'intereses'=>$faker->text($maxNbChars = 200),
        'fecha_nacimiento' => $faker->date,
        'genero' => 'masulino|femenino',
    ];
});

$factory->define(App\Models\Administrador::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'id_usuario' => function () {
            return factory(App\User::class)->create(['tipo_rol' => 'administrador'])->id;
        },
        'direccion'=> $faker->address,
        'ciudad'=>$faker->city,
        'telfono' => $faker->phoneNumber,
    ];
});
