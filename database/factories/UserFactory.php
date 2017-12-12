<?php
 //$faker = Faker\Factory::create('es_ES');
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
$factory->defineAs(App\User::class,'woman' ,function (Faker\Generator $faker) {
    static $password;
    return [
        'dni'=> $faker->numberBetween($min = 1000000, $max = 9000000),
        'name' => $faker->firstNameFemale      ,
        'email' => $faker->unique()->firstNameFemale.'@'.'utp.edu.co',
        'password' => $password ?: $password = bcrypt('secret'),
        'apellido' => $faker->lastname,
        //'estado_cuenta'=> 'activa',
        'remember_token' => str_random(10),
    ];
});
////////////////////////////////////////////////////////male
$factory->defineAs(App\User::class,'man' ,function (Faker\Generator $faker) {
    static $password;
    return [
        'dni'=> $faker->numberBetween($min = 1000000, $max = 9000000),
        'name' => $faker->firstNameMale,
        'email' => $faker->unique()->firstNameMale.'@'.'utp.edu.co',
        'password' => $password ?: $password = bcrypt('secret'),
        'apellido' => $faker->lastname,
        //'estado_cuenta'=> 'activa',
        'remember_token' => str_random(10),
    ];
});
//egresado completo woman
$factory->defineAs(App\Models\Egresado::class,'mujer', function (Faker\Generator $faker) {
    return [
        'id_usuario' => function () {
            return factory(App\User::class,'woman')->create(['tipo_rol' => 'egresado','estado_cuenta'=> 'activa'])->id;
        },
        'intereses'=> function(){ $cargos=array("Deportes","Reuniones","Informacion");return $cargos[rand(0,2)];},
        'fecha_nacimiento' => function(){ return \Carbon\Carbon::createFromDate(rand(1990,1998), rand(1,12), rand(1,30));},
        'baja'=>'false',
        'carrera'=> function(){ $carrera=array("Ing Sistemas","Ing Fisica","Ing Electrica","Mecatronica","Lic Español","Lic Lengua Inglesa","Lic Pedagogia Infantil","Adm Ambiental");return $carrera[rand(0,7)];},
        'genero' => function(){ $cargos=array("Masculino","Femenino");return $cargos[rand(0,1)];},
    ];
});
//egresado completo woman
$factory->defineAs(App\Models\Egresado::class,'hombre' ,function (Faker\Generator $faker) {
    return [
        'id_usuario' => function () {
            return factory(App\User::class,'man')->create(['tipo_rol' => 'egresado','estado_cuenta'=> 'activa'])->id;
        },
        'intereses'=>function(){ $cargos=array("Deportes","Reuniones","Informacion");return $cargos[rand(0,2)];},
        'fecha_nacimiento' => function(){ return \Carbon\Carbon::createFromDate(rand(1990,1998), rand(1,12), rand(1,30));},
        'baja'=>'false',
        'carrera'=> function(){ $carrera=array("Ing Sistemas","Ing Fisica","Ing Electrica","Mecatronica","Lic Español","Lic Lengua Inglesa","Lic Pedagogia Infantil","Adm Ambiental");return $carrera[rand(0,7)];},
        'genero' => function(){ $cargos=array("Masculino","Femenino");return $cargos[rand(0,1)];},
    ];
});
//administrador completo
$factory->define(App\Models\Administrador::class, function (Faker\Generator $faker) {
    return [
        'id_usuario' => function () {
            return factory(App\User::class,'man')->create(['tipo_rol' => 'admin','estado_cuenta'=> 'activa'])->id;
        },
        'direccion'=> $faker->address,
        'ciudad'=>$faker->city,
        'valor'=>'false',
        'telefono' => $faker->phonenumber,
    ];
});
//egresado con pedido de baja mujer
$factory->defineAs(App\Models\Egresado::class,'bajaF', function (Faker\Generator $faker) {
        return [
        'id_usuario' => function () {
            return factory(App\User::class,'woman')->create(['tipo_rol' => 'egresado','estado_cuenta'=> 'activa'])->id;
        },
        'intereses'=>function(){ $cargos=array("Deportes","Reuniones","Informacion");return $cargos[rand(0,2)];},
        'fecha_nacimiento' => function(){ return \Carbon\Carbon::createFromDate(rand(1990,1998), rand(1,12), rand(1,30));},
        'baja'=>'true',
        'carrera'=> function(){ $carrera=array("Ing Sistemas","Ing Fisica","Ing Electrica","Mecatronica","Lic Español","Lic Lengua Inglesa","Lic Pedagogia Infantil","Adm Ambiental");return $carrera[rand(0,7)];},
        'genero' => function(){ $cargos=array("Masculino","Femenino");return $cargos[rand(0,1)];},
    ];
});
///////////////egresado hombre
$factory->defineAs(App\Models\Egresado::class,'bajaM', function (Faker\Generator $faker) {
        return [
        'id_usuario' => function () {
            return factory(App\User::class,'man')->create(['tipo_rol' => 'egresado','estado_cuenta'=> 'activa'])->id;
        },
        'intereses'=>function(){ $cargos=array("Deportes","Reuniones","Informacion");return $cargos[rand(0,2)];},
        'fecha_nacimiento' => function(){ return \Carbon\Carbon::createFromDate(rand(1990,1998), rand(1,12), rand(1,30));},
        'baja'=>'true',
        'carrera'=> function(){ $carrera=array("Ing Sistemas","Ing Fisica","Ing Electrica","Mecatronica","Lic Español","Lic Lengua Inglesa","Lic Pedagogia Infantil","Adm Ambiental");return $carrera[rand(0,7)];},
        'genero' => function(){ $cargos=array("Masculino","Femenino");return $cargos[rand(0,1)];},
    ];
});

