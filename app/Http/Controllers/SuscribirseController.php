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
            $data=$request->all();
            $data['tipo_rol'] = 'egresado';
            $data['estado_cuenta'] = 'suscrita';
            User::create($data);
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
