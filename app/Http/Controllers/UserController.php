<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Mail\Mensaje;
use App\Models\acceso;
use App\Models\Egresado;
use App\Models\Favorito;
use App\Models\Administrador;
use App\Models\Notificacion;
use Carbon\Carbon;
use Mail;
use Session;
use Auth;
class UserController extends Controller
{
  public function __construct(){
    $this->middleware('root',['only'=>['restore','indextrash','correo']]);
    $this->middleware('admin',['only'=>['ChangePassword','destroy']]);
    $this->middleware('egresado',['only'=>['change_password','update','agregar']]);
  }

  public function indextrash(){
    $user = User::onlyTrashed()->get();
    //$cantcance=Egresado::where('baja','true')->get();
    //$cantnewuser=User::where('estado_cuenta','suscrita')->get();
    return view('user.IndexTrash',['users'=>$user]);
  }

  public function restore($id)
  {
    $user = User::withTrashed()->where('id',$id)->first();
    if($user->tipo_rol=='admin'){
      $administrador = Administrador::withTrashed()->where('id_usuario',$user->id)->firstorfail();
      $user->restore();
      $administrador->restore(); //agregar sofdelete
    }
    if($user->tipo_rol=='egresado'){
      $egresado=$egresado::withTrashed()->where('id_usuario',$user->id)->firstorfail();
      $user->restore();
      $egresado->restore();
    }
    flash('Usuario Restaurado')->warning();
    return redirect()->back();
  }

  public function change_password(Request $request){
    if(\Hash::check($request->Password_actual, \Auth::user()->password)){
      //if(\Hash::check($request->password_confirmation, $request->password)){
      //if($request->Password_actual == \Auth::user()->password){
      $user=User::find(\Auth::user()->id);
      $new['password'] =bcrypt($request->password);
      $user->update($new);
      if (Auth::user()->administrador->valor=='false') {
        $administrador=Administrador::findOrfail(Auth::user()->administrador->id);
        $administrador->update(['valor'=>'true']);
        flash('La contraseña ha sido actualizada ')->success();
        return redirect()->route('Publicacion.index');
      }else{
        \Auth::logout();
        //session::flash('flash_message','La contraseña ha sido actualizada ');
        flash('La contraseña ha sido actualizada ')->success();
        return redirect()->back();
      }
      /*else{
      flash('La nueva Contraseña no coincide')->error()->important();
      return redirect()->back();
    }*/
  }else{
    //session::flash('flash_message','La contraseña no coindide porfavor intente de nuevo');
    flash('La contraseña no coindide porfavor intente de nuevo')->error()->important();
    return redirect()->back();
  }
}

public function ChangePassword(){
  return view('administrador.CambiarPassAdmin');
}

public function agregar(Request $request)
{
  $user=User::findOrfail($request->user);
  if($user->estado_cuenta!='activa')
  {
    $user->update(['estado_cuenta'=>'activa']);
    $data2['id_usuario'] =$user->id;
    $data2['tipo'] ='agregado'; //egresado agregado
    $data2['id_tipo'] ='1'; //1 para los agregados, 1 para los banneados
    Notificacion::create($data2);
    //\Session::flash('flash_message','Egresado Aceptado');
    flash('Egresado Aceptado')->success();
    return redirect()->back();
  }else{
    $favorito=Favorito::create(['id_usuario'=>Auth::user()->id,'amigo'=>$user->id]);
    //\Session::flash('flash_message','Contacto añadido');
    flash('Contacto añadido')->success();
    return redirect()->back();
  }
}

public function update(Request $request, $id)
{ //validar q el correo no exista
  $user = User::findOrfail($id);
  if($user==$request->all()){
    flash('Error al intentar actualizar debido a que la Información es igual')->error();
  }
  $v = \Validator::make($request->all(), [
    'dni'=>'numeric',
    'email'    => 'regex:/^[-\w.%+]{1,64}@[u][t][p]\.[e][d][u]\.[c][o]$/i',
    'telefono'=> 'regex:/^[3][0-9]*$/',
  ],
  $messages = [
    'email.regex' => 'Debes usar el correo institucional',
  ]);
  if ($v->fails())
  {
    return redirect()->back()->withInput()->withErrors($v->errors());
  }
  if($user->email!=$request->email){
    $emails=User::where('email',$request->email)->get();
    $v = \Validator::make($request->all(), [
      'email'    => 'regex:/^[-\w.%+]{1,64}@[u][t][p]\.[e][d][u]\.[c][o]$/i|unique:users',
    ]);
    if ($v->fails())
    {
      return redirect()->back()->withInput()->withErrors($v->errors());
    }
  }
  if($user->tipo_rol=="admin"){
    $administrador = Administrador::findOrfail($user->administrador->id);
    $user->update($request->all());
    $administrador->update($request->all());
  }
  else if($user->tipo_rol=="egresado"){
    $edad = Carbon::parse($request['fecha_nacimiento'])->age;
    if($edad>=18){
      $egresado = Egresado::findOrfail($user->egresado->id);
      $user->update($request->all());
      $egresado->update($request->all());
    }else{
      flash('Debes ser mayor de edad')->error();
      return redirect()->back(); //TODO humm
    }
  }
  //session::flash('flash_message','Informacion Actualizada ');
  flash('Informacion Actualizada ')->success();
  return redirect()->back();
}

public function correo(){
  $user = User::find(1);
  Mail::to('@','prueba')->send(new Mensaje($user));
}
/**
* Remove the specified resource from storage.
*
* @param  \App\Models\User  $user
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
  $user=User::findorfail($id);
  if($user->tipo_rol=='admin')
  {
    $administrador=Administrador::findorfail($user->administrador->id);
    $administrador->delete();
  }
  elseif($user->tipo_rol=='egresado')
  {
    $egresado=Egresado::findorfail($user->egresado->id);
    $egresado->delete();
  }
  $user->delete();
  flash('Usuario Eliminado')->error()->important();
  return redirect()->back();
}
}
