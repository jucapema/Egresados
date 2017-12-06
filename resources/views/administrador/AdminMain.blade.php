@extends('layouts.menus')
@section('headers')
  <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
@yield('mainheaders')

@endsection('headers')
@section('content')
  <!-- CSRF Token -->
    <nav id="menu" class="poshorizontal">
        <li><a href="{{route('Publicacion.index')}}">
            <i class="glyphicon glyphicon-home tamicon"></i></a></li>
        <li><a href="#">Perfil</a>
            <ul>
                <li><a class="btn4">Foto de Perfil</a></li>
                <li><a class="btn2" data-toogle="modal" data-target="#miventanaadmin">
                Editar Información</a></li>
                <li><a class="btn3" data-toogle="modal" data-target="#ventanapassword">Cambiar Contraseña</a></li>
            </ul>
        </li>
        <li><a class="btn6" data-toogle="modal" data-target="#miventanainfo">Información</a></li>
        <li><a href="https://www.utp.edu.co/egresados/egresados-utp.html" 
            target="_blank">Ayuda</a></li>
        <li><a href="{{route('logout')}}">Salir</a></li>
    </nav>


    <div class="nav-side-menu">
        <div class="brand">Egresados UTP</div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

            <div class="menu-list">
                <ul id="menu-content" class="menu-content collapse out">
                    <li><a href="{{route('Publicacion.index')}}"><i class="material-icons iconosmenu">publish</i>Administrar Publicaciones</a></li>
                    <li><a href="{{route('indexsuscrita')}}"><i class="material-icons iconosmenu">person_add</i>Solicitudes de Nuevos Usuarios</a><span class="badge">{{count($cantnewuser)}}</span></li>
                    <li><a href="{{route('Egresado.index')}}"><i class="material-icons iconosmenu">supervisor_account</i>Gestion de Cuentas Egresados</a></li>
                    <li><a href="{{route('cancelar')}}"><i class="material-icons iconosmenu">add_alert</i>Solicitudes de Cancelacion de Cuenta</a><span class="badge">{{count($cantcance)}}</span></li>
                    <li><a href="{{route('Acceso.index')}}"><i class="material-icons iconosmenu">web_asset</i>Actividad Plataforma</a></li>
                </ul>
            </div>
    </div>



      <div class="recuadro">
    @yield('recuadro')
      </div>

@section('modals')
    @yield('mainmodals')
@endsection
@endsection('content')
