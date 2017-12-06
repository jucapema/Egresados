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
        factory(App\Models\Egresado::class,'hombre',15)->create();
        factory(App\Models\Egresado::class,'mujer',15)->create();
        factory(App\Models\Administrador::class,5)->create();
        factory(App\Models\Notificacion::class,'post',10)->create();
        factory(App\Models\Notificacion::class,'mensaje',5)->create();
        factory(App\Models\Egresado::class,'bajaM',5)->create();
        factory(App\Models\Egresado::class,'bajaF',5)->create();
        factory(App\Models\Egresado::class,'suscritam',5)->create();
        factory(App\Models\Egresado::class,'suscritaf',5)->create();
    }
}
