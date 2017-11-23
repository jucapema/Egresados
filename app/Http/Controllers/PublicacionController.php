<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Session;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publicaciones = Publicacion::orderBy('id','desc')->paginate(10);
        return view('publicaciones.index',['publicaciones'=>$publicaciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('publicaciones.CreatePublicacion'); no existe la vista
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v=\Validator::make($request->all()[
          'titulo'='required|max:100',
          'cuerpo'='required|max:255',
        ]);
        if($v->fails()){
          return redirect()->back()->withInput()->withErrors($v->errors());
        }else{
          $data= $request->all();
          $data['id_usuario'] = $request->user()->id;
          $publicacion = Publicacion::create($data);
          Session::flash('flash_message','Publicado');
          return redirect()->route('Publicacion.index');
    }
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Publicacion $publicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Publicacion $publicacion)
    {
        return view('publicaciones.EditPublicacion',['publicacion'=>$publicacion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publicacion $publicacion)
    {
      $v=\Validator::make($request->all()[
        'titulo'='required|max:100',
        'cuerpo'='required|max:255',
      ]);
      if($v->fails()){
        return redirect()->back()->withInput()->withErrors($v->errors());
      }else{
            $
            Session::flash('flash_message','Publicado');
            return redirect()->route('Publicacion.index');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publicacion $publicacion)
    {
        $publicacion->delete();
        Session::flash('flash_message','Publicacion Eliminada');
        return redirect()->route('Publicacion.index');
    }
}
