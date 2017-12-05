@extends('layouts.menus')
@section('headers')
    @yield('mainheaders')
@endsection('headers')
@section('content')

    <nav id="menu" class="poshorizontal">
        <li><a href="#">
            <i class="glyphicon glyphicon-home tamicon"></i></a></li>
        <li><a href="#">Perfil</a>
            <ul>
                <li><a class="btn4">Foto de Perfil</a></li>
                <li><a class="btn2" data-toogle="modal" data-target="#miventana">
                Editar Información</a></li>
                <li><a class="btn3" data-toogle="modal" data-target="#ventanapassword">Cambiar Contraseña</a></li>
            </ul>
        </li>
        <li><a class="btn6">Información</a></li>
        <li><a href="https://www.utp.edu.co/egresados/egresados-utp.html" 
            target="_blank">Ayuda</a></li>
        <li><a href="{{route('logout')}}">Salir</a></li>
    </nav>

    <div class="nav-side-menu">
        <div class="brand">Egresados UTP</div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

            <div class="menu-list">
                <ul id="menu-content" class="menu-content collapse out">
                    <li><a href="{{route('Administrador.index')}}"><i class="material-icons iconosmenu">settings</i>Gestionar Administradores</a></li>
                    <li><a href="{{route('listrestore')}}"><i class="material-icons iconosmenu">delete_sweep</i>Cuentas Inactivas</a></li>
                    <li><a href="#"><i class="material-icons iconosmenu">web_asset</i>Actividad Plaataforma</a></li>
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
