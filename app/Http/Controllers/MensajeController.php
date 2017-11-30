<?php

namespace App\Http\Controllers;
use App\User;
use App\Models\Mensaje;
use App\Models\Egresado;
use App\Models\Notificacion;
use Illuminate\Http\Request;

class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensajes=Mensaje::orderBy('id_egresado', 'asc')->paginate(10);
        //return view('home',['mensajes'=>$mensajes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $egresados = Egresado::all();
//var_dump($users);
        return view('notificaciones.Mensaje',compact('egresados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      /*$v = \Validator::make($request->all(),[

      ]);
      if($v->fails()){
        return redirect()->back()->withInput()->withErrors($v->errors());
      }else{*/
      //$data['id_usuario']
      //$data=$request->except('id_egresado');
      $data=$request->all();
      $data['send_id'] = \Auth::user()->id;
      $mensaje=Mensaje::create($data);
        //return redirect()->route('Notificacion.store',['tipo'=>'mensaje','valores'=>$mensaje]);
        $data2['id_usuario'] =$$request->id_egresado;
        $data2['tipo'] ='mensaje';
        $data2['informacion'] = $request['titulo'].$request['cuerpo'];
        Notificacion::create();
        \Session::flash('flash_message','Mensaje_Enviado');
        return redirect()->back();
    }

  /*  public function indexmensajes($id){
      $mensajes = Mensaje::Mensajesid($id)->orderBy('create_ad','asc')->paginate(20);
      return view('notificaciones.MensajesIndexId',['mensajes'=>$mensajes]);
    }*/

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function show(Mensaje $mensaje)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mensaje $mensaje)
    {
        $mensaje->delete();
        return redirect()->back();
    }
}
