@php
  //$users=App\User::where('tipo_rol','egresado')->where('id','!=',$id)->where('estado_cuenta','activa')->orderBy('name','asc')->get();
  $users=App\User::contactos($id)->orderBy('name','asc')->get();
@endphp


          <div class="panel-heading">Enviar Mensaje {{count($users)}}</div>
          <form method="POST" action="{{route('Mensaje.store')}}">
            {{csrf_field()}}
          <div class="panel-body">
            <div class="form-group">
              <input name="title" class="form-control" placeholder="Titulo" autofocus required></input>
            </div>
            <div class="form-group">
              <select class="form-control" name="email" autofocus required>
                <option value="">Seleciona un usuario</option>
                @foreach ($users as $user)
                  <option value="{{$user->email}}">Correo:  {{$user->email}} --------{{$user->name}}</option>
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
