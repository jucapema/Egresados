
<button class="btn btn-info" data-toogle="modal" data-target="#miventana">{$thisbotton}}</button>

<div class="modal fade" id="miventana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="miventana"> {{$vista}} </h4>
      </div>
      <div class="modal-body">
            {{$cuerpo}}
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button  type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

@component('modaltest')
  @slot('thisbotton')
  ventana
@endslot
    @slot('vista')
    ventana
  @endslot
  @slot('cuerpo')
    cuerpo chan chan
  @endslot
@endcomponent

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script>
  //$(document).ready(function()
  $(document).ready(function()
  {
    $(".btn").on("click",function(){
        $("#miventana").modal("show");
        $(this).addClass("miventana");
      });
    });
  </script>
