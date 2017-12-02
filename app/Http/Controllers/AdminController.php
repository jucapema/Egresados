<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Mail;
use Session;

class AdminController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $users = User::where('tipo_rol','admin')->get();
    return view('user.indexAdmin',['users'=>$users]);
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
      'email'=>'required|email|unique:users',
      'telefono'=> 'required|min:7|numeric',
    ]);
    if($v->fails()){
      return redirect()->back()->withInput()->withErrors($v->errors());
    }else{
      $data = $request->all();
      $data['tipo_rol'] = 'admin';
      $data['password'] = Hash::make(rand(0,8));
      $data['confirmation_password'] = Hash::make($data['password']);
      $data['estado_cuenta'] = 'activa';
      $Usuario= User::create($data);
      $data['id_usuario'] = $Usuario->id;
      $Administrador = Administrador::create($data);
    //  Mail::raw('$Usuario->email', function ($message) {   //funcion para enviar al correo del empleado la clave, por ahora crea un log
      //echo 'welcome tu contraseña es $data[password]';
    //  });
      Session::flash('flash_message', 'Registro Exitoso');
      return redirect()->route('Administrador.index');
    }
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Administrador  $administrador
  * @return \Illuminate\Http\Response
  */
  public function show(Administrador $administrador)
  {
      return redirect()->route('usuario.show',['usuario'=>$administrador->id_usuario]);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Administrador  $administrador
  * @return \Illuminate\Http\Response
  */
  public function edit(Administrador $administrador)
  {
    $user=User::findOrfail($administrador->id_usuario);
    return view('administrador.EditAdmin',['administrador'=>$administrador,'user'=>$user]);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Administrador  $administrador
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {

  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Administrador  $administrador
  * @return \Illuminate\Http\Response
  */
  public function destroy(Administrador $administrador)
  {
    $user=User::findOrfail($administrador->id);
    $administrador->delete();$user->delete();
    Session::flash('deleted', 'Usuario Eliminado');
    return redirect()->route('Administrador.index',['deleted'=>$user->id]); //TODO this is for restore
  }
}
