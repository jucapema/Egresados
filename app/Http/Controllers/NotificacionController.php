<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\Mensaje;
use App\User;
use Illuminate\Http\Request;
use Auth;
class NotificacionController extends Controller
{
    public function __construct(){
      $this->middleware('egresado');
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::findorfail(Auth::user()->id);
        $mensajes=Mensaje::mensajesid($user->egresado->id)->get();
        return view('notificaciones.IndexNotificacion',['notificaciones'=>$user->notificacion,'mensajes'=>$mensajes]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notificacion=Notificacion::findorfail($id);
        $notificacion->delete();
        //\Session::flash('flash_message','Vista marcada');
        flash('Vista marcada')->error()->important();
        return redirect()->back();
    }
}
