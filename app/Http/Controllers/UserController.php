<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Mail\Mensaje;
use App\Models\acceso;
use App\Models\Egresado;
use App\Models\Administrador;
use Carbon\Carbon;
use Mail;
use Session;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function indextrash(){
        $user = User::onlyTrashed()->where('tipo_rol','egresado')->get();
        $cantcance=Egresado::where('baja','true')->get();
        $cantnewuser=User::where('estado_cuenta','suscrita')->get();
        return view('user.IndexTrash',['users'=>$user,'cantnewuser'=>$cantnewuser,'cantcance'=>$cantcance]);
    }

    public function change_password(Request $request){
      if(\Hash::check($request->Password_actual, \Auth::user()->password)){
      //if($request->Password_actual == \Auth::user()->password){
        $user=User::find(\Auth::user()->id);
        $new['password'] =bcrypt($request->password);
        $user->update($new);
          if (\Auth::user()->tipo_rol=='admin' and count(\Auth::user()->acceso)==0) {
              acceso::create(['id_usuario'=>\Auth::user()->id]);
          }
        \Auth::logout();
        session::flash('flash_message','La contraseña ha sido actualizada ');
        return view('auth.login');
      }else{
        session::flash('flash_message','La contraseña no coindide porfavor intente de nuevo');
        return redirect()->back();
      }
    }

    public function ChangePassword(){
      return view('changepassword');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function state(Request $request)  //bannear cuenta
    {
        $user=User::findOrfail($id);
        $user->update(['estado_cuenta'=>'ban']);
        $data2['id_usuario'] =$user->id;
        $data2['tipo'] ='ban';
        $data2['informacion'] = 'sr'."".$user->name.$user->apellido."".'Su cuenta se encuentra suspendida porfavor contatenos.';
        Notificacion::create($data2);
        Session::flash('flash_message','Usuario Banneado');
        $user->delete();
        //$user->logout();
        return redirect()->back();
      }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { //validar q el correo no exista
      $v = \Validator::make($request->all(), [
            'dni'=>'numeric',
            'email'    => 'email', //[A-Z]@[utp.edu.co]
            'telefono'=> 'min:7|numeric',
        ]);
        if ($v->fails())
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }
      $user = User::findOrfail($id);
      if($user->email!=$request->email){
          $emails=User::where('email',$request->email)->get();
          $v = \Validator::make($request->all(), [
                'email'    => 'email|unique:users', //[A-Z]@[utp.edu.co]
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
            Session::flash('flash_message', 'Debes ser mayor de edad');
            return redirect()->back(); //TODO humm
          }
        }
        session::flash('flash_message','Informacion Actualizada ');
        return redirect()->back();
    }

    public function correo(){
      $user = User::find(1);
      Mail::to('dicoma12@yahoo.es','prueba')->send(new Mensaje($user));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
