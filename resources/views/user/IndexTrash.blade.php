@extends('root.RootMain')

@section('mainheaders')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
@endsection
@section('recuadro')

        <div>
          <div class="panelexterno panel-default gestionadmin scrollbar1">
              <div class="panel-heading" align="center">Usuarios Eliminados [{{count($users)}}]</div>
              <div class="panel-body">
                <table class="table tabladmin cell-border compact" id="users"" id="users">
                  <thead>
                    <tr>
                      <th>DNI</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Rol</th>
                      <th>Email</th>
                      <th>Fecha Elminacion</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                      <!-- boton para aceptar-->

                    <tr id="columtable">
                      <td>{{$user->dni}}</td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->apellido}}</td>
                      <td>{{{$user->tipo_rol}}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->deleted_at->diffForHumans()}}</td>
                      <td align="center"><button class="contactar btn btn-circle colorrestaurar" data-toggle='modal' data-target='#modalBorrar{{$user->id}}'> <i class="material-icons">restore</i></button>
                      @component('user.ModalConfirmarAdd')
                        @slot('ruta')
                          {{route('restore',['user'=>$user->id])}}
                        @endslot
                        @slot('idmodal')
                            modalBorrar{{$user->id}}
                        @endslot
                        @slot('title')
                              Agregar {{$user->name}}
                        @endslot
                        @slot('contenido')
                          Estas Seguro que deseas Restarurar a {{$user->name}} Nuestra plataforma
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
