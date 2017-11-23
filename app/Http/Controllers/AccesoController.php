<?php

namespace App\Http\Controllers;

use App\Models\acceso;
use Illuminate\Http\Request;

class AccesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accesos=Acceso::orderBy('id','desc')->paginate(10);
        return view('acesso.index',['acceso'=>$accesos]);
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
