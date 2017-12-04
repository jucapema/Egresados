@extends('egresados.EgresadoMain')
@section('mainheaders')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
@endsection
@section('recuadro')
  <div style="overflow:scroll;height:450px;width:800px;">
          <div class="panel panel-default">
              <div class="panel-heading" align="center">Notificaciones Pendientes {{count($notificaciones)}}</div>
              <div class="panel-body">

                    <table class="table" id="users">
                      <thead>
                        <tr>
                          <th>Tipo</th>
                          <th>Informacion</th>
                          <th>Hora</th>
                          <th>Ver</th>
                          <th>Marcar como vista</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($notificaciones as $notificacion)
                          @component('modals.modal')
                            @slot('id')
                              modalAdd{{$notificacion->id}}
                            @endslot
                            @slot('title')
                              Visualisando Notificaciones
                            @endslot
                            @slot('cuerpo')
                              @component('notificaciones.ver')
                                @slot('id')
                                  {{$notificacion->id}}
                                @endslot
                              @endcomponent
                            @endslot
                            @slot('boton')
                              button.ver
                            @endslot
                          @endcomponent
                        <tr>
                          @if ($notificacion->tipo=='post')
                            @php
                              $publicacion=\App\Models\Publicacion::findorfail($notificacion->id_tipo);
                            @endphp
                              <td>Publicacion Pendiente</td>
                              <td>{{$publicacion->titulo}} {{$publicacion->cuerpo}}</td>
                              <td>{{$notificacion->created_at->diffForHumans()}}</td>
                            @endif
                          @if ($notificacion->tipo=='mensaje')
                            @php
                              $mensaje=\App\Models\Mensaje::findorfail($notificacion->id_tipo);
                              $user=\App\User::findorfail($mensaje->send_id);
                            @endphp
                            <td>Mensaje Pendiente</td>
                            <td>{{$mensaje->title}} de: {{$user->name}}</td>
                            <td>{{$notificacion->created_at->diffForHumans()}}</td>
                            @endif
                            @if($notificacion->tipo=='ban')
                              <td>Cuenta Banneada</td>
                              <td>Su cuenta ha sido Suspendida</td>
                              <td>{{$notificacion->created_at->diffForHumans()}}</td>
                          @endif

                          <td><button type='button' class='ver btn btn-success' data-toggle='modal' data-target='#modalAdd{{$notificacion->id}}' ><i class="material-icons iconosmenu">pageview</i></button></td>
                          <td><button class="contactar btn btn-primary" data-toggle='modal' data-target='#modalBorrar{{$notificacion->id}}'> <i class="material-icons iconosmenu">visibility_off</i> </button>
@if ($notificacion->tipo=='mensaje')
  @component('user.ModalConfirmarAdd')
    @slot('ruta')
      {{route('agregar',['user'=>$user->id])}}
    @endslot
    @slot('idmodal')
        modalAgregar{{$user->id}}
    @endslot
    @slot('title')
          Agregar Contacto {{$user->name}}
    @endslot
    @slot('contenido')
      Has recibido un Mensaje de {{$user->name}} añadir a tu lista de amigos
    @endslot
  @endcomponent
  <button class="add btn btn-primary" data-toggle='modal' data-target='#modalAgregar{{$user->id}}'> <i class="material-icons iconosmenu">person_add</i> </button>
@endif
@component('user.ModalConfirmar')
  @slot('ruta')
    {{route('Notificacion.destroy',['notificaciones'=>$notificacion->id])}}
  @endslot
  @slot('idmodal')
    modalBorrar{{$notificacion->id}}
  @endslot
  @slot('title')
        Dejar de ver esta notificacion
  @endslot
  @slot('contenido')
    Marcar Notificacion como vista
  @endslot
@endcomponent

                          </td>
                        </tr>
                      @endforeach
                      </tbody>

                    </table>
                </div>
</div>
            </div>

        @section('mainmodals')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script>

        $(document).ready(function(){

var table= $("#users").DataTable({
              "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
              "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                      },
            });
            obtener_data_edit("#users tbody",table);

      });
var obtener_data_edit=function(tbody,table){
        $(tbody).on("click", "button.contactar",function(){
          var data=table.row($(this).parents("tr")).data();
          var id=$("#frmEditarUsuario #id").val(data.id);
          $(this).addClass(tbody);
          //console.log(data);
        });
}
      </script>

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @endsection
@endsection
