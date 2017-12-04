@extends('administrador.AdminMain')
@section('mainheaders')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
@endsection
@section('recuadro')
<div style="overflow:scroll;height:450px;width:850px;">
              <div class="panel-heading" align="center">Viendo Egresados</div>
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

                          @component('user.ModalFormEdit')
                                 @slot('id')
                                   {{$egresado->user->id}}
                                 @endslot
                                 @slot('idmodal')
                                     modalSend{{$egresado->user->id}}
                                 @endslot
                                 @slot('title')
                                       Enviar email a {{$egresado->user->name}}
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
                          <td><button type='button' class='eliminar btn btn-success' data-toggle='modal' data-target='#modalEliminar{{$egresado->user->id}}' ><i class="material-icons iconosmenu">delete</i></button>
                          <button type='button' class='send btn btn-info' data-toggle='modal' data-target='#modalSend{{$egresado->user->id}}' ><i class="material-icons iconosmenu">email</i></button></td>

                          @component('user.ModalConfirmarAdd')
                            @slot('ruta')
                              {{route('borrar',['user'=>$egresado->user->id])}}
                            @endslot
                            @slot('idmodal')
                                modalEliminar{{$egresado->user->id}}
                            @endslot
                            @slot('title')
                                  Eliminar Usuario {{$egresado->user->name}}
                            @endslot
                            @slot('contenido')
                              Estas Seguro que deseas eliminar a {{$egresado->user->name}}
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
        <script type="text/javascript">

        $(document).ready(function(){
          var table= $("#users").DataTable({
              "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
              "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                      },
            });
            obtener_id_eliminar("#users tbody",table);
            obtener_id_state("#users tbody",table);
      });

      var obtener_id_eliminar=function(tbody,table){
              $(tbody).on("click", "button.eliminar",function(){
                var data=table.row($(this).parents("tr")).data();
                var id=$("#frmEliminarUsuario #id").val(data.id);
                console.log(data);
              });
            }
            var obtener_id_state=function(tbody,table){
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
