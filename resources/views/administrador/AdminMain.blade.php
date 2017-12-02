@extends('layouts.menus')
@section('headers')
  <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
@yield('mainheaders')

@endsection('headers')
@section('content')
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
       <div class="container" align="center">
        <div class="row">
            <div class="btn-group btn-breadcrumb" >
                <a href="#" class="btn btn-primary bordemenu activa1"><i class="glyphicon glyphicon-home"></i></a>
              <a href="#" class="btn btn-primary bordemenu" data-toggle="dropdown" data-hover="dropdown">Perfil</a>
                  <ul class="dropdown-menu">
                      <li><a class="btn4 bordesubmenu" >Foto de Perfil</a></li>
                      <li><a class="btn2 bordesubmenu" data-toogle="modal" data-target="#miventanaadmin">Editar Información</a></li>
                      <li><a class="btn3" data-toogle="modal" data-target="#ventanapassword">Cambiar Contraseña</a></li>
                  </ul>
                <a class="btn btn-primary btn6 bordemenu" data-toogle="modal" data-target="#miventanainfo">Información</a>

                <a href="https://www.utp.edu.co/egresados/egresados-utp.html" target="_blank" class="btn btn-primary">Ayuda</a>
               <a href="{{route('logout')}}" class="btn btn-primary">Salir</a>
            </div>
        </div>
    </div>


    <div class="nav-side-menu">
        <div class="brand">Egresados UTP</div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

            <div class="menu-list">
                <ul id="menu-content" class="menu-content collapse out">
                    <li><a href="{{route('Publicacion.index')}}"><i class="material-icons iconosmenu">publish</i>Administrar Publicaciones</a></li>
                    <li><a href="{{route('indexsuscrita')}}"><i class="material-icons iconosmenu">person_add</i>Solicitudes de Nuevos Usuarios</a><span class="badge">{{count($cantnewuser)}}</span></li>
                    <li><a href="{{route('Egresado.index')}}"><i class="material-icons iconosmenu">supervisor_account</i>Gestion de Cuentas Egresados</a></li>
                    <li><a href="{{route('cancelar')}}"><i class="material-icons iconosmenu">add_alert</i>Solicitudes de Cancelacion de Cuenta</a><span class="badge">{{count($cantcance)}}</span></li>
                    <li><a href="{{route('restore')}}"><i class="material-icons iconosmenu">delete_sweep</i>Cuentas Inactivas</a></li>
                    <li><a href="#"><i class="material-icons iconosmenu">web_asset</i>Actividad Plaataforma</a></li>
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
