<!--modal change password_________________________all -->
@component('modals.modal')
  @slot('id')
    ventanapassword
  @endslot
  @slot('title')
    Cambiar Contraseña
  @endslot
  @slot('cuerpo')
      @component('modals.changepassword')
      @endcomponent
  @endslot
  @slot('boton')
    btn3
  @endslot
@endcomponent
<!-- modal change picture all-->
  @component('modals.modal')
    @slot('id')
      ventanafoto
    @endslot
    @slot('title')
      Cambiar Foto
    @endslot
    @slot('cuerpo')
        @component('modals.cargarfoto')
        @endcomponent
    @endslot
    @slot('boton')
      btn4
    @endslot
  @endcomponent
  <!--Modalsssss Show informacion -->
  @component('modals.modal')
    @slot('id')
      miventanainfo
    @endslot
    @slot('title')
      Informacion
    @endslot
    @slot('cuerpo')
      @component('user.ShowUser')
      @endcomponent
    @endslot
    @slot('boton')
      btn6
    @endslot
  @endcomponent
  <!--Modalsssss Modal editar informacion root-->
              @component('modals.modal')
                @slot('id')
                  miventana
                @endslot
                @slot('title')
                  Editar Informacion
                @endslot
                @slot('cuerpo')
                    @component('user.EditUser')
                    @endcomponent
                @endslot
                @slot('boton')
                  btn2
                @endslot
              @endcomponent
<!-- darse baja -->
@if (auth::user()->tipo_rol=='egresado')

    @component('modals.modal')
      @slot('id')
        baja
      @endslot
      @slot('title')
        Seguro de darte de baja
      @endslot
      @slot('cuerpo')
        Darse de baja
        <a href="{{route('baja',['user'=>Auth::user()->egresado->id])}}" class="btn btn-danger block">DarseBaja</a>
      @endslot
      @slot('boton')
        btn5
      @endslot
    @endcomponent
    
  @component('modals.modal')
    @slot('id')
     chat
    @endslot
    @slot('title')
     Enviar correo
    @endslot
    @slot('cuerpo')
       @component('notificaciones.Mensaje')
         @slot('id')
           {{\auth::user()->id}}
         @endslot
       @endcomponent
    @endslot
    @slot('boton')
     btn7
    @endslot
    @endcomponent
@endif
<!---end modalas -->
