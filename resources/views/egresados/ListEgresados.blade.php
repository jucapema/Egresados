@extends('egresados.EgresadoMain')
@section('mainheaders')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
@endsection
@section('recuadro')
  <div>
          <div class="panelexterno panel-default gestionadmin scrollbar1">
              <div class="panel-heading" align="center">Gestión de Administradores</div>
              <div class="panel-body">
                    <table class="table tabladmin cell-border compact" id="users">
                      <thead>
                        <tr>
                          <th>Imagen</th>
                          <th>Nombre</th>
                          <th>Email</th>
                          <th>Genero</th>
                          <th>Intereses</th>
                          <th>Carrera</th>
                          <th>Contactar</th>
                          <th>Relacion</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
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
                              @slot('ruta')
                                {{route('agregar',['user'=>$user->id])}}
                              @endslot
                              @slot('idmodal')
                                  modalAgregar{{$user->id}}
                              @endslot
                              @slot('title')
                                    Agregar Contacto
                              @endslot
                              @slot('contenido')
                                Agregar a {{$user->name}} tu lista de amigos
                              @endslot
                            @endcomponent
                                  <tr id="columtable">
                           <td><img src="storage/images/1.jpg" alt="" style="width:50px;"></td>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->egresado->genero}}</td>
                          <td>{{$user->egresado->intereses}}</td>
                          <td>{{$user->egresado->carrera}}</td>
                          <td><button class="contactar btn btn-primary" data-toggle='modal' data-target='#modalSend{{$user->id}}'> <i class="material-icons iconosmenu">email</i> </button></td>
  @php
    $favoritos=App\Models\Favorito::where('id_usuario',auth::user()->id)->where('amigo',$user->id)->get();
  @endphp
@if (count($favoritos)>0)
  <td><button class="contactar btn btn-danger" data-toggle='modal' data-target='#modalDelete{{$user->id}}'> <i class="material-icons iconosmenu">highlight_off</i> </button></td>
@else
  <td><button class="add btn btn-primary" data-toggle='modal' data-target='#modalAgregar{{$user->id}}'> <i class="material-icons iconosmenu">person_add</i> </button></td>
@endif
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
        var obtener_data_add=function(tbody,table){
                $(tbody).on("click", "button.add",function(){
                  var data=table.row($(this).parents("tr")).data();
                  var id=$("#frmEliminarUsuario #id").val(data.id);
                  //console.log(data);
                });
      }

      </script>

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @endsection
@endsection
