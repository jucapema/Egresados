@extends('egresados.EgresadoMain')
@section('mainheaders')

@endsection
@section('recuadro')
  <div style="overflow:scroll;height:400px;width:800px;">
  @foreach ($publicaciones as $publicacion)

       <div class="panel panel-default">
         <div class="panel-body">
<div class="row">
  <div class="col-sm-6 col-md-10">
    <div class="thumbnail">
      <div class="form-group">
      <p>
          <button type='button' class='favoritos btn btn-primary' data-toggle='modal' data-target='#modalFavorito{{$publicacion->id}}' ><i class="material-icons iconosmenu">favorite_border</i></button>
      </p>


        @component('modals.modal')
          @slot('id')
            modalFavorito{{$publicacion->id}}
          @endslot
          @slot('title')
            Agregar A Favoritos
          @endslot
          @slot('cuerpo')
              Agregar a Favoritos {{$publicacion->titulo}}
          @endslot
          @slot('boton')
            button.favoritos
          @endslot
        @endcomponent

      </div>

      <img src="/storage/images/1.jpg" alt="" style="width:70px;">
      <div class="caption">
        <h3>Título {{$publicacion->titulo}}</h3>
        <p>Contenido {{$publicacion->cuerpo}}</p>
        <p>Fecha del Evento {{$publicacion->fecha}}</p>
        <p>Publicado  {{$publicacion->created_at->diffForHumans()}} by
          @if ($publicacion->administrador!=null)
            {{$publicacion->administrador->user->name}}</p>
            @else
              Administrador no disponible</p>
          @endif

      </div>
    </div>
  </div>
</div>
</div>
</div>

@endforeach
</div>


@endsection
