<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Egresado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Mail;
use Session;

class AdminController extends Controller
{
  public function __construct(){
    $this->middleware('root',['only'=>['index','store']]);
    $this->middleware('admin',['only'=>'borrarcuenta']);
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $users = User::where('tipo_rol','admin')->get();
    return view('user.IndexAdmin',['users'=>$users]);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('administrador.CreateAdmin');
  }
  //TODO: this is for me only for me
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
      'telefono'=> 'required|regex:/^[3][0-9]*$/',
    ],
    $messages = [
        'email.regex' => 'Debes usar el correo institucional',
    ]);
    if($v->fails()){
      return redirect()->back()->withInput()->withErrors($v->errors());
    }else{
      $data = $request->all();
      $data['tipo_rol'] = 'admin';
      $data['password'] = bcrypt('secret');//Hash::make(rand(0,8));
      $data['confirmation_password'] = bcrypt($data['password']);
      $data['estado_cuenta'] = 'activa';
      $Usuario= User::create($data);
      $data['id_usuario'] = $Usuario->id;
      $data['valor'] = 'false';
      $Administrador = Administrador::create($data);
    //  Mail::raw('$Usuario->email', function ($message) {   //funcion para enviar al correo del empleado la clave, por ahora crea un log
      //echo 'welcome tu contraseña es $data[password]';
    //  });
      flash()->overlay('Registro Exitoso','Registro usuario');
      return redirect()->route('Administrador.index');
    }
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Administrador  $administrador
  * @return \Illuminate\Http\Response
  */


    public function borrarcuenta(Request $request){
      $user=User::findOrfail($request->user);
      $egresado=Egresado::findOrfail($user->egresado->id);
      $egresado->delete();
      $user->delete();
      //envio emails
      //Session::flash('flash_message', 'Usuario dado de baja');
      flash('Usuario dado de baja')->success();
      return redirect()->back();
    }
}
