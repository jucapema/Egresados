
  <div class="row ">
      <div class="col-md-12">
                    <h3>DNI: {{auth::user()->dni}}</h3>
                    <h3>Nombre: {{auth::user()->name}}</h3>
                   <h3>Apellidos: {{auth::user()->apellido}}  </h3>
                   <h3>Email: {{auth::user()->email}}  </h3>
    @if (auth::user()->tipo_rol=='egresado')@php
            $egresado=App\Models\Egresado::findOrFail(auth::user()->egresado->id);
            $edad=\Carbon\Carbon::parse($egresado['fecha_nacimiento'])->age;
        @endphp
                  <h3>Intereses: {{$egresado->intereses}}</h3>
                  <h3>Genero: {{$egresado->genero}}</h3>
                  <h3>Edad: {{$edad}}</h3>
                  @endif
    @if (auth::user()->tipo_rol=='admin')@php
        $administrador=App\Models\Administrador::findOrFail(auth::user()->administrador->id);
      @endphp
                  <h3>Direccion: {{$administrador->direccion}}</h3>
                  <h3>Ciudad: {{$administrador->ciudad}}</h3>
                  <h3>Telefono: {{$administrador->telefono}}</h3>
    @endif
      </div>
  </div>
