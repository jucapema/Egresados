@extends('egresados.EgresadoMain')
@section('mainheaders')

@endsection
@section('recuadro')
  <div style="overflow:scroll;height:400px;width:800px;">
  @foreach ($mensajes as $mensaje)

       <div class="panel panel-default">
         <div class="panel-body">
<div class="row">
  <div class="col-sm-6 col-md-10">
    <div class="thumbnail">

      @component('user.ModalFormEdit')
        @slot('id')
          {{$mensaje->id}}
        @endslot
        @slot('idmodal')
            modalReply{{$mensaje->id}}
        @endslot
        @slot('title')
              Enviar email a {{$mensaje->egresado->user->name}}
        @endslot
        @slot('contenido')
          @component('notificaciones.ModalMensajeReply')
            @slot('correo')
              {{$mensaje->egresado->user->email}}
            @endslot
            @slot('contenido')
              {{$mensaje->contenido}}
            @endslot
          @endcomponent
        @endslot
      @endcomponent

      @component('user.ModalFormEdit')
        @slot('id')
          {{$mensaje->id}}
        @endslot
        @slot('idmodal')
            modalSend{{$mensaje->id}}
        @endslot
        @slot('title')
              Enviar email a {{$mensaje->egresado->user->name}}
        @endslot
        @slot('contenido')
          @component('notificaciones.ModalMensaje')
            @slot('correo')
              {{$mensaje->egresado->user->email}}
            @endslot
          @endcomponent
        @endslot
      @endcomponent

        @component('user.ModalConfirmar')
          @slot('ruta')
            {{route('Mensaje.destroy',['mensaje'=>$mensaje->id])}}
          @endslot
          @slot('idmodal')
              modalDelete{{$mensaje->id}}
          @endslot
          @slot('title')
                Eliminar mensaje
          @endslot
          @slot('contenido')
            Estas seguro de Eliminar este {{$mensaje->title}}
          @endslot
        @endcomponent

      <img src="/storage/images/1.jpg" alt="" style="width:70px;" align="left">
      <div class="caption">
        <h3>Título: {{$mensaje->title}}</h3>
        <div class="form-group" align="center">
          <p>Contenido: {{$mensaje->contenido}}</p>
        </div>
        <p>Enviado el  {{$mensaje->created_at}} by {{$mensaje->egresado->user ->name}}</p>
      </div>
      <div class="form-group" aling="right">
      <p>
        <button type='button' class='reply btn btn-primary' data-toggle='modal' data-target='#modalReply{{$mensaje->id}}' ><i class="material-icons iconosmenu">reply</i></button>
        <button type='button' class='send btn btn-primary' data-toggle='modal' data-target='#modalSend{{$mensaje->id}}' ><i class="material-icons iconosmenu">email</i></button>
        <button type='button' class='delete btn btn-danger' data-toggle='modal' data-target='#modalDelete{{$mensaje->id}}' ><i class="material-icons iconosmenu">delete_forever</i></button>
      </p>
    </div>
    </div>
  </div>
</div>
</div>
</div>

@endforeach
</div>


@endsection
