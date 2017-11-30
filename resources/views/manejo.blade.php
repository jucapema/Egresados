<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width-device-width, initial-scale-1">
  <title>Modlas - ventanas emergentes</title>
  <link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Well done!</h4>
    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
  </div>

  <div class="container" style="margin-top: 60px;">
    <button class="btn btn-info" data-toogle="modal" data-target="#miventana">abrir ventana</button>

<div class="modal fade" id="miventana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="miventana"> this </h4>
      </div>
      <div class="modal-body">
chan chacna chan
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button  type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
</div>


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

</body>
</html>
