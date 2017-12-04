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
        'dni'=> $faker->numberBetween($min = 100000, $max = 900000),
        'name' => $faker->name,
        'email' => $faker->unique()->firstname.'@'.'utp.edu.co',
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
        'intereses'=>function(){ $cargos=array("Deportes","Reuniones","Informacion");return $cargos[rand(0,2)];},
        'fecha_nacimiento' => function(){ return \Carbon\Carbon::createFromDate(1995, 10, 25);},
        'baja'=>'false',
        'contactos'=> function(){return rand(2,6);},
        'favoritos'=> 1,
        'carrera'=> function(){ $carrera=array("Ing Sistemas","Ing Fisica","Ing Electrica","Mecatronica","Lic Español","Lic Lengua Inglesa","Lic Pedagogia Infantil","Adm Ambiental");return $carrera[rand(0,7)];},
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
        'telefono' => $faker->phonenumber,
    ];
});
//egresado con pedido de baja
$factory->defineAs(App\Models\Egresado::class,'baja', function (Faker\Generator $faker) {
        return [
        'id_usuario' => function () {
            return factory(App\User::class)->create(['tipo_rol' => 'egresado','estado_cuenta'=> 'activa'])->id;
        },
        'intereses'=>function(){ $cargos=array("Deportes","Reuniones","Informacion");return $cargos[rand(0,2)];},
        'fecha_nacimiento' => function(){ return \Carbon\Carbon::createFromDate(1995, 10, 25);},
        'baja'=>'true',
        'contactos'=>function(){return rand(2,6);},
        'favoritos'=>0,
        'carrera'=> function(){ $carrera=array("Ing Sistemas","Ing Fisica","Ing Electrica","Mecatronica","Lic Español","Lic Lengua Inglesa","Lic Pedagogia Infantil","Adm Ambiental");return $carrera[rand(0,7)];},
        'genero' => function(){ $cargos=array("Masculino","Femenino");return $cargos[rand(0,1)];},
    ];
});
//egresado suscrito
$factory->defineAs(App\Models\Egresado::class,'suscrita', function (Faker\Generator $faker) {
  return [
  'id_usuario' => function () {
      return factory(App\User::class)->create(['tipo_rol' => 'egresado','estado_cuenta'=> 'suscrita'])->id;
  },
  'intereses'=>function(){ $cargos=array("Deportes","Reuniones","Informacion");return $cargos[rand(0,2)];},
  'fecha_nacimiento' => function(){ return \Carbon\Carbon::createFromDate(1995, 10, 25);},
  'baja'=>'baja',
  'contactos'=>0,
  'favoritos'=>0,
  'carrera'=> function(){ $carrera=array("Ing Sistemas","Ing Fisica","Ing Electrica","Mecatronica","Lic Español","Lic Lengua Inglesa","Lic Pedagogia Infantil","Adm Ambiental");return $carrera[rand(0,7)];},
  'genero' => function(){ $cargos=array("Masculino","Femenino");return $cargos[rand(0,1)];},
];
});
//notificaciones relacionadas a eventos null ,  solo tiene notificaciones para un usuario
$factory->defineAs(App\Models\Notificacion::class, 'post' ,function (Faker\Generator $faker) {
      return [
        'id_usuario' => function(){return '2';
        },
        'tipo'=> 'post',
        'id_tipo'=> function(){return factory(App\Models\Publicacion::class)->create()->id;},
      ];
});
//publicaciones
$factory->define(App\Models\Publicacion::class, function (Faker\Generator $faker) {
    return [
        'id_administrador' => function () {return rand(1,3);
        },
        'titulo'=>  function(){ $cargos=array("Actividad Reciclar","Reunion De Egresados","Reuniones","Actividaddes");return $cargos[rand(0,3)];},
        'cuerpo'=>$faker->word,
        'fecha'=>  function(){ return \Carbon\Carbon::createFromDate(2017, 12, 25);},
    ];
});
//Mensajes faker
$factory->defineAs(App\Models\Notificacion::class, 'mensaje' ,function (Faker\Generator $faker) {
      return [
        'id_usuario' => function(){return '2';
        },
        'tipo'=> 'mensaje',
        'id_tipo'=> function(){return factory(App\Models\Mensaje::class)->create()->id;},
      ];
});
//---------------------mensajes entre 2 users
$factory->define(App\Models\Mensaje::class, function (Faker\Generator $faker) {
    return [
      'id_egresado'=> 1,
        'title' => $faker->title,
        'contenido' => $faker->word,
        'send_id' => 3,
    ];
});
