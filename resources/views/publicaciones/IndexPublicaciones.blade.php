@extends('layouts.app')

@section('content')
  @if (count($publicaciones)<0)
      <script type="text/javascript">
        alert('no has publicado nada');
      </script>
  @endif
<small class="pull-left">
  <a href="{{route('Publicacion.create')}}"> <i class="material-icons iconosmenu">add circle outline</i> Agregar </a>
</small>
  <div class="container">
    <table class="table table-bordered table-condensed">
        <thead>
        <tr>
          <th>Titulo</th>
          <th>Contenido</th>

          <th>Acciones</th>
        </tr>
        </thead>
	@foreach($publicaciones as $publicacion)
        <tbody>
          <tr>
            <td>{{$publicacion->titulo}}</td>
            <td>{{$publicacion->titulo}}</td>
<td>
            <small class="pull-right">
              <form action="{{route('Publicacion.destroy',['publicacion' => $publicacion->id])}}" method="post">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </small>
            <small class="pull-right">
              <a href="{{route ('Publicacion.edit', $publicacion->id)}}" class="btn btn-info">Edit</a>
            </small></td></tr>
          </tbody>
    @endforeach
    </table>
    </div>
    {{$publicaciones->render()}}
@endsection
