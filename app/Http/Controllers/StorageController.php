<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorageController extends Controller
{
  public function __construct(){
    $this->middleware('egresado');
  }

  public function save(Request $request)
  {
    $v = \Validator::make($request->all(), [
            'file'=>'required|image',
      ]);
      if ($v->fails())
      {
        return redirect()->back()->withInput()->withErrors($v->errors());
      }
     //obtenemos el campo file definido en el formulario
     $file = $request->file('file');
     //obtenemos el nombre del archivo
     //$nombre = $file->getClientOriginalName();
    $nombre = $request->user()->id.'.'.$file->getClientOriginalExtension();
     //\Storage::disk('local')->put($nombre,  \File::get($file));
     $request->file('file')->storePubliclyAs('images',$nombre,'public'); //guarda en public
     flash('Foto subida Correctamente')->success();
     return redirect()->back();
   }

   public function load(Request $request){
        $public_path = storage_path();
          $nombre = $request->user()->id.'.'.'png';
         $url = $public_path.'\app\\'.$nombre;
         //verificamos si el archivo existe y lo retornamos
         //if (\Storage::disk('public')->exists($nombre))
         //{
           return response()->download($url);
         //si no se encuentra lanzamos un error 404.
         //abort(404);
   }
//para q asset alcance los archivos locales en public storage es necesario, hacer un link  a la carpeta storage
}
