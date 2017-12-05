<?php

namespace App\Http\Middleware;

use Closure;

class RootMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if($request->user()->tipo_rol == "root"){
           return $next($request);
         }
        else{
            //abort(403, "¡Acceso Denegado");
            flash()->overlay('No tienes Permisos Para esta ruta','¡Acceso Denegado');
            return redirect()->back();
         }
    }
}
