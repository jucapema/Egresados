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
</head>
<body>

<div class="container">
  @if(Session::has('flash_message'))
    <script type="text/javascript">
      alert("{{Session::get('flash_message')}}");
    </script>
  @endif

  <script>
  function ValidarCorreo(obj){
    if (!(/^[-\w.%+]{1,64}@[u][t][p]\.[e][d][u]\.[c][o]$/i).test(obj)) {  //expresion regular va aca
      alert('Debes Usar el Correo Institucional');
    }
  }
  </script>

<img src="https://image.ibb.co/gzqtsb/Wallpaper_1920x1080.jpg" class="wallpaper">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">INICIAR SESIÓN</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus onchange="ValidarCorreo(this);">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Olvido su contraseña?
                                </a>
                                <a class="btn btn-link" href="https://www.utp.edu.co/egresados/egresados-utp.html">
                                    Ayuda?
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-default boton1">
                                    Ingresar
                                </button>
                                <button type="reset" class="btn btn-default boton2">
                                    Cancelar
                                </button>
                                <h3><a href="{{ route('register') }}" class="suscrip">Suscribirse</a></h3>
                            </div>
                        </div>
                    </form>
                <img src="http://i64.tinypic.com/1z38h8w.png" class="imglogin">
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