//egresado suscrito man
$factory->defineAs(App\Models\Egresado::class,'suscritam', function (Faker\Generator $faker) {
  return [
  'id_usuario' => function () {
      return factory(App\User::class,'man')->create(['tipo_rol' => 'egresado','estado_cuenta'=> 'suscrita'])->id;
  },
  'intereses'=>function(){ $cargos=array("Deportes","Reuniones","Informacion");return $cargos[rand(0,2)];},
  'fecha_nacimiento' => function(){ return \Carbon\Carbon::createFromDate(1995, 10, 25);},
  'baja'=>'baja',
  'carrera'=> function(){ $carrera=array("Ing Sistemas","Ing Fisica","Ing Electrica","Mecatronica","Lic Español","Lic Lengua Inglesa","Lic Pedagogia Infantil","Adm Ambiental");return $carrera[rand(0,7)];},
  'genero' => function(){ $cargos=array("Masculino","Femenino");return $cargos[rand(0,1)];},
];
});
//egresado suscrito femal
$factory->defineAs(App\Models\Egresado::class,'suscritaf', function (Faker\Generator $faker) {
  return [
  'id_usuario' => function () {
      return factory(App\User::class,'woman')->create(['tipo_rol' => 'egresado','estado_cuenta'=> 'suscrita'])->id;
  },
  'intereses'=>function(){ $cargos=array("Deportes","Reuniones","Informacion");return $cargos[rand(0,2)];},
  'fecha_nacimiento' => function(){ return \Carbon\Carbon::createFromDate(1995, 10, 25);},
  'baja'=>'baja',
  'carrera'=> function(){ $carrera=array("Ing Sistemas","Ing Fisica","Ing Electrica","Mecatronica","Lic Español","Lic Lengua Inglesa","Lic Pedagogia Infantil","Adm Ambiental");return $carrera[rand(0,7)];},
  'genero' => function(){ $cargos=array("Masculino","Femenino");return $cargos[rand(0,1)];},
];
});
//notificaciones relacionadas a eventos null ,  solo tiene notificaciones para un usuario
$factory->defineAs(App\Models\Notificacion::class, 'post' ,function (Faker\Generator $faker) {
      return [
        'id_usuario' => function(){return '2';},
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
        'cuerpo'=> function(){ $cargos=array("Reunion de egresados para .... en .... gracias por la atencion" ,"Reunion de egresados en la julita gracias por la atencion ","Reunion de egresados  en gracias por la atencion","Actividaddes pedagocias","Alumbrado UTP");return $cargos[rand(0,4)];},
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
