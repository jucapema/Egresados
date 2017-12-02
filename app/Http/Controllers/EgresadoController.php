<?php

namespace App\Http\Controllers;

use App\Models\Egresado;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use App\User;

class EgresadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::where('tipo_rol','egresado')->get();
      $cantnewuser=User::where('estado_cuenta','suscrita')->get();
      $cantcance=Egresado::where('baja','true')->get();
      return view('user.indexEgresado',['users'=>$users, 'cantnewuser'=>$cantnewuser,'cantcance'=>$cantcance]);
    }

    public function indexsuscrita()
    {
      $users = User::where('estado_cuenta','suscrita')->get();
      $cantcance=Egresado::where('baja','true')->get();
      return view('user.indexSuscrita',['users'=>$users, 'cantnewuser'=>$users,'cantcance'=>$cantcance]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('CreateEgresado');
    }

    public function cancelar()
    {
      $cantcance=Egresado::where('baja','true')->get();
      $cantnewuser=User::where('estado_cuenta','suscrita')->get();
      return view('user.indexEgresadoCancel',['egresados'=>$cantcance, 'cantnewuser'=>$cantnewuser,'cantcance'=>$cantcance]);
    }

    public function darsedebaja(Request $request){
        $egresado=Egresado::findOrFail(Auth::user()->egresado->id);
        var_dump($egresado);
        var_dump($egresado->user->name);
        if($egresado->user->tipo_rol=='egresado'){
          $egresado->update(["baja"=>"true"]);
var_dump($egresado->baja);
          session::flash('flash_message','peticion recibida');
          //Auth::logout();
          //return view('auth.login');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $v = \Validator::make($request->all(),[
        'dni'=>'required|unique:users|numeric',
        'email'=>'required|email|unique:users',
      ]);
      if($v->fails()){
        return redirect()->back()->withInput()->withErrors($v->errors());
      }
    else{
      $edad = Carbon::parse($request['fecha_nacimiento'])->age;
      if($edad>=18){
          $data = $request->all();
          $data['tipo_rol'] = 'egresado';
          $data['estado_cuenta'] = 'activa';
          $user = User::create($data);
          $data['id_usuario']=$user->id;
          Egresado::create($data);
          Session::flash('flash_message', 'Registro Exitoso');
          return redirect()->route('Egresado.index');
        }
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Egresado  $egresado
     * @return \Illuminate\Http\Response
     */
    public function show(Egresado $egresado)
    {
        //
    }

public function contactos(){
      $users = User::where('tipo_rol','egresado')->where('estado_cuenta','activa')->get();
      
      return view('egresados.ListEgresados',['users'=>$users]);
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Egresado  $egresado
     * @return \Illuminate\Http\Response
     */
    public function edit(Egresado $egresado)
    {
        return view('egresados.EditEgresado',['egresado'=>$egresado->id_usuario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Egresado  $egresado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Egresado $egresado)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Egresado  $egresado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Egresado $egresado)
    {
      $user=User::findOrfail($egresado->id_usuario);
      $user->delete();
      $egresado->delete();
      Session::flash('deleted', 'Usuario Eliminado');
      return redirect()->route('Egresado.index',['deleted'=>$user->id]); //TODO this is for restore
    }
}
