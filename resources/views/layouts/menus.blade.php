<!DOCTYPE html>
<html>
<head>
    <title>Observatorio Egresados UTP</title>
<script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-hover-dropdown/2.2.1/bootstrap-hover-dropdown.min.js" integrity="sha256-oZUp5ULh9oikWgL4PJ/ceUdVHxFP0v2F1wQBC7iLuOQ=" crossorigin="anonymous"></script>
    
@yield('headers')

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta charset="utf-8">
    
</head>

<body>

    <img src="https://image.ibb.co/gzqtsb/Wallpaper_1920x1080.jpg" class="wallpaper">

    <header>
        <div class="container">
            <section class="main row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                    <img src="https://image.ibb.co/ntOfoG/Logo_UTP.png" class="logo"></div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                    <img src="https://image.ibb.co/ftpqxm/Titulo_P_gina.png" class="animated bounceInDown title"></div>
            </section>
            <section class="main row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 atras">
                    <a href="#"><i class="fa fa-arrow-circle-left fa-4x atr" aria-hidden="true"></i></a></div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 foto">
                    <img src="https://image.ibb.co/fLsj8R/Foto_Egresado.png" 
                    onmouseover="this.src='https://image.ibb.co/eY9aF6/Cambiar_Foto_de_Perfil.png';" 
                    onmouseout="this.src='https://image.ibb.co/fLsj8R/Foto_Egresado.png';" class="ft"></div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                    <h1 class="nombre">{{Auth::user()->name}} {{Auth::user()->apellido}} ({{Auth::user()->tipo_rol}})</h1></div>
            </section>
        </div>
           </header> 
@yield('content')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

   <script type="text/javascript">
      $( document ).ready(function() {
         $(".btn-group a").on("click", function(){
            $(".btn-group").find(".activa1").removeClass("activa1");
            $(this).addClass("activa1");
         });
      });
   </script>

   <script type="text/javascript">
      $( document ).ready(function() {
         $(".dropdown-menu a").on("click", function(){
            $(".dropdown-menu").find(".activa11").removeClass("activa11");
            $(this).addClass("activa11");
         });
      });
   </script>

   <script type="text/javascript">
      $( document ).ready(function() {
         $(".menu-content li").on("click", function(){
            $(".menu-content").find(".activa2").removeClass("activa2");
            $(this).addClass("activa2");
         });
      });
   </script>
<div class="recuadro"></div>
</body>

<footer>
    <div><img src="https://image.ibb.co/ig2WQ6/Footer.jpg" class="pie"></div>
  <div><img src="https://image.ibb.co/hczsF6/Logo_UTP_2.png" class="logo2"></div>
  <div><img src="https://image.ibb.co/hakPv6/Texto_Footer.png" class="textfooter"></div>
</footer>
</html>