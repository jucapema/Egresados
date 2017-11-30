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
    {!!Form::open(['route'=>['Administrador.update','$administrador'=>$administrador->id], 'method'=>'POST'])!!}
      {{ method_field('PUT') }}
      {{csrf_field()}}
                  <div class="panel panel-default">
                  <div class="panel-heading">Editar Administrador</div>
                    <div class="panel-body">
    <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('DNI: ')!!}<br>
    {!!form::text('dni',$user->dni,['class'=>'col-lx-6 col-md-6', 'autofocus required'])!!}
  @if ($errors->has('dni'))
      <span class="help-block">
          <strong>{{ $errors->first('dni') }}</strong>
      </span>
  @endif</div>
  <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Nombre: ')!!}<br>
    {!!form::text('name',$user->name,['class'=>'form group col-lx-6 col-md-6', 'autofocus required'])!!}
  @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif</div>
    <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Apellidos: ')!!}<br>
    {!!form::text('apellido',$user->apellido,['class'=>'form group col-lx-6 col-md-6','placeholder'=>'your lastname','autofocus required'])!!}
  @if ($errors->has('apellido'))
        <span class="help-block">
            <strong>{{ $errors->first('apellido') }}</strong>
        </span>
    @endif</div><div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Email: ')!!}<br>
    {!!form::email('email',$user->email,['class'=>'form group col-lx-6 col-md-6','placeholder'=>'nombre@mozilla.com','autofocus required'])!!}
  @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif</div><div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Telefono: ')!!}<br>
    {!!form::tel('telefono',$user->telefono,['class'=>'form group col-lx-6 col-md-6','minlenght'=>'7','placeholder'=>'your numberphone','autofocus required'])!!}
  @if ($errors->has('telefono'))
      <span class="help-block">
          <strong>{{ $errors->first('telefono') }}</strong>
      </span>
  @endif</div>  <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Direccion: ')!!}<br>
    {!!form::text('direccion',$administrador->direccion,['class'=>'form group col-lx-6 col-md-6', 'placeholder'=>'your address'])!!}<br>
  @if ($errors->has('direccion'))
        <span class="help-block">
            <strong>{{ $errors->first('direccion') }}</strong>
        </span>
    @endif</div><div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Ciudad: ')!!}<br>
    {!!form::text('ciudad',$administrador->ciudad,['class'=>'form group col-lx-6 col-md-6','placeholder'=>'your city'])!!}
  @if ($errors->has('ciudad'))
                <span class="help-block">
                    <strong>{{ $errors->first('ciudad') }}</strong>
                </span>
            @endif</div>
          </div>
          {!!form::submit('Registrar',['class'=>'btn btn-primary'])!!}
          {!!form::reset('Cancelar',['class'=>'btn btn-boton'])!!}
          {!!form::close()!!}
