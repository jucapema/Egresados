@include('layouts.app')

@section('content')
    <table class="table">
        <thead>
          <th>Nombre</th>
          <th>Codigo</th>
          <th>Correo</th>
          <th>Solicitud</th>
        </thead>
    @foreach($users as $user)
    @if ($user->tipo_rol!='root')
    <tbody>
        @php
        $Telefono = App\Models\Usuarios\Telefono::findOrFail($user->id);
      @endphp
            <td><a href="{{route('Usuario.show',['usuario' => $user->id])}}">{{$user->name}}" "{{$user->apellidos}}</a></td>
            <td>{{$user->dni}}</td>
            <td>{{$user->email}}
              <small class="pull-right">
                    <a href="{{route ('Administrador.aprobar',['user' => $user->id])}}" class="btn btn-primary">Aprobar</a>
              </small><small class="pull-right">
                  <a href="{{route ('Administrador.rechazar',['user' => $user->id])}}" class="btn btn-danger">rechazar</a>
            </small></td>
          </tbody>
          @endif
          {{$users->render()}}
@endsection
