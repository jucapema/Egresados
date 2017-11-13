@extends('layouts.app')

@section('content')
<title>Index super root</title>

<div class="jumbotron">
        <p class="lead">Hola, {{Auth::user()->name}} {{Auth::user()->tipo_rol}} </p>
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
      </div></ul>
</ul>
<hr>
<div class="container">
<a class="btn btn-primary" href="{{route('admingestion')}}">
  Gestionar Administradores
</a></div>
@endsection
