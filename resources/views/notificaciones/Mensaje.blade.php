@extends('layouts.app')

@section('content')
      @if(Session::has('flash_message'))
        <script type="text/javascript">
          alert("{{Session::get('flash_message')}}");
        </script>
      @endif
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Enviar Mensaje</div>
          <form method="POST" action="{{route('Mensaje.store')}}">
            {{csrf_field()}}
          <div class="panel-body">
            <div class="form-group">
              <input name="title" class="form-control" placeholder="Titulo" autofocus required></input>
            </div>
            <div class="form-group">
              <select class="form-control" name="id_egresado" autofocus required>
                <option value="">Seleciona un usuario</option>
                @foreach ($users as $user)
                  <option value="{{$user->id}}">{{$user->name}}:  {{$user->email}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <textarea name="contenido" class="form-control" placeholder="Escribe tu mensaje" autofocus required></textarea>
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-block">Enviar Mensaje</button>
            </div>
          </div>
        </form>
        </div>

      </div>

    </div>

  </div>

@endsection
