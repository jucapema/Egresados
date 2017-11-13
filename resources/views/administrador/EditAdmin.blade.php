@extends('layouts.app')

@section('titulo')

@endsection

@section('content')
{!!Form::open(['route'=>['Administrador.update'], 'method'=>'POST'])!!}
  {{ method_field('PUT') }}
  {{csrf_field()}}
    <div class="form-group">
      'password','','tipo_rol','estado_cuenta',
      {!!form::label('DNI: ')!!}
      {!!form::text('dni',$user->dni,['class'=>'form', 'placeholder'=>'your cc','autofocus required'])!!}
      </div>
      <div class="form-group">
    {!!form::label('Nombre: ')!!}
    {!!form::text('name',$user->name,['class'=>'form', 'placeholder'=>'your name','autofocus required'])!!}
    </div>
    <div class="form-group">
    {!!form::label('Apellidos: ')!!}
    {!!form::text('apellido',$user->apellido,['class'=>'form','placeholder'=>'your lastname','autofocus required'])!!}
    </div>
    <div class="form-group">
    {!!form::label('Estado Cuenta: ')!!}
    {!!form::select('genero',['activa' => 'Activa', 'ban' => 'Ban'], $user->estado_cuenta)!!} 
    </div>
    <div class="form-group">
    {!!form::label('Email: ')!!}
    {!!form::email('email',$user->email,['class'=>'form','placeholder'=>'nombre@mozilla.com','autofocus required'])!!}
    </div>
    <div class="form-group">
    {!!form::label('Telefono: ')!!}
    {!!form::tel('telefono',$administrador->telefono,['class'=>'form','minlenght'=>'7','placeholder'=>'your numberphone','autofocus required'])!!}
    </div>
    <div class="form-group">
    {!!form::label('Direccion: ')!!}
    {!!form::text('direccion',$administrador->direccion,['class'=>'form', 'placeholder'=>'your address'])!!}
    </div>
    <div class="form-group">
    {!!form::label('Ciudad: ')!!}
    {!!form::text('ciudad',$administrador->ciudad),['class'=>'form','placeholder'=>'your city'])!!}
    </div>
    {!!form::submit('Registrar',['class'=>'btn btn-primary'])!!}
    {!!form::reset('Cancelar',['class'=>'btn btn-boton'])!!}
    {!!form::close()!!}
@endsection
