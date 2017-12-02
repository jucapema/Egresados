@extends('administrador.AdminMain')
@section('mainheaders')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
@endsection
@section('recuadro')
        <div class="container">
          <div class="panel panel-default">
              <div class="panel-heading" align="center">Viendo Lista Usuarios  {{count($egresados)}}</div>
              <div class="panel-body">

                    <table class="table" id="users">
                      <thead>
                        <tr>
                          <th>DNI</th>
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>Email</th>
                          <th>Fecha Pidio Darse de Baja</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($egresados as $egresado)
                          <!-- boton para aceptar-->
                          @component('user.ModalConfirmar')
                            @slot('ruta')
                              {route('Egresado.state',['user'=>$user->id])}}
                            @endslot
                            @slot('idmodal')
                                modalEditar{{$egresado->user->id}}
                            @endslot
                            @slot('title')
                                  Agregar {{$egresado->user->name}}
                            @endslot
                            @slot('contenido')
                              Estas Seguro que deseas Agregar a {{$egresado->user->name}} Nuestra plataforma
                            @endslot
                          @endcomponent
                          <!-- boton para contactar-->
                          @component('user.ModalConfirmar')
                            @slot('ruta')
                              {route('Usuario.destroy',['user'=>$user->id])}}
                            @endslot
                            @slot('idmodal')
                                modalSend{{$egresado->user->id}}
                            @endslot
                            @slot('title')
                                  Rechazar Usuario {{$egresado->user->name}}
                            @endslot
                            @slot('contenido')
                                @component('notificaciones.ModalMensaje')
                                  @slot('correo')
                                    {{$egresado->user->email}}
                                  @endslot
                                @endcomponent
                            @endslot
                          @endcomponent
                        <tr>
                          <td>{{$egresado->user->dni}}</td>
                          <td>{{$egresado->user->name}}</td>
                          <td>{{$egresado->user->apellido}}</td>
                          <td>{{$egresado->user->email}}</td>
                          <td>{{$egresado->user->updated_at}}</td>
                          <td><button type='button' class='editar btn btn-danger' data-toggle='modal' data-target='#modalEditar{{$egresado->user->id}}'><i class="material-icons iconosmenu">delete_forever</i>
                            <button type='button' class='send btn btn-success' data-toggle='modal' data-target='#modalSend{{$egresado->user->id}}' ><i class="material-icons iconosmenu">send</i></button></td>
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
            obtener_id_send("#users tbody",table);
      });
var obtener_data_edit=function(tbody,table){
        $(tbody).on("click", "button.editar",function(){
          var data=table.row($(this).parents("tr")).data();
          var id=$("#frmEliminarUsuario #id").val(data.id),
            dni=$("#dni").val(data.dni),
            name=$("#name").val(data.name),
            email=$("#email").val(data.email),
            apellido=$("#apellido").val(data.apellido);
          //console.log(data);
        });
      }

      var obtener_id_send=function(tbody,table){
              $(tbody).on("click", "button.send",function(){
                  var data=table.row($(this).parents("tr")).data();
                  var id=$("#frmEliminarUsuario #id").val(data.id);
                  console.log(data);
              });
            }
      </script>

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @endsection
@endsection
