@extends('administrador.AdminMain')
@section('mainheaders')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
@endsection
@section('recuadro')

        <div>
          <div class="panelexterno panel-default cuentasegresados scrollbar1">
            <div class="panel-heading" align="center">Cuentas de Egresados</div>
            <div class="form-group">
              <button type='button' class='agregar btn boton1' data-toggle='modal' data-target='#modalAdd' ><i class="material-icons iconosmenu">add_circle</i> New Egresado</button>
              @component('modals.modal')
                @slot('id')
                  modalAdd
                @endslot
                @slot('title')
                  Agregar
                @endslot
                @slot('cuerpo')
                    @component('egresados.CreateEgresado')
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
                        <th>Intereses</th>
                        <th>Edad</th>
                        <th>Genero</th>
                        <th>Estado Cuenta</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>Bannear</th>
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
                        @component('user.ModalConfirmarAdd')
                          @slot('ruta')
                            {{route('bannear',['user'=>$user->id])}}
                          @endslot
                          @slot('idmodal')
                              modalState{{$user->id}}
                          @endslot
                          @slot('title')
                                Cambiar el estado del usuario {{$user->name}}
                          @endslot
                          @slot('contenido')
                            ¿Estas Seguro de Cambiar el estado de la cuenta {{$user->name}} a Banneado?
                            {{auth::user()->name}}
                          @endslot
                        @endcomponent
                        @php
                          $edad = Carbon\Carbon::parse($user->egresado->fecha_nacimiento)->age;
                        @endphp
                      <tr id="columtable">
                        <td>{{$user->dni}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->apellido}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->egresado->intereses}}</td>
                        <td>{{$edad}}</td>
                        <td>{{$user->egresado->genero}}</td>
                        <td>{{$user->estado_cuenta}}</td>
                        <td align="center"><button type='button' class='editar btn btn-circle coloredit' data-toggle='modal' data-target='#modalEditar{{$user->id}}'><i class="material-icons">edit</i></button></td>	
                        <td align="center"><button type='button' class='eliminar btn-circle colordelete' data-toggle='modal' data-target='#modalEliminar{{$user->id}}' ><i class="material-icons">delete</i></button>
                        @component('user.ModalConfirmar')
                          @slot('ruta')
                            {{route('Usuario.destroy',['user'=>$user->id])}}
                          @endslot
                          @slot('idmodal')
                              modalEliminar{{$user->id}}
                          @endslot
                          @slot('title')
                                Eliminar Usuario {{$user->name}}
                          @endslot
                          @slot('contenido')
                            Estas Seguro que deseas eliminar a {{$user->name}}
                          @endslot
                        @endcomponent</td>
                        <td align="center"><button type='button' class='state btn colorbannear' data-toggle='modal' data-target='#modalState{{$user->id}}' ><i class="material-icons">update</i>State</button></td>
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
        <script type="text/javascript">

        $(document).ready(function(){
          var table= $("#users").DataTable({
              "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
              "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                      },
            });
            obtener_data_edit("#users tbody",table);
            obtener_id_eliminar("#users tbody",table);
            obtener_id_state("#users tbody",table);
      });

      var obtener_data_edit=function(tbody,table){
        $(tbody).on("click", "button.editar",function(){
          var data=table.row($(this).parents("tr")).data();
          var id=$("#frmEditarUsuario #id").val(data.id);
          });
        }


      var obtener_id_eliminar=function(tbody,table){
              $(tbody).on("click", "button.eliminar",function(){
                var data=table.row($(this).parents("tr")).data();
                var id=$("#frmEliminarUsuario #id").val(data.id);
                console.log(data);
              });
            }
            var obtener_id_state=function(tbody,table){
                    $(tbody).on("click", "button.state",function(){
                        var data=table.row($(this).parents("tr")).data();
                        var id=$("#frmEliminarUsuario #id").val(data.id);
                        console.log(data);
                    });
                  }
      </script>

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @endsection
@endsection
