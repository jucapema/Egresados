<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Egresado;
use App\Models\acceso;
use Auth;
use Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::User()->estado_cuenta!='activa'){
        session::flash('flash_message','Tu cuenta no esta activa');
        Auth::logout();
        //return redirect()->route('logout');
        return redirect()->back();
      }else{
        if(Auth::User()->tipo_rol=='egresado'){
            return redirect()->route('posts');
          }
        elseif(Auth::User()->tipo_rol=='admin'){
            if (Auth::User()->administrador->valor=='false') {
                return redirect()->route('ChangePassword');
            }else{
              return redirect()->route('Publicacion.index');
              }
            }
        if(Auth::User()->tipo_rol=='root'){
          $acceso=acceso::where('id_usuario',Auth::user()->id)->get();
          if(count($acceso)==0){
            $users=User::where('estado_cuenta','activa')
                      ->where('tipo_rol','egresado')
                      ->where('id','!=','2')->get();
           $publicaciones=Publicacion::all();
           foreach ($publicaciones as $publicacion) {
              foreach ($users as $user) {
                           $data2['id_usuario'] =$user->id;
                           $data2['tipo'] ='post';
                           $data2['id_tipo'] =$publicacion->id;
                           Notificacion::create($data2);
                  }
              }
          }
          return redirect()->route('Administrador.index');
        }
        }
      }
      //  return view('home');

}
