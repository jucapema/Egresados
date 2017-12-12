@extends('administrador.AdminMain')
@section('mainheaders')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
@endsection
@section('recuadro')

        <div>
          <div class="panelexterno panel-default gestionegresados scrollbar1">
            <div class="panel-heading" align="center">Registro de Actividad (Egresados)</div>
            <div class="panel-body">
                <table class="table tabladmin cell-border compact" id="users">
                  <thead>
                    <tr>
                       <th>DNI</th>
                       <th>Nombre</th>
                       <th>Apellido</th>
                       <th>Fecha Ultimo Acceso</th>
                       <th>Mensaje</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($accesos as $acceso)
@if ($acceso->user->tipo_rol!='root')


                      @component('user.ModalFormEdit')
                             @slot('id')
                               {{$acceso->user->id}}
                             @endslot
                             @slot('idmodal')
                                 modalSend{{$acceso->user->id}}
                             @endslot
                             @slot('title')
                                   Enviar email a {{$acceso->user->name}}
                             @endslot
                             @slot('contenido')
                               @component('notificaciones.ModalMensaje')
                                 @slot('correo')
                                   {{$acceso->user->email}}
                                 @endslot
                               @endcomponent
                             @endslot
                         @endcomponent
                      <tr id="columtable">
                          <td>{{$acceso->user->dni}}</td>
                          <td>{{$acceso->user->name}}</td>
                          <td>{{$acceso->user->apellido}}</td>
                          <td>{{$acceso->created_at}}</td>
                          <td align="center"> <button type="button" class='send btn btn-circle coloredit' data-toggle='modal' data-target='#modalSend{{$acceso->user->id}}' ><i class="material-icons">email</i></button></td>
                      </tr>
                    @endif
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
<script type="text/javascript">

$(document).ready(function(){
  var table= $("#users").DataTable({
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
              },
    });

    obtener_id_state("#users tbody",table);
});


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
