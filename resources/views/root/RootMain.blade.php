@extends('layouts.menus')
@section('headers')

@endsection('headers')
@section('content')
    <div class="container" align="center">
        <div class="row">
            <div class="btn-group btn-breadcrumb" >
                <a href="#" class="btn btn-primary bordemenu activa1"><i class="glyphicon glyphicon-home"></i></a>
              <a href="#" class="btn btn-primary bordemenu" data-toggle="dropdown" data-hover="dropdown">Perfil</a>
                  <ul class="dropdown-menu">
                    <li><a class="btn4 bordesubmenu">Foto de Perfil</a></li>
                    <li><a class="btn2 bordesubmenu" data-toogle="modal" data-target="#miventana">Editar Información</a></li>
                    <li><a class="btn3" data-toogle="modal" data-target="#ventanapassword">Cambiar Contraseña</a></li>
                </ul>
                <a href="#" class="btn btn-primary bordemenu">Información</a>
                <a href="#" class="btn btn-primary">Ayuda</a>
                <a href="{{route('logout')}}" class="btn btn-primary">Salir</a>
            </div>
        </div>
    </div>

<div class="container" align="center">
    <div class="nav-side-menu">
        <!--<div class="brand">Egresados UTP</div>-->
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

            <div class="menu-list" align="center">
                <ul id="menu-content" class="menu-content collapse out">
                    <li><a href="{{route('Administrador.index')}}"><i class="material-icons iconosmenu">settings</i>Gestionar Administradores</a></li>
                </ul>

            </div>
    </div>

    @include('modalhorizontal')

    @yield('recuadro')
<!--
    <div class= cuadro>
      Aqui sirve todo
    </div>-->
@endsection('content')
