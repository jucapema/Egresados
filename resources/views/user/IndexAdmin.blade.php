<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<!-- CSRF Token -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
        <title>Laravel</title>

    </head>
    <body>
        <div class="container">
          <div class="panel panel-default">
              <div class="panel-heading" align="center">Viendo Administradores</div>
              <div class="form-group">

                <button type='button' class='agregar btn btn-success' data-toggle='modal' data-target='#modalAdd' ><i class="material-icons iconosmenu">add</i>New Admin</button>
                @component('modals.modal')
                  @slot('id')
                    modalAdd
                  @endslot
                  @slot('title')
                    Agregar
                  @endslot
                  @slot('cuerpo')
                      @component('administrador.CreateAdmin')
                      @endcomponent
                  @endslot
                  @slot('boton')
                    button.agregar
                  @endslot
                @endcomponent
              </div>
              <div class="panel-body">

                    <table class="table" id="users">
                      <thead>
                        <tr>
                          <th>DNI</th>
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>Email</th>
                          <th>Telefono</th>
                          <th>Direccion</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
                            @component('user.ModalFormEdit')
                              @slot('id')
                                {{$user->id}}
                              @endslot
                              @slot('idmodal')
                                  modalEditar{{$user->id}}
                              @endslot
                              @slot('title')
                                    Editar Informacion de {{$user->name}}
                              @endslot
                              @slot('contenido')
                                @component('administrador.EditAdmin')
                                  @slot('id')
                                    {{$user->id}}
                                  @endslot
                                @endcomponent
                              @endslot
                            @endcomponent
                          @component('user.ModalConfirmar')
                            @slot('ruta')
                              {{route('Usuario.destroy',['user'=>$user->id])}}
                            @endslot
                            @slot('idmodal')
                                modalEliminar{{$user->id}}
                            @endslot
                            @slot('title')
                                  Elimnari Usuario {{$user->name}}
                            @endslot
                            @slot('contenido')
                              Estas Seguro que deseas eliminar a {{$user->name}}
                            @endslot
                          @endcomponent
                        <tr>
                          <td>{{$user->dni}}</td>
                          <td>{{$user->name}}</td>
                          <td>{{$user->apellido}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->administrador->telefono}}</td>
                          <td>{{$user->administrador->direccion}}</td>
                          <td><button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar{{$user->id}}'><i class="material-icons iconosmenu">edit</i></button>	<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar{{$user->id}}' ><i class="material-icons iconosmenu">delete</i></button></td>
                        </tr>
                      @endforeach
                      </tbody>

                    </table>
                </div>

            </div>
        </div>
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
      });
var obtener_data_edit=function(tbody,table){
        $(tbody).on("click", "button.editar",function(){
          var data=table.row($(this).parents("tr")).data();
          var id=$("#frmEditarUsuario #id").val(data.id),
            dni=$("#dni").val(data.dni),
            name=$("#name").val(data.name),
            email=$("#email").val(data.email),
            apellido=$("#apellido").val(data.apellido);
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
      </script>

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
