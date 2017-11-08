<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class SuscribirseController extends Controller
{
      
    public function store(Request $request)
    {
      User::create([
         'name' => $request['name'],
         'email' => $request['email'],
         'password' => bcrypt('egresado123456'),
         'apellido' => $request['apellido'],
         'tipo_rol'=>'egresado',
         'estado_cuenta'=>'suscrita',
     ]);
     echo 'aqui estoy';
     //redirect()->view('/welcome');
    }

}
