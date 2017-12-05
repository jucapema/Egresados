@php
         $favoritos=app\models\Favorito::where('id_usuario',Auth::user()->id)->get();
    //$users=App\User::where('id',$favorito->amigo)->get();
@endphp
<div style="overflow:scroll;height:450px;width:500px;">

            <div class="panel-body">
              @foreach ($favoritos as $favorito)
                @php
                  $user=app\user::findOrfail($favorito->amigo);
                @endphp
              <div class="col-sm-6 col-md-10">
                <div class="thumbnail">
                  <div class="form-group">
                    @component('user.ModalFormEdit')
                      @slot('id')
                        {{$user->id}}
                      @endslot
                      @slot('idmodal')
                          modalSend{{$user->id}}
                      @endslot
                      @slot('title')
                            Enviar email a {{$user->name}}
                      @endslot
                      @slot('contenido')
                        @component('notificaciones.ModalMensaje')
                          @slot('correo')
                            {{$user->email}}
                          @endslot
                        @endcomponent
                      @endslot
                    @endcomponent
                    @component('user.ModalConfirmarAdd')
                      @slot('idmodal')
                          modalDelete{{$user->id}}
                      @endslot
                      @slot('title')
                            Borrar a {{$user->name}} de tu lista de contactos
                      @endslot
                      @slot('contenido')
                        Borrar Contacto
                      @endslot
                      @slot('ruta')
                        {{route('eliminaramigo',['user'=>$user->id])}}
                      @endslot
                    @endcomponent
                        <h2>Nombre: {{$user->name}}</h2>
                        <h2>Email: {{$user->email}}</h2>
        <div class="panel-footer">
          <button class="contactar btn btn-primary" data-toggle='modal' data-target='#modalSend{{$user->id}}'> <i class="material-icons iconosmenu">email</i> </button>
          <button class="contactar btn btn-danger" data-toggle='modal' data-target='#modalDelete{{$user->id}}'> <i class="material-icons iconosmenu">delete</i> </button>
        </div>
              </div>
                  </div>
                  </div>
                @endforeach
                  </div>
