<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\Egresado;
use App\Models\Notificacion;
use App\Models\Mensaje;
use Illuminate\Http\Request;
use App\User;
use Session;
use Auth;
class PostController extends Controller
{
      public function __construct(){
        $this->middleware('admin',['only'=>['index','store','update','destroy']]);
        $this->middleware('egresado',['only'=>['listposts']]);
      }
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

    public function listposts(){
      $publicaciones=Publicacion::all();
        $mensajes=Mensaje::mensajesid(Auth::user()->egresado->id)->get();
      return view('publicaciones.verPosts',['publicaciones'=>$publicaciones, 'mensajes'=>$mensajes]);
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
                 $data2['id_tipo'] =$publicacion->id;
                 Notificacion::create($data2);
               }
        //Session::flash('flash_message','Publicado exitosamente');
        flash('Publicado exitosamente')->success();
        return redirect()->back();
      }
    }

    public function update(Request $request, $id)
    {
      $v = \Validator::make($request->all(),[
          'fecha'=>'date',
          'file'=>'required|image',
      ]);
      if($v->fails()){
       return redirect()->back()->withInput()->withErrors($v->errors());
      }else{
        $publicacion=Publicacion::findorfail($id);
        $data = $request->all();

        //$data['id_administrador']=Auth::user()->administrador->id;
        $file = $request->file('file');
        $nombre=$file->getClientOriginalName();
        $request->file('file')->storePubliclyAs('images',$nombre,'public'); //guarda en public
        $data['multimedia']=$nombre;
        $publicacion->update($data);
        flash('Actualizado Correctamente')->success();
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publicacion=Publicacion::findorfail($id);
        $notificaciones=Notificacion::where('id_tipo',$id)->where('tipo','post')->where('created_at',$publicacion->created_at)->get();
        foreach ($notificaciones as $notificacion) {

          $notificacion->delete();
        }
        $publicacion->delete();
//        Session::flash('flash_message','Publicacion Eliminada Correctamente');
        flash('Publicacion Eliminada Correctamente')->error()->important();
        return redirect()->back();
    }
}
