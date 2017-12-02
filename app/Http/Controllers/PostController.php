<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\Egresado;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use App\User;
use Session;
use Auth;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $publicaciones = Publicacion::orderBy('id','desc')->get();
      $cantnewuser=User::where('estado_cuenta','suscrita')->get();
      $cantcance=Egresado::where('baja','true')->get();
      return view('publicaciones.IndexPublicaciones',['publicaciones'=>$publicaciones, 'cantnewuser'=>$cantnewuser,'cantcance'=>$cantcance]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $v = \Validator::make($request->all(),[
        'titulo'=>'required',
          'cuerpo'=>'required',
          'fecha'=>'required|date',
          'file'=>'required|image',
      ]);
      if($v->fails()){
       return redirect()->back()->withInput()->withErrors($v->errors());
      }else{
        $data = $request->all();
        $data['id_administrador']=Auth::user()->administrador->id;
        $file = $request->file('file');
        $nombre=$file->getClientOriginalName();
        $request->file('file')->storePubliclyAs('images',$nombre,'public'); //guarda en public
        $data['multimedia']=$nombre;
        $publicacion = Publicacion::create($data);
        $users = User::where('tipo_rol','egresado')->where('estado_cuenta','activa')->get();
        foreach ($users as $user) {
                 $data2['id_usuario'] =$user->id;
                 $data2['tipo'] ='post';
                 $data2['informacion'] = $request['titulo'].$request['cuerpo'].$request['fecha'];
                 Notificacion::create($data2);
               }
        Session::flash('flash_message','Publicado exitosamente');
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function show(publicacion $publicacion)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(publicacion $publicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, publicacion $publicacion)
    {
      $v = \Validator::make($request->all(),[
          'fecha'=>'date',
          'file'=>'required|image',
      ]);
      if($v->fails()){
       return redirect()->back()->withInput()->withErrors($v->errors());
      }else{
        $data = $request->all();
        //$data['id_administrador']=Auth::user()->administrador->id;
        $file = $request->file('file');
        $nombre=$file->getClientOriginalName();
        $request->file('file')->storePubliclyAs('images',$nombre,'public'); //guarda en public
        $data['multimedia']=$nombre;
        $publicacion->update($data);
        Session::flash('flash_message','Publicado exitosamente');
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(publicacion $publicacion)
    {
        //
    }
}
