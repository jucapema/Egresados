@extends('administrador.AdminMain')
@section('mainheaders')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
@endsection
@section('recuadro')
        <div>
          <div class="panelexterno panel-default gestionegresados scrollbar1">
              <div class="panel-heading" align="center">Notificaciones Pendientes 
              [{{count($publicaciones)}}]</div>
                <div class="form-group">
                <button type='button' class='agregar btn boton1' data-toggle='modal' data-target='#modalAdd' ><i class="material-icons iconosmenu">add</i>Publicar Contenido</button>
                             @component('modals.modal')
                               @slot('id')
                                 modalAdd
                               @endslot
                               @slot('title')
                                 Agregar Nueva Publicacion
                               @endslot
                               @slot('cuerpo')
                                   @component('publicaciones.CreatePublicacion')
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
                            <th>Imagen</th>
                           <th>Titulo</th>
                           <th>Contenido</th>
                           <th>Fecha Evento</th>
                           <th>Publicado Por</th>
                           <th>Publicado</th>
                          <th>Editar</th>
                          <th>Eliminar</th>
                          </tr>
                        </thead>
                      <tbody>
                        @foreach ($publicaciones as $publicacion)
                          @component('user.ModalFormEdit')
                              @slot('id')
                                {{$publicacion->id}}
                              @endslot
                              @slot('idmodal')
                                  modalEditar{{$publicacion->id}}
                              @endslot
                              @slot('title')
                                    Editar Informacion de {{$publicacion->titulo}}
                              @endslot
                              @slot('contenido')
                                @component('publicaciones.EditPublicacion')
                                  @slot('id')
                                    {{$publicacion->id}}
                                  @endslot
                                @endcomponent
                              @endslot
                            @endcomponent
                        <tr id="columtable">
                          @if ($publicacion->multimedia!=null)
                          <td><img src="/storage/images/{{$publicacion->multimedia}}" alt="" style="width:70px;"></td>
                          @else
                          <td><img src="https://image.ibb.co/cAeb5G/Publicaciones.png" alt="" style="width:70px;"></td>
                          @endif
                           <td>{{$publicacion->titulo}}</td>
                           <td>{{$publicacion->cuerpo}}</td>
                           <td>{{$publicacion->fecha}}</td>
                           @if ($publicacion->administrador!=null)
                             <td>{{$publicacion->administrador->user->name}}</td>
                           @else
                               <td>Administrador Desconocido</td>
                           @endif

                           <td>{{$publicacion->created_at->diffForHumans()}}</td>

                          <td align="center"><button type='button' class='editar btn btn-circle coloredit' data-toggle='modal' data-target='#modalEditar{{$publicacion->id}}' ><i class="material-icons">edit</i></button></td>
                          <td align="center"><button class="contactar btn-circle colordelete" data-toggle='modal' data-target='#modalBorrar{{$publicacion->id}}'> <i class="material-icons">delete_forever</i> </button>
                          @component('user.ModalConfirmar')
                            @slot('ruta')
                              {{route('Publicacion.destroy',['Publicacion'=>$publicacion->id])}}
                            @endslot
                            @slot('idmodal')
                              modalBorrar{{$publicacion->id}}
                            @endslot
                            @slot('title')
                              Eliminar publicacion
                            @endslot
                            @slot('contenido')
                              Seguro de Eliminar esta Publicacion
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
            obtener_data_info("#users tbody",table);

      });
var obtener_data_edit=function(tbody,table){
        $(tbody).on("click", "button.contactar",function(){
          var data=table.row($(this).parents("tr")).data();
          var id=$("#frmEditarUsuario #id").val(data.id);
          $(this).addClass(tbody);
          //console.log(data);
        });
}


var obtener_data_info=function(tbody,table){
        $(tbody).on("click", "button.editar",function(){
          var data=table.row($(this).parents("tr")).data();
          var id=$("#frmEditarUsuario #id").val(data.id);
          //console.log(data);
        });
      }
      </script>

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @endsection
@endsection
