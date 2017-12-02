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
      $this->middleware('guest',['only'=>'store' ]);
    }

    public function store(Request $request)
    {
      $v = \Validator::make($request->all(), [
            'name' => 'required',
            'dni' => 'required|unique:users',
            'email'    => 'required|email|unique:users', //[A-Z]@[utp.edu.co]
            'fecha_nacimiento' => 'required',
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
            Session::flash('flash_message', 'Debes ser mayor de edad');
             return view('auth.login');
          }
      }
  }
}
