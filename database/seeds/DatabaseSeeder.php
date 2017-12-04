<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(UsersTableSeeder::class);
         $this->call(rootSeed::class);
        factory(App\Models\Egresado::class,20)->create();
        factory(App\Models\Administrador::class,5)->create();
        factory(App\Models\Notificacion::class,'post',10)->create();
        factory(App\Models\Notificacion::class,'mensaje',5)->create();
        factory(App\Models\Egresado::class,'baja',5)->create();
        factory(App\Models\Egresado::class,'suscrita',5)->create();

    }
}
