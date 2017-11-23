<?php

namespace App\Http\Controllers;

use App\Models\User;
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
      Auth::User()->name;
      if(Auth::User()->estado_cuenta!='activa'){
        echo 'hola cuenta inactiva';redirect()->route('logout') ;
      }else{
        if(Auth::User()->tipo_rol=='root'){return view('administrador.AdminMain');}
        if(Auth::User()->tipo_rol=='egresado'){return view('egresados.EgresadoMain');}
        if(Auth::User()->tipo_rol=='admin'){return view('administrador.AdminMain');}
      }
      //  return view('home');
    }
}
