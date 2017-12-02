
{!!Form::open(['route'=>['Egresado.store'], 'method'=>'POST'])!!}
  {{csrf_field()}}
              <div class="panel panel-default">
                  <div class="panel-heading">Formulario para egresados</div>
                    <div class="panel-body">
    <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('DNI: ')!!}<br>
    {!!form::text('dni',old('dni'),['class'=>'col-lx-6 col-md-6', 'placeholder'=>'your cc','autofocus required'])!!}
  @if ($errors->has('dni'))
      <span class="help-block">
          <strong>{{ $errors->first('dni') }}</strong>
      </span>
  @endif</div>
  <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Nombre: ')!!}<br>
    {!!form::text('name',old('name'),['class'=>'form group col-lx-6 col-md-6', 'placeholder'=>'your name','autofocus required'])!!}
  @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif</div><div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Apellidos: ')!!}<br>
    {!!form::text('apellido',old('apellido'),['class'=>'form group col-lx-6 col-md-6','placeholder'=>'your lastname','autofocus required'])!!}
  @if ($errors->has('apellido'))
        <span class="help-block">
            <strong>{{ $errors->first('apellido') }}</strong>
        </span>
    @endif</div><div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Email: ')!!}<br>
    {!!form::email('email',old('email'),['class'=>'form group col-lx-6 col-md-6','placeholder'=>'nombre@mozilla.com','autofocus required'])!!}
  @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif</div><div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Fecha de Nacimiento: ')!!}<br>
    {!!form::date('fecha_nacimiento',old('fecha_nacimiento'),['class'=>'form group col-lx-6 col-md-6','minlenght'=>'7','placeholder'=>'your numberphone','autofocus required'])!!}
  @if ($errors->has('fecha_nacimiento'))
      <span class="help-block">
          <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
      </span>
  @endif</div>
          </div>
          {!!form::submit('Registrar',['class'=>'btn btn-primary'])!!}
          {!!form::reset('Cancelar',['class'=>'btn btn-boton'])!!}
          {!!form::close()!!}
        </div>
