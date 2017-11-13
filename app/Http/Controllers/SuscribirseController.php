<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Session;
class SuscribirseController extends Controller
{

    public function store(Request $request)
    {
      $v = \Validator::make($request->all(), [
            'name' => 'required',
            'dni' => 'required|unique:users',
            'email'    => 'required|email|unique:users',
        ]);
        if ($v->fails())
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
          $edad = Carbon::parse($request['fecha_nacimiento'])->age;
          if($edad>=18){
            User::create([
               'name' => $request['name'],
               'dni' => $request['dni'],
               'email' => $request['email'],
               'apellido' => $request['apellido'],
               'password' => $request['password'],
               'password_confirmation' => $request['password_confirmation'],
               'tipo_rol'=>'egresado',
               'estado_cuenta'=>'suscrita',
             ]);
             Auth::logout();
             Session::flash('flash_message', 'Solicitud en Proceso');
             return view('auth.login');
          }
          else{
            Session::flash('flash_message', 'Debes ser mayor de edad');
             return view('auth.login');
          }
      }
  }
}
