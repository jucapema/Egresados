@extends('layouts.menus')
@section('headers')
    @yield('mainheaders')
@endsection('headers')
@section('content')
    <div class="container" align="center">
        <div class="row">
            <div class="btn-group btn-breadcrumb" >
                <a href="{{route('posts')}}" class="btn btn-primary bordemenu activa1"><i class="glyphicon glyphicon-home"></i></a>
              <a href="#" class="btn btn-primary bordemenu" data-toggle="dropdown" data-hover="dropdown">Perfil</a>
                  <ul class="dropdown-menu">
                    <li><a class="btn4 bordesubmenu">Foto de Perfil</a></li>
                    <li><a class="btn2 bordesubmenu" data-toogle="modal" data-target="#miventana">Editar Información</a></li>
                    <li><a class="btn3" data-toogle="modal" data-target="#ventanapassword">Cambiar Contraseña</a></li>
                </ul>
                <a class="btn btn-primary btn6 bordemenu" data-toogle="modal" data-target="#miventanainfo">Información</a>
                <a class="btn btn-primary btn5 bordemenu" data-toogle="modal" data-target="#baja">Dar de Baja</a>
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
                    <li><a href="{{route('Notificacion.index')}}"><i class="material-icons iconosmenu">notifications_active</i>Notificaciones</a><span class="badge">{{count(Auth::user()->notificacion)}}</span></li>
                    <li><a href="{{route('Mensaje.index')}}"><i class="material-icons iconosmenu">mail</i>Mensajes de Egresados</a><span class="badge">{{count($mensajes)}}</span></li>
                    <li><a href="{{route('listcontactos')}}"><i class="material-icons iconosmenu">person_add</i>Buscar Amigos</a></li>
                    <li><a data-toogle="modal" data-target="#contactos"><i class="btn8 material-icons iconosmenu">list</i>Lista de Amigos</a></li>
                    <li><a data-toogle="modal" data-target="#chat"><i class="btn7 material-icons iconosmenu">chat</i>Chat</a></li>
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
