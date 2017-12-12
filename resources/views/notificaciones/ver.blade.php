@php

  $notificacion=\App\Models\Notificacion::findorfail($id);
@endphp
  <div class="conteiner ">
      <div class="col-md-12">
      @if ($notificacion->tipo=='post')
          @component('publicaciones.verPost')
              @slot('id')
                {{$notificacion->id_tipo}}
              @endslot
          @endcomponent

    @elseif ($notificacion->tipo=='mensaje')
            @component('publicaciones.verMensaje')
              @slot('id')
                {{$notificacion->id_tipo}}
              @endslot
            @endcomponent
      @endif
        @if ($notificacion->tipo=='ban')
              <h3>'sr'."".{{$notificacion->user->name.$notificacion->user->apellido}}."".'Su cuenta se encuentra suspendida porfavor contatenos.';</h3>
              <h3>Ir {route()}}</h3>
        @endif


      </div>
  </div>
