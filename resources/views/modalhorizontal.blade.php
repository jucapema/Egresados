<!--Modalsssss Modal editar informacion-->
    <div class="modal fade" id="miventana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="miventana"> Editar Informacion </h4>
          </div>
          <div class="modal-body">
                      mierda
          </div>
          <div class="modal-footer">
            <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button  type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
<!--modal change password_________________________-->
<div class="modal fade" id="ventanapassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="ventanapassword"> Cambiar Password </h4>
      </div>
      <div class="modal-body">
            @component('changepassword')
            @endcomponent
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- modal change picture-->
<div class="modal fade" id="ventanafoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="ventanafoto"> Cambiar Foto de Perfil </h4>
      </div>
      <div class="modal-body">
            @component('cargarfoto')
            @endcomponent
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  <!---end modalas -->

      <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

      <script>
      //$(document).ready(function()
      $(document).ready(function()
      {
        $(".btn2").on("click",function(){
            $("#miventana").modal("show");
            $(this).addClass("miventana");
          });
        });
      </script>

      <script>
      $(".btn3").on("click",function(){
          $("#ventanapassword").modal("show");
          $(this).addClass("ventanapassword");
        });
      </script>

      <script>
      $(".btn4").on("click",function(){
          $("#ventanafoto").modal("show");
          $(this).addClass("ventanafoto");
        });
      </script>
