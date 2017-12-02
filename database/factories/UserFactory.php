<?php

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
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'dni'=> $faker->numberBetween($min = 10000, $max = 90000),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'apellido' => $faker->lastname,
        //'estado_cuenta'=> 'activa',
        'remember_token' => str_random(10),
    ];
});

//egresado completo
$factory->define(App\Models\Egresado::class, function (Faker\Generator $faker) {
    return [
        'id_usuario' => function () {
            return factory(App\User::class)->create(['tipo_rol' => 'egresado','estado_cuenta'=> 'activa'])->id;
        },
        'intereses'=>'deportes',
        'fecha_nacimiento' => $faker->date,
        'baja'=>'false',
        'genero' => function(){ $cargos=array("Masculino","Femenino");return $cargos[rand(0,1)];},
    ];
});
//administrador completo
$factory->define(App\Models\Administrador::class, function (Faker\Generator $faker) {
    return [
        'id_usuario' => function () {
            return factory(App\User::class)->create(['tipo_rol' => 'admin','estado_cuenta'=> 'activa'])->id;
        },
        'direccion'=> $faker->address,
        'ciudad'=>$faker->city,
        'valor'=>'false',
        'telefono' => $faker->phoneNumber,
    ];
});
//egresado con pedido de baja
$factory->defineAs(App\Models\Egresado::class,'baja', function (Faker\Generator $faker) {
        return [
        'id_usuario' => function () {
            return factory(App\User::class)->create(['tipo_rol' => 'egresado','estado_cuenta'=> 'activa'])->id;
        },
        'intereses'=>'deportes',
        'fecha_nacimiento' => $faker->date,
        'baja'=>'true',
        'genero' => function(){ $cargos=array("Masculino","Femenino");return $cargos[rand(0,1)];},
    ];
});
//egresado suscrito
$factory->defineAs(App\Models\Egresado::class,'suscrita', function (Faker\Generator $faker) {
  return [
  'id_usuario' => function () {
      return factory(App\User::class)->create(['tipo_rol' => 'egresado','estado_cuenta'=> 'suscrita'])->id;
  },
  'intereses'=>'deportes',
  'fecha_nacimiento' => $faker->date,
  'baja'=>'baja',
  'genero' => function(){ $cargos=array("Masculino","Femenino");return $cargos[rand(0,1)];},
];
});
//notificaciones relacionadas a eventos null ,  solo tiene notificaciones para un usuario
$factory->define(App\Models\Notificacion::class, function (Faker\Generator $faker) {
      return [
        'id_usuario' => function(){return '2';
        },
        'tipo'=> 'post',
        'informacion'=>'no importa',
      ];
});
//publicaciones
$factory->define(App\Models\Publicacion::class, function (Faker\Generator $faker) {
    return [
        'id_administrador' => function () {
          factory(App\Models\Notificacion::class)->create();
          return rand(1,3);
        },
        'titulo'=> $faker->title,
        'cuerpo'=>$faker->text,
        'fecha'=>$faker->date,
    ];
});
