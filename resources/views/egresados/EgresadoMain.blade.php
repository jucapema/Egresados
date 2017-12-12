@extends('layouts.menus')
@section('headers')
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    @yield('mainheaders')
@endsection('headers')
@section('content')

    <nav id="menu" class="poshorizontal2">
        <li><a href="{{route('posts')}}">
            <i class="glyphicon glyphicon-home tamicon"></i></a></li>
        <li><a href="#">Perfil</a>
            <ul>
                <li><a class="btn4">Foto de Perfil</a></li>
                <li><a class="btn2" data-toogle="modal" data-target="#miventana">
                Editar Información</a></li>
                <li><a class="btn3" data-toogle="modal" data-target="#ventanapassword">Cambiar Contraseña</a></li>
            </ul>
        </li>
        <li><a class="btn6" data-toogle="modal" data-target="#miventanainfo">Información</a></li>
        <li><a class="btn5" data-toogle="modal" data-target="#baja">Dar de Baja</a></li>
        <li><a href="https://www.utp.edu.co/egresados/egresados-utp.html"
            target="_blank">Ayuda</a></li>
        <li><a href="{{route('logout')}}">Salir</a></li>
    </nav>

    <div class="nav-side-menu">
        <div class="brand">Egresados UTP</div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

            <div class="menu-list">
                <ul id="menu-content" class="menu-content collapse out">
                    <li><a href="{{route('Notificacion.index')}}"><i class="material-icons iconosmenu">notifications_active</i>Notificaciones</a><span class="badge">{{count(Auth::user()->notificacion)}}</span></li>
                    <li><a href="{{route('Mensaje.index')}}"><i class="material-icons iconosmenu">mail</i>Mensajes de Egresados</a><span class="badge">{{count($mensajes)}}</span></li>
                    <li><a href="{{route('listcontactos')}}"><i class="material-icons iconosmenu">person_add</i>Buscar Amigos</a></li>
                    <li><a href="{{route('Favorito.index')}}"><i class="material-icons iconosmenu">list</i>Lista de Amigos</a></li>
                    <!--<li><a data-toogle="modal" data-target="#chat"><i class="btn7 material-icons iconosmenu">chat</i>Chat</a></li>-->
                </ul>
            </div>
    </div>

    <div class= "recuadro">
    @yield('recuadro')
  </div>


  @section('modals')
      @yield('mainmodals')
  @endsection
@endsection('content')
