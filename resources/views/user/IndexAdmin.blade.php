
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <!---<meta name="viewport" content="width=device-width" />-->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administradores Egresados UTP</title>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">


  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Egresados, Lista Administradores') }}</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>



<body>
  @if($users->count()==0)
    <script type="text/javascript">
    alert("No hay Administradores Registrados!");
    </script>
  @endif
  @if(Session::has('flash_message'))
    <script type="text/javascript">
    alert("{{Session::get('flash_message')}}");
    </script>
  @endif
  <div id="app">
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">

          <!-- Branding Image -->
          <a class="navbar-brand" href="{{ url('/home') }}">
            {{ config('app.name', 'Egresados') }}
          </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
            &nbsp;
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links-->
            @guest
              <li><a href="{ route('login') }}">Login</a></li>
              <li><a href="{ route('register') }}">Register</a></li>
            @else
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                  <li>
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </li>
              </ul>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
</div>
<div class="container">
  <a href="{{route('Administrador.create')}}" class="btn btn-info">Agregar</a>
  <a href="#" class="btn btn-info">Consultar</a>
  <a href="{route('Administrador.edit',['user'=>$user->id])}}" class="btn btn-info">Modificar</a>
  <a href="{route('Administrador.destroy',['user'=>$user->id])}" class="btn btn-info">Eliminar</a>
  <table id="users" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
      <tr>
        <th>Administrador</th>
        <th>DNI</th>
        <th>Correo</th>
      </tr>
    </thead>
  </table>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function () {
  $('#users').DataTable({
    "processing":true,
    "serverSide":true,
    "ajax": "list/admins",
    "columns":[
      {data: 'name'},
      {data: 'dni'},
      {data: 'email'},
    ]
  });
});
</script>
</div>
</body>
</html>
