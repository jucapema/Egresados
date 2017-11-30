<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Egresado;
use App\Models\acceso;
use Auth;
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
        \session::flash('flash_message','Tu cuenta no esta activa');redirect()->route('logout');
      }else{
        if(Auth::User()->tipo_rol=='egresado'){
            $Egresado=Egresado::where('id_usuario',Auth::User()->id)->get();
            return view('egresados.EgresadoMain',['egresado'=>$Egresado]);
          }
        elseif(Auth::User()->tipo_rol=='admin'){
              $user=User::where('estado_cuenta','suscrita')->get();
              return view('administrador.AdminMain',['user'=>$user]);}
        if(Auth::User()->tipo_rol=='root'){
          //return view('pruebaarchivo');}
          //return view('manejo');}
          return view('root.RootMain');}
        }
      }

      //  return view('home');

}
