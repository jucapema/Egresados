@extends('egresados.EgresadoMain')
@section('mainheaders')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
  @endsection
@section('recuadro')
  <div>
          <div class="panelexterno panel-default gestionadmin scrollbar1">
              <div class="panel-heading" align="center">Gestión de Administradores</div>
              <div class="panel-body">
                    <table class="table tabladmin cell-border compact" id="users">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Titulo</th>
                          <th>Contenido</th>
                          <th>Fecha del evento</th>
                          <th>Publicado</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($publicaciones as $publicacion)
                            <tr id="columtable">
        <td><img src="/storage/images/1.jpg" alt="" style="width:70px;"></td>
        <td>{{$publicacion->titulo}}  </td>
          <td>{{$publicacion->cuerpo}}    </td>
          <td>{{$publicacion->fecha}}</td>
          <td>{{$publicacion->created_at->diffForHumans()}} by
            @if ($publicacion->administrador!=null)
              {{$publicacion->administrador->user->name}}
              @else
                Administrador no disponible
            @endif
        </td>
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

<script type="text/javascript">
$(document).ready(function(){
var table= $("#users").DataTable({
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
              },
    });
});
</script>
  @endsection
@endsection
