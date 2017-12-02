@if(count($errors)>0)
        <div class="alert alert-warning" role="alert">
           @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
              <script type="text/javascript">
                  alert("{{ $error }}");
              </script>
          @endforeach
        </div>
    @endif </br>

{!!Form::open(['route'=>['Usuario.update', 'User' => auth::user()->id], 'method'=>'POST'])!!}
{{method_field('put')}}
  {{csrf_field()}}

              <div class="panel panel-default">
                  <div class="panel-heading">Hola {{auth::user()->name}}</div>
                    <div class="panel-body">
    <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('DNI: ')!!}<br>
    {!!form::text('dni',auth::user()->dni,['class'=>'col-lx-6 col-md-6', 'placeholder'=>'your cc','autofocus required'])!!}
  @if ($errors->has('dni'))
      <span class="help-block">
          <strong>{{ $errors->first('dni') }}</strong>
      </span>
  @endif</div>
  <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Nombre: ')!!}<br>
    {!!form::text('name',auth::user()->name,['class'=>'form group col-lx-6 col-md-6', 'placeholder'=>'your name','autofocus required'])!!}
  @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif</div><div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Apellidos: ')!!}<br>
    {!!form::text('apellido',auth::user()->apellido,['class'=>'form group col-lx-6 col-md-6','placeholder'=>'your lastname','autofocus required'])!!}
  @if ($errors->has('apellido'))
        <span class="help-block">
            <strong>{{ $errors->first('apellido') }}</strong>
        </span>
    @endif</div><div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Email: ')!!}<br>
    {!!form::email('email',auth::user()->email,['class'=>'form group col-lx-6 col-md-6','placeholder'=>'nombre@mozilla.com','autofocus required'])!!}
  @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
    @if (auth::user()->tipo_rol=='admin')
              </div><div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
              {!!form::label('Telefono: ')!!}<br>
              {!!form::tel('telefono',auth::user()->administrador->telefono,['class'=>'form group col-lx-6 col-md-6','minlenght'=>'7','autofocus required'])!!}
            @if ($errors->has('telefono'))
                <span class="help-block">
                    <strong>{{ $errors->first('telefono') }}</strong>
                </span>
            @endif</div>  <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
              {!!form::label('Direccion: ')!!}<br>
              {!!form::text('direccion',auth::user()->administrador->direccion,['class'=>'form group col-lx-6 col-md-6','autofocus required']) !!}<br>
            @if ($errors->has('direccion'))
                  <span class="help-block">
                      <strong>{{ $errors->first('direccion') }}</strong>
                  </span>
              @endif</div><div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
              {!!form::label('Ciudad: ')!!}<br>
              {!!form::text('ciudad',auth::user()->administrador->ciudad,['class'=>'form group col-lx-6 col-md-6','autofocus required'])!!}<br>
            @if ($errors->has('ciudad'))
                          <span class="help-block">
                              <strong>{{ $errors->first('ciudad') }}</strong>
                          </span>
                      @endif</div>
    @endif
    @if (auth::user()->tipo_rol=='egresado')
                </div><div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
                {!!form::label('Fecha de Nacimiento: ')!!}<br>
                {!!form::date('fecha_nacimiento',auth::user()->egresado->fecha_nacimiento,['class'=>'form group col-lx-6 col-md-6','minlenght'=>'7','placeholder'=>'your numberphone','autofocus required'])!!}
                @if ($errors->has('fecha_nacimiento'))
                  <span class="help-block">
                      <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                  </span>
                @endif</div>
                <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
                {!!form::label('Intereses: ')!!}<br>
                {!!form::select('intereses',['deportes'=>'Deportes'],auth::user()->egresado->intereses,['class'=>'form group col-lx-6 col-md-6','autofocus required'])!!}
                @if ($errors->has('intereses'))
                <span class="help-block">
                    <strong>{{ $errors->first('intereses') }}</strong>
                </span>
                @endif</div>
                <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
                {!!form::label('Genero: ')!!}<br>
                {!!form::select('genero',['masculino'=>'Masculino','femenino'=>'Femenino'],auth::user()->egresado->genero,['class'=>'form group col-lx-6 col-md-6','autofocus required'])!!}
                @if ($errors->has('genero'))
                <span class="help-block">
                  <strong>{{ $errors->first('genero') }}</strong>
                </span>
                @endif</div>
    @endif
          </div>
          {!!form::submit('Registrar',['class'=>'btn btn-primary'])!!}
          {!!form::close()!!}
        </div>
</div>
