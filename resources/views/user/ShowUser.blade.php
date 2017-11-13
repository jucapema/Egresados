@extends('layouts.app')

@section('titulo')

    @endsection

@section('content')
  <div class="row ">
      <div class="col-md-12">
        <h3>Nombre: {{$usuario->name}}<small class="pull-right">
          <a href="{{route ('Usuario.edit',['user' => $usuario->id])}}" class="btn btn-info">Edit</a>
        </small></h3>
                   <h3>Apellidos: {{$usuario->apellido}}  </h3>
                   <h3>Email: {{$usuario->email}}  </h3>
                   <h3>DNI: {{$usuario->dni}}</h3>
    @if ($usuario->tipo_rol=='egresado')@php
            $egresado=App\Models\Egresado::where('id_usuario',$usuario->id)->firstOrFail();
            $edad=\Carbon\Carbon::parse($egresado['fecha_nacimiento'])->age;
        @endphp
                  <h3>Intereses: {{$egresado->ciudad}}</h3>
                  <h3>Genero: {{$egresado->genero}}</h3>
                  <h3>Edad: {{$edad}}</h3>
    @elseif ($usuario->tipo_rol=='administrador')@php
        $administrador=App\Models\Administrador::where('id_usuario',$usuario->id)->firstOrFail();
      @endphp
                  <h3>Direccion: {{$administrador->direccion}}</h3>
                  <h3>Ciudad: {{$administrador->ciudad}}</h3>
                  <h3>Telefono: {{$administrador->telefono}}</h3>
    @endif
      </div>
  </div>
@endsection
