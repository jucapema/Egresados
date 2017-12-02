  @if(count($errors)>0)
          <div class="alert alert-warning" role="alert">
             @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                <script type="text/javascript">
                    alert("{{ $error }}");
                </script>
            @endforeach
          </div>
      @endif

<script>
function ValidarImagen(obj){
    var uploadFile = obj.files[0];

    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg)$/i).test(uploadFile.name)) {  //expresion regular va aca
        alert('Error al adjuntar el archivo');
    }
    /*else {
        var img = new Image();
        img.onload = function () {
            if (this.width.toFixed(0) != 200 && this.height.toFixed(0) != 200) {
                alert('Las medidas deben ser: 200 * 200');
            }
            else if (uploadFile.size > 20000)
            {
                alert('El peso de la imagen no puede exceder los 200kb')
            }
            else {
                alert('Imagen correcta :)')
            }
        };*/
        img.src = URL.createObjectURL(uploadFile);
    }
        </script>


          <form method="POST" action="{{route('subir')}}" accept-charset="UTF-8" enctype="multipart/form-data">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="col-md-12">
                <input type="file" class="form-control" name="file" onchange="ValidarImagen(this);">
              </div>
            <div class="form-group">
              <div class="col-md-12 col-md-offset-6">
                <button type="submit" class="btn btn-primary">Subir</button>
              </div>
            </div>
          </form>
          <!--<a href="{route('load')}}">DesCargar Imagen mi id {auth::user()->id}}</a>
          <div class="form-group"><img src="{ asset('storage/images/1.jpg') }} " WIDTH=140 HEIGHT=210 BORDER=0 ALT="Foto"></div>-->
