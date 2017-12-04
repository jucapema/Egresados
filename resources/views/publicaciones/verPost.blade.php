@php
  $publicacion=\App\Models\Publicacion::findorfail($id);
@endphp


   <div class="panel panel-default">
     <div class="panel-body">
       <img src="/storage/images/{{$publicacion->multimedia}}" alt="" style="width:50px;">
       <h3>{{ auth::user()->name}} has recibido una nueva publicacion </h3>
       <h3>Titulo {{$publicacion->titulo}}</h3>
       <h3>Contenido {{$publicacion->cuerpo}}</h3>
       <h3>Fecha del Evento {{$publicacion->fecha}}</h3>
       <h3>Publicado el {{$publicacion->created_at->diffForHumans()}} by
         @if ($publicacion->administrador!=null)
           {{$publicacion->administrador->user->name}}</h3>
           @else
             Administrador no disponible</h3>
         @endif

     </div>

   </div>
