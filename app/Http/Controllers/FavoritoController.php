<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use Illuminate\Http\Request;
use App\User;
use Session;
use Auth;

class FavoritoController extends Controller
{

  public function __construct(){
    $this->middleware('egresado');
  }

    public function index(){
      $favoritos=Favorito::where('id_usuario',Auth::user()->id)->get();
      $user=User::where('id',$favoritos->amigo)->get();
      //var_dump($user);
    }

    public function eliminaramigo(Request $request){
        $favoritos=Favorito::where('id_usuario',Auth::user()->id)->where('amigo',$request->user);
      $favoritos->delete();
      flash('Contacto eliminado')->warning();
      return redirect()->back();
    }
}
