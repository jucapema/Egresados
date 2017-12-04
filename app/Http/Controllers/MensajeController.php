<?php

namespace App\Http\Controllers;
use App\User;
use App\Models\Mensaje;
use App\Models\Egresado;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use Auth;
class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensajes=Mensaje::mensajesid(Auth::user()->egresado->id)->get();
        return view('notificaciones.verMensajes',['mensajes'=>$mensajes]);
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
      $v = \Validator::make($request->all(),[
          'email' => 'required|email',
          'title' => 'required',
          'contenido' => 'required',
      ]);
      if($v->fails()){
        return redirect()->back()->withInput()->withErrors($v->errors());
      }else{
      $user = User::where('email',$request->email)->where('estado_cuenta','activa')->firstorfail();
      if(count($user)>0){
            $data=$request->all();
            $data['send_id'] = \Auth::user()->id;
            $data['id_egresado'] = $user->egresado->id;
            $mensaje=Mensaje::create($data);
            $data2['id_usuario'] =$user->id;
            $data2['tipo'] ='mensaje';
            $data2['id_tipo'] = $mensaje->id;
            Notificacion::create($data2);
            \Session::flash('flash_message','Mensaje_Enviado');
            return redirect()->back();
          }else{
            \Session::flash('flash_message','El mensaje no se ha podido enviar');
            return redirect()->back();
          }
        }
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

    public function update(Mensaje $mensaje,$id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mensaje=Mensaje::findorfail($id);
        $notificacion=Notificacion::where('id_tipo',$id)->where('tipo','mensaje')->where('created_at',$mensaje->created_at);
        if(count($notificacion)>0){
          $notificacion->delete();
        }
        $mensaje->delete();
        \Session::flash('flash_message','Mensaje Eliminado');
        return redirect()->route('Mensaje.index');
    }
}
