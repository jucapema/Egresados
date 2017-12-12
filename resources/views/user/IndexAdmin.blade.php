@extends('root.RootMain')

@section('mainheaders')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
@endsection

@section('recuadro')


<!-- CSRF Token -->
        <div>
          <div class="panelexterno panel-default gestionadmin scrollbar1">
              <div class="panel-heading" align="center">Gestión de Administradores</div>
              <div class="form-group">
                <button type='button' class='agregar btn boton1' data-toggle='modal' data-target='#modalAdd' ><i class="material-icons iconosmenu">add</i>
                Nuevo Administrador</button>
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
                    <table class="table tabladmin cell-border compact" id="users">
                      <thead>
                        <tr>
                          <th>DNI</th>
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>Email</th>
                          <th>Telefono</th>
                          <th>Direccion</th>
                          <th>Editar</th>
                          <th>Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)

                          <!-- why dont works fine-->
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
                        <tr id="columtable">
                          <td>{{$user->dni}}</td>
                          <td>{{$user->name}}</td>
                          <td>{{$user->apellido}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->administrador->telefono}}</td>
                          <td>{{$user->administrador->direccion}}</td>
                          <td align="center"><button type='button' class='editar btn btn-circle coloredit' data-toggle='modal' data-target='#modalEditar{{$user->id}}'><i class="material-icons">edit</i></button></td>
                            <td align="center"><button class="contactar btn btn-circle colordelete" data-toggle='modal' data-target='#modalBorrar{{$user->id}}'> <i class="material-icons">delete</i> </button>
                            @component('user.ModalConfirmar')
                              @slot('ruta')
                                {{route('Usuario.destroy',['user'=>$user->id])}}
                              @endslot
                              @slot('idmodal')
                                modalBorrar{{$user->id}}
                              @endslot
                              @slot('title')
                                    Eliminar administrador {{$user->name}} {{$user->apellido}}
                              @endslot
                              @slot('contenido')
                                Eliminar Usuario {{$user->name}}
                              @endslot
                            @endcomponent
                        </td></tr>

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
            obtener_id_eliminar("#users tbody",table);
      });

var obtener_data_edit=function(tbody,table){
        $(tbody).on("click", "button.editar",function(){
          var data=table.row($(this).parents("tr")).data();
          var id=$("#frmEditarUsuario #id").val(data.id);
          //console.log(data);
        });
      }

      var obtener_data_eliminar=function(tbody,table){
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
