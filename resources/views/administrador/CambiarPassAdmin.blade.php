<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>

@if(Session::has('flash_message'))
  <script type="text/javascript">
    alert("{{Session::get('flash_message')}}");
  </script>
@endif
@include('flash::message')
<body>
<div class="container">
    <img src="https://image.ibb.co/gzqtsb/Wallpaper_1920x1080.jpg" class="wallpaper">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel2 panel-default">
                <div class="panel-heading">Debes Cambiar Tu Contraseña</div>
                    <div class="atras">
                    <a href="{{route('inicio')}}"><i class="fa fa-arrow-circle-left fa-4x atr" aria-hidden="true">
                    </i></a></div>
                <div class="panel-body">
                    @include('modals.changepassword')
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
