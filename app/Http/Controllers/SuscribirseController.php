<?php

namespace App\Http\Controllers;
use App\User;
use App\Models\Egresado;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Session;
class SuscribirseController extends Controller
{
    public function __construct(){
      $this->middleware('guest');
    }

    public function store(Request $request)
    {
      if(\Hash::check($request->password_confirmation, $request->password)){
      $v = \Validator::make($request->all(), [
            'name' => 'required',
            'dni' => 'required|regex:/^[0-9]*$/i|unique:users',
            'email'    => 'required|regex:/^[-\w.%+]{1,64}@[u][t][p]\.[e][d][u]\.[c][o]$/i|unique:users',
            'fecha_nacimiento' => 'required',
          ],
          $messages = [
              'email.regex' => 'Debes usar el correo institucional',
          ]);
        if ($v->fails())
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
              $edad = Carbon::parse($request['fecha_nacimiento'])->age;
              if($edad>=18){
                $data=$request->all();
                $data['tipo_rol'] = 'egresado';
                $data['estado_cuenta'] = 'suscrita';
                $data['password'] = bcrypt($request['password']);
                $data['confirmation_password'] = bcrypt($request['confirmation_password']);
                $user=User::create($data);
                $data['id_usuario'] = $user->id;
                Egresado::create($data);
                 Auth::logout();
                 Session::flash('flash_message', 'Solicitud en Proceso');
                 return view('auth.login');
              }
              else{
                flash('Debes ser mayor de edad')->error()->important();
                 return view('auth.register');
              }
          }
        }else{
          //Session::flash('flash_message', 'La clave no coincide');
          flash('La clave no coincide')->error()->important();
           return view('auth.register');
        }
  }
}
