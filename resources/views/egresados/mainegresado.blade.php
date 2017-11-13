@extends('layouts.app')

@section('content')
<title>Index super root</title>

<div class="jumbotron">
        <p class="lead">Hola, {{Auth::user()->name}} {{Auth::user()->apellido}} {{Auth::user()->tipo_rol}} </p>
    </div>
    <div class="container">
    <ul class="nav">
<ul>
    <a href="{{route('correo')}}">enviar</a>
        <li> <h3><a href= "#"> Perfil </h3></a>
  			  <ul>
  			       <li> <h3><a href= "#" > Foto de Perfil </h3></a></li>
               <li> <h3><a href= "#" > Editar Informacion </h3></a></li>
               <li> <h3><a href= "#" > Cambiar Contraseña </h3></a></li>
  			  </ul>
			  </li>
        <a class="btn btn-info" href="#">
          INFORMACION
        </a>
        <a class="btn btn-info" href="#">
          DAR DE BAJA
        </a>
        <a class="btn btn-info" href="#">
          AYUDA
        </a>
      </div></ul>
</ul>
<hr>
  <div class="container">
    <div class="container">
      <a class="btn btn-primary" href="#">
        Notificaciones
      </a></div>
    <div class="container">
      <a class="btn btn-primary" href="#">
        Mensajes Egresados
      </a></div>
    <div class="container">
      <a class="btn btn-primary" href="#">
        buscar amigos
      </a></div>
    <div class="container">
      <a class="btn btn-primary" href="#">
        chat
      </a></div>
  </div>
@endsection
