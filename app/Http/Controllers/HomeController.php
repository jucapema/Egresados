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
            return redirect()->route('Publicacion.index');
            }
        if(Auth::User()->tipo_rol=='root'){
          return redirect()->route('Administrador.index');}
        }
      }

      //  return view('home');

}
