@extends('layouts.app')

@section('content')
<title>Index super root</title>

<div class="jumbotron">
        <p class="lead">Hola, {{Auth::user()->name}} {{Auth::user()->apellido}} {{Auth::user()->tipo_rol}} </p>
    </div>
    <ul class="nav">
<ul>
  <div class="container">
    <a href="{{route('correo')}}">enviar</a>
        <a class="btn btn-info" href="#">
            PERFIL
          </a>
        <a class="btn btn-info" href="#">
          INFORMACION
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
        Administrar publicaciones
      </a></div>
    <div class="container">
      <a class="btn btn-primary" href="#">
        Solicitudes nuevos Usuarios
      </a></div>
    <div class="container">
      <a class="btn btn-primary" href="#">
        Gestion cuentas egresados
      </a></div>
    <div class="container">
      <a class="btn btn-primary" href="#">
        Solicitu desde cancelacion de cuenta
      </a></div>
  </div>
@endsection
