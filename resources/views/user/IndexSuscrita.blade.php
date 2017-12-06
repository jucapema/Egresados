@extends('administrador.AdminMain')
@section('mainheaders')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
@endsection
@section('recuadro')

      <div>
        <div class="panelexterno panel-default gestionegresados scrollbar1">
          <div class="panel-heading" align="center">Lista de Suscriptores [{{count($users)}}]</div>
              <div class="panel-body">
                  <table class="table tabladmin cell-border compact" id="users">
                    <thead>
                      <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Edad</th>
                        <th>Fecha de Registro</th>
                        <th>Aceptar</th>
                        <th>Eliminar</th>
                        <th>Contactar</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $user)
                      @php $edad=\Carbon\Carbon::parse($user->egresado->fecha_nacimiento)->age; @endphp
                        <!-- boton para contactar-->
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

                        
                      <tr id="columtable">
                        <td>{{$user->dni}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->apellido}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$edad}}</td>
                        <td>{{$user->created_at}}</td>
                        <td align="center"><button type='button' class='editar btn btn-circle coloredit' data-toggle='modal' data-target='#modalEditar{{$user->id}}'><i class="material-icons">done_all</i></button></td>
                        <td align="center"><button type='button' class='eliminar btn btn-circle colordelete' data-toggle='modal' data-target='#modalEliminar{{$user->id}}' ><i class="material-icons">delete_forever</i></button></td>
                        <td align="center"><button type='button' class='send btn btn-circle colorrestaurar' data-toggle='modal' data-target='#modalSend{{$user->id}}' ><i class="material-icons">send</i></button></td>
                          <!-- boton para aceptar-->
                          @component('user.ModalConfirmarAdd')
                            @slot('ruta')
                              {{route('agregar',['user'=>$user->id])}}
                            @endslot
                            @slot('idmodal')
                                modalEditar{{$user->id}}
                            @endslot
                            @slot('title')
                                  Agregar {{$user->name}}
                            @endslot
                            @slot('contenido')
                              Estas Seguro que deseas Agregar a {{$user->name}} Nuestra plataforma
                            @endslot
                          @endcomponent
                          <!-- boton para rechazar-->
                          @component('user.ModalConfirmar')
                            @slot('ruta')
                              {{route('Usuario.destroy',['user'=>$user->id])}}
                            @endslot
                            @slot('idmodal')
                                modalEliminar{{$user->id}}
                            @endslot
                            @slot('title')
                                  Rechazar Usuario {{$user->name}}
                            @endslot
                            @slot('contenido')
                              Estas Seguro que deseas Rechazar a {{$user->name}}
                            @endslot
                          @endcomponent
                      </tr>
                    @endforeach
                    </tbody>

                  </table>
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
            obtener_id_eliminar("#users tbody",table);
            obtener_id_send("#users tbody",table);
      });
var obtener_data_edit=function(tbody,table){
        $(tbody).on("click", "button.editar",function(){
          var data=table.row($(this).parents("tr")).data();
          var id=$("#frmEliminarUsuario #id").val(data.id),;
          //console.log(data);
        });
      }

      var obtener_id_eliminar=function(tbody,table){
              $(tbody).on("click", "button.eliminar",function(){
                var data=table.row($(this).parents("tr")).data();
                var id=$("#frmEliminarUsuario #id").val(data.id);
                console.log(data);
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
