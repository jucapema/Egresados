<script>
function ValidarImagen(obj){
    var uploadFile = obj.files[0];

    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg)$/i).test(uploadFile.name)) {  //expresion regular va aca
        alert('Error al adjuntar el archivo');
    }
    /*else {
        var img = new Image();
        img.onload = function () {
            if (this.width.toFixed(0) != 200 && this.height.toFixed(0) != 200) {
                alert('Las medidas deben ser: 200 * 200');
            }
            else if (uploadFile.size > 20000)
            {
                alert('El peso de la imagen no puede exceder los 200kb')
            }
            else {
                alert('Imagen correcta :)')
            }
        };*/
        img.src = URL.createObjectURL(uploadFile);
    }
        </script>
        @php
          $publicacion = App\Models\Publicacion::findOrFail($id);
        @endphp
<div class="panel panel-default">
  <div class="panel-body">
            {!!Form::open(['route'=>['Publicacion.update','publicacion'=>$publicacion->id], 'method'=>'POST', 'enctype'=>"multipart/form-data"])!!}
{{method_field('put')}}
            {{csrf_field()}}
                            <div class="panel-heading">Formulario para administrador</div>
              <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
              {!!form::label('Titulo: ')!!}<br>
              {!!form::text('titulo',$publicacion->titulo,['class'=>'col-lx-6 col-md-6','autofocus required'])!!}
            @if ($errors->has('titulo'))
                <span class="help-block">
                    <strong>{{ $errors->first('titulo') }}</strong>
                </span>
            @endif</div>
            <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
              {!!form::label('Contenido: ')!!}<br>
              {!!form::textarea('cuerpo',$publicacion->cuerpo,['class'=>'form group col-lx-6 col-md-6', 'autofocus required'])!!}
            @if ($errors->has('cuerpo'))
                  <span class="help-block">
                      <strong>{{ $errors->first('cuerpo') }}</strong>
                  </span>
              @endif</div>
              <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
                {!!form::label('Fecha del evento: ')!!}<br>
                {!!form::date('fecha',$publicacion->fecha,['class'=>'form group col-lx-6 col-md-6', 'autofocus required'])!!}
              @if ($errors->has('fecha'))
                    <span class="help-block">
                        <strong>{{ $errors->first('fecha') }}</strong>
                    </span>
                @endif</div>
                <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
                  {!!form::label('Cargar Archivos: ')!!}<br>
                  {!!form::file('file',old('file'),['class'=>'form group col-lx-6 col-md-6', 'autofocus required'])!!}
                @if ($errors->has('file'))
                      <span class="help-block">
                          <strong>{{ $errors->first('file') }}</strong>
                      </span>
                  @endif</div>
                    {!!form::submit('Registrar',['class'=>'btn btn-primary'])!!}
                    {!!form::reset('Cancelar',['class'=>'btn btn-boton'])!!}
                    {!!form::close()!!}
                  </div>
                  </div>
