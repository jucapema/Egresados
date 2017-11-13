@include('layouts.app')

@section('titulo')
  Usuario Activo: {{Auth::user()->name}}  {{Auth::user()->apellido}} <small class="pull-right"><a href="{{('Publicacion.create')}}" class="btn-info">Nueva Publicacion</a>
@endsection

@section('content')

  @foreach ($Publicaciones as $Publicacion)
<div class="container">
      <h3>{{$publicacion->titulo}}</h3>
      <h3>{{$publicacion->cuerpo}}</h3>
  </div>
  <small class="pull-right">
      <form action="{{route('Publicacion.destroy',['publicacion' => $publicacion->id])}}" method="post">
          {{csrf_field()}}
          {{method_field('DELETE')}}
          <button type="submit" class="btn btn-danger">Delete</button>
      </form>
  </small>
  <small class="pull-right">
          <a href="{{route ('Publicacion.edit',['publicacion' => $publicacion->id])}}" class="btn-info">Edit</a>
  </small></td>
  @endforeach
  {{$Publicaciones->render()}}
@endsection
