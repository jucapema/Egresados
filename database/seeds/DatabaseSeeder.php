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
        // $this->call(UsersTableSeeder::class);
    //   $this->call(rootSeed::class);
        factory(App\Models\Egresado::class,50)->create();
        factory(App\Models\Administrador::class,50)->create();
    }
}
