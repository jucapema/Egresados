  <input type="hidden" id="id" name="id" value="id">
  <div class="container", id="frmEditarUsuario">
  <div class="modal fade" id="{{$idmodal}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="modalEditarLabel">{{$title}}</h4>
        </div>
        <div class="modal-body">
          {{$contenido}}

        </div>
        <div class="modal-footer">
<!--
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Continuar</button>-->
        </div>
      </div>
    </div>
  </div>
</div>
