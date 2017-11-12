<?php

use Illuminate\Database\Seeder;

class rootSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
      'dni' => '1234567',
      'name' 		=> 	'root',
      'email'		=>	'root@utp.edu.co',
        'password'	=>	bcrypt('321654'),
      'tipo_rol'	=>	'root',
      'apellido'	=>	'root',
      'estado_cuenta' => 'activa'
    ]);
    }
}/*
*/
