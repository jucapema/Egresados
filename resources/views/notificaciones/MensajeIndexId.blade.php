@include('layouts.app')

@section('content')
  @if(count($mensajes)>0)
    @foreach($mensajes as $mensaje)
      <table class="table">
        <thead>
          <th>De</th>
          <th>Titulo</th>
          <th>Contenido</th>
          <th>Fecha</th>
        </thead>
        <tr>
          <td>{{$mensaje->user->name}}</td>
          <td>{{$mensaje->title}}</td>
          <td>{{$mensaje->contenido}}</td>
          <td>{{ $post->created_at->diffForHumans() }} </td>

        </tr>
      @endforeach
          {{$mensajes->render()}}
        @endif
        no hay nada de info;
@endsection
