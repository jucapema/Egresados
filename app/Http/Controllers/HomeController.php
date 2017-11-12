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
        if(Auth::User()->tipo_rol=='root'){return view('root.indexroot');}
        if(Auth::User()->tipo_rol=='egresado'){echo 'vista egresado';}
        if(Auth::User()->tipo_rol=='admin'){echo 'vista admin';}
      }
      //  return view('home');
    }
}
