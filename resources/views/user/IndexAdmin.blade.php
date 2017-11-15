@extends('layouts.app')

@section('titulo')

    @if(Session::has('flash_message'))
      {{Session::get('flash_message')}}
    @endif

@endsection

@section('content')
  @if($users->count()==0)
    <script type="text/javascript">
          alert("No hay Administradores Registrados!");
    </script>
  @endif
  @if(Session::has('flash_message'))
      <script type="text/javascript">
        alert("{{Session::get('flash_message')}}");
      </script>
  @endif
  <a href="{{route('Administrador.create')}}" class="btn btn-info">Agregar</a>
  <a href="#" class="btn btn-info">Consultar</a>
   <a href="{route('Administrador.edit',['user'=>$user->id])}}" class="btn btn-info">Modificar</a>
   <a href="{route('Administrador.destroy',['user'=>$user->id])}" class="btn btn-info">Eliminar</a>
    <table class="table">
        <thead>
          <th>Administrador</th>
          <th>DNI</th>
          <th>Correo</th>
        </thead>
    @foreach($users as $user)
    <tbody>
            <td>{{$user->name}} {{$user->apellidos}}</td>
            <td>{{$user->dni}}</td>
            <td>{{$user->email}}</td>
      </tbody>
    @endforeach
    {{$users->render()}}
@endsection
