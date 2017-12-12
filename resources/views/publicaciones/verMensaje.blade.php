@php
  $mensaje=\App\Models\Mensaje::findorfail($id);
  @endphp

  @if ($mensaje->exists)
    @php
    $user=\App\User::findorfail($mensaje->send_id);
    @endphp



     <div class="panel-body">
       <h3>{{ auth::user()->name}} has recibido un mensaje de {{$user->name}} </h3>
<div class="form-group center">
       <h3>Titulo {{$mensaje->title}}</h3></div>
       <div class="form-group">
         <h3>Contenido: {{$mensaje->contenido}}</h3>
       </div>
       <h3>Enviado el {{$mensaje->created_at->diffForHumans()}} by {{$mensaje->egresado->user->name}}</h3>
     </div>
 @endif
