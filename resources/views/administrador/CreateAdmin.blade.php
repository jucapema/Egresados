@extends('layouts.app')

@section('titulo')

@endsection

@section('content')
{!!Form::open(['route'=>['Administrador.store'], 'method'=>'POST'])!!}
  {{csrf_field()}}
    <div class="container">

      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                  <div class="panel-heading">Formulario para administrador</div>
                    <div class="panel-body">
    <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('DNI: ')!!}<br>
    {!!form::text('dni',old('dni'),['class'=>'col-lx-6 col-md-6', 'placeholder'=>'your cc','autofocus required'])!!}
  </div>
  <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Nombre: ')!!}<br>
    {!!form::text('name',old('name'),['class'=>'form group col-lx-6 col-md-6', 'placeholder'=>'your name','autofocus required'])!!}
    </div><div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Apellidos: ')!!}<br>
    {!!form::text('apellido',old('apellido'),['class'=>'form group col-lx-6 col-md-6','placeholder'=>'your lastname','autofocus required'])!!}
    </div><div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Email: ')!!}<br>
    {!!form::email('email',old('email'),['class'=>'form group col-lx-6 col-md-6','placeholder'=>'nombre@mozilla.com','autofocus required'])!!}
    </div><div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Telefono: ')!!}<br>
    {!!form::tel('telefono',old('telefono'),['class'=>'form group col-lx-6 col-md-6','minlenght'=>'7','placeholder'=>'your numberphone','autofocus required'])!!}
  </div>  <div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Direccion: ')!!}<br>
    {!!form::text('direccion',old('direccion'),['class'=>'form group col-lx-6 col-md-6', 'placeholder'=>'your address'])!!}<br>
    </div><div class="col-md-12 col-lx-12 col-lg-12 col-sm-12">
    {!!form::label('Ciudad: ')!!}<br>
    {!!form::text('ciudad',old('ciudad'),['class'=>'form group col-lx-6 col-md-6','placeholder'=>'your city'])!!}
            </div></div>
          </div>
          {!!form::submit('Registrar',['class'=>'btn btn-primary'])!!}
          {!!form::reset('Cancelar',['class'=>'btn btn-boton'])!!}
          {!!form::close()!!}
        </div>
      </div>
    </div>
@endsection
