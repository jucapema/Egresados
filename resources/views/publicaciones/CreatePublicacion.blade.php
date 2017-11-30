@extends('layouts.app')

@section('titulo')

@endsection


@section('content')
  @if(Session::has('flash_message'))
    <script type="text/javascript">
    alert("{{Session::get('flash_message')}}");
    </script>
  @endif

  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Publicar Actividad</div>
          {!!Form::open(['route'=> 'Publicacion.store', 'method'=>'POST'])!!}
          {{ method_field('PUT') }}
          {{csrf_field()}}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
            {!!form::label('Titulo: ')!!}<br>
            {!!form::text('titulo',null,['class'=>'col-lx-12 col-md-12', 'autofocus required'])!!}
            @if ($errors->has('titulo'))
              <span class="help-block">
                <strong>{{ $errors->first('titulo') }}</strong>
              </span>
            @endif</div>
            <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
              {!!form::label('Cuerpo: ')!!}<br>
              {!!form::textarea('cuerpo',null,['class'=>'form group col-lx-12 col-md-12', 'autofocus required'])!!}
              @if ($errors->has('cuerpo'))
                <span class="help-block">
                  <strong>{{ $errors->first('cuerpo') }}</strong>
                </span>
              @endif        </div>
              <div class="form-group">
                {!!form::submit('Registrar',['class'=>'btn btn-primary'])!!}
                {!!form::reset('Cancelar',['class'=>'btn btn-boton'])!!}
              </div>
              {!!form::close()!!}
            </div>
          </div>
        </div>
      </div>

    @endsection
