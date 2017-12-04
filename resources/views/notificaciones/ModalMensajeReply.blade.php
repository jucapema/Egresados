

        <div class="panel-heading">Responder Mensaje</div>
        <form method="POST" action="{{route('Mensaje.store')}}">
          {{csrf_field()}}
        <div class="panel-body">
          <div class="form-group">
            <input name="title" class="form-control" placeholder="Titulo" autofocus required></input>
          </div>
          <div class="form-group">
            <label for="name" class="col-md-4 control-label" >Correo</label>
            <input name="email" class="form-control" value="{{$correo}}" autofocus required></input>
          </div>
          <div class="form-group">
            <label for="contenido" class="col-md-4 control-label" >Cotenido</label>
            <textarea name="contenido" class="form-control" placeholder="{{$contenido}}" autofocus required></textarea>
          </div>
          <div class="form-group">
            <button class="btn btn-primary btn-block">Enviar Mensaje</button>
          </div>
        </div>
      </form>
