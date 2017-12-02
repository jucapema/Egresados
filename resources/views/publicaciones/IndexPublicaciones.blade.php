@extends('administrador.AdminMain')
@section('mainheaders')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
@endsection
@section('recuadro')
        <div class="container">
          <div class="panel panel-default">
              <div class="panel-heading" align="center">Publicaciones</div>
              <div class="form-group">

                <button type='button' class='agregar btn btn-success' data-toggle='modal' data-target='#modalAdd' ><i class="material-icons iconosmenu">add</i>Publicar Contenido</button>
                @component('modals.modal')
                  @slot('id')
                    modalAdd
                  @endslot
                  @slot('title')
                    <a ><i class="material-icons iconosmenu">insert_invitation</i>Agregar Nueva Publicacion </a>
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

                    <table class="table" id="users">
                      <thead>
                        <tr>
                          <th>Image</th>
                          <th>Titulo</th>
                          <th>Contenido</th>
                          <th>Fecha del Evento</th>
                          <th>Publicado Por</th>
                          <th>Actualizado el</th>
                          <th>Publicado el</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($publicaciones as $publicacion)
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
                        @component('user.ModalConfirmar')
                          @slot('ruta')
                            {{route('Publicacion.destroy',['post'=>$publicacion->id])}}
                          @endslot
                          @slot('idmodal')
                              modalEliminar{{$publicacion->id}}
                          @endslot
                          @slot('title')
                                Elimninar publicacion:  {{$publicacion->titulo}}
                          @endslot
                          @slot('contenido')
                            Estas Seguro que deseas eliminar a {{$publicacion->titulo}}
                          @endslot
                        @endcomponent
                        <tr>
                          <td><img src="/storage/images/{{$publicacion->multimedia}}" alt="" style="width:50px;"></td>
                          <td>{{$publicacion->titulo}}</td>
                          <td>{{$publicacion->cuerpo}}</td>
                          <td>{{$publicacion->fecha}}</td>
                          <td>{{$publicacion->administrador->user->name}}</td>
                          <td>{{$publicacion->update_at}}</td>
                          <td>{{$publicacion->created_at->diffForHumans()}}</td>
                          <td><button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar{{$publicacion->id}}'><i class="material-icons iconosmenu">edit</i></button>	<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar{{$publicacion->id}}' ><i class="material-icons iconosmenu">delete</i></button></td>
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
            obtener_id_eliminar("#users tbody",table);
      });
var obtener_data_edit=function(tbody,table){
        $(tbody).on("click", "button.editar",function(){
          var data=table.row($(this).parents("tr")).data();
          var id=$("#frmEditarUsuario #id").val(data.id);
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
    @endsection
@endsection
