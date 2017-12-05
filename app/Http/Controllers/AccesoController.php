<?php

namespace App\Http\Controllers;

use App\Models\acceso;
use App\Models\Egresado;
use Illuminate\Http\Request;
use app\User;
class AccesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(){
       $this->middleware('admin',['only'=>'index']);
     }

    public function index()
    {
        $accesos=Acceso::where('id_usuario','!=',\auth::user()->id)->get();
        $cantnewuser=User::where('estado_cuenta','suscrita')->get();
        $cantcance=Egresado::where('baja','true')->get();
        return view('acceso.indexAccesos',['accesos'=>$accesos,'cantnewuser'=>$cantnewuser,'cantcance'=>$cantcance]);
    }


    public function odernar($id){
      //$ordenar = Acceso::all()->orderBy('id','desc')->where('id','');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /*
    public function destroy(acceso $acceso)
    {
        //
    }*/
}
