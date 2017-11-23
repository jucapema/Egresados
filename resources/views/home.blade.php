@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <table class="table">
                    <th>id</th>
                    <th>titulo</th>
                    <th>contenido</th>      //reimportante esto
                    <th>info extendida</th>
                    @foreach ($mensajes as $mensaje)
                      <tbody>
<tr>

                    <td>{{$mensaje->id_egresado}}</td>
                    <td>{{$mensaje->title}}</td>
                    <td>{{$mensaje->contenido}}</td>
                    <td>{{$mensaje->egresado->fecha_nacimiento}}</td>
                  </tr>
                @endforeach
              </tbody>
                  </table>

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
