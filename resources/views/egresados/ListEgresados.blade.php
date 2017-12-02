@extends('egresados.EgresadoMain')

@section('recuadro')

    <div class="panel panel-default">
        <div class="panel-heading" align="center">Buscar amigos</div>
        <div class="panel-body">
  <table class="table" id="users">
    <tr>
      <th></th>
      <th>Nombre</th>
      <th>Email</th>
      <th>Genero</th>
      <th>Intereses</th>
      <th>Contactar</th>
    </tr>
    <tbody>
      @foreach ($users as $user)
@if ($user->id!=Auth::user()->id)

      <tr>
        <td><img src="/storage/images/1.jpg" alt="" style="width:50px;"></td>
        <td>{{$user->name}}{{$user->apellido}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->egresado->intereses}}</td>
        <td>{{$user->egresado->genero}}</td>
        <td><button class="contactar btn btn-primary"> <i class="material-icons iconosmenu">email</i> </button></td>
      </tr>
    @endif
    @endforeach
    </tbody>
  </table>
</div>
</div>

@endsection
