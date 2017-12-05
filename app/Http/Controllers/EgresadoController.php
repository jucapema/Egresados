<?php

namespace App\Http\Controllers;

use App\Models\Egresado;
use App\Models\Mensaje;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use App\User;

class EgresadoController extends Controller
{
    public function __construct(){
      $this->middleware('admin',['only'=>['index','indexsuscrita','cancelar','cambiarvalor']]);
      $this->middleware('egresado',['only'=>['darsedebaja','contactos']]);
    }
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
      return view('user.IndexEgresado',['users'=>$users, 'cantnewuser'=>$cantnewuser,'cantcance'=>$cantcance]);
    }

    public function indexsuscrita()
    {
      $users = User::where('estado_cuenta','suscrita')->get();
      $cantcance=Egresado::where('baja','true')->get();
      return view('user.IndexSuscrita',['users'=>$users, 'cantnewuser'=>$users,'cantcance'=>$cantcance]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function cancelar()
    {
      $cantcance=Egresado::where('baja','true')->get();
      $cantnewuser=User::where('estado_cuenta','suscrita')->get();
      return view('user.IndexEgresadoCancel',['egresados'=>$cantcance, 'cantnewuser'=>$cantnewuser,'cantcance'=>$cantcance]);
    }

    public function darsedebaja(Request $request){
        $egresado=Egresado::findOrFail($request->user);
        if($egresado->user->tipo_rol=='egresado'){

          $egresado->update(['baja'=>'true']);

          session::flash('flash_message','peticion recibida');
          Auth::logout();
          return view('auth.login');
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
        'email'=>'required|regex:/^[-\w.%+]{1,64}@[u][t][p]\.[e][d][u]\.[c][o]$/i|unique:users',
      ],
      $messages = [
          'email.regex' => 'Debes usar el correo institucional',
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
          //Session::flash('flash_message', 'Registro Exitoso');
          flash('Registro Exitoso')->success();
          return redirect()->route('Egresado.index');
        }
      }
    }


      public function contactos(){
            $users = User::where('tipo_rol','egresado')->where('estado_cuenta','activa')->where('id','!=',Auth::user()->id)->get();
            $mensajes=Mensaje::mensajesid(Auth::user()->egresado->id)->get();
            return view('egresados.ListEgresados',['users'=>$users,'mensajes'=>$mensajes]);
      }


    public function cambiarvalor(Request $request)  //bannear cuenta
    {
        $user=User::findOrfail($request->user);
        if($user->estado_cuenta=='activa')
        {
          //var_dump($user);
          $user->update(['estado_cuenta'=>'ban']);
          $data2['id_usuario'] =$user->id;
          $data2['tipo'] ='ban'; //egresado agregado
          $data2['id_tipo'] ='1'; //1 para los agregados, 1 para los banneados
          \Notificacion::create($data2);
          //\Session::flash('flash_message','Cuenta Banneada');
          flash('Cuenta banneada')->important();
          return redirect()->back();
        }else{
          //\Session::flash('flash_message','Egresado ya banneado');
          flash('Egresado ya banneado')->warning();
          return redirect()->back();
        }
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
