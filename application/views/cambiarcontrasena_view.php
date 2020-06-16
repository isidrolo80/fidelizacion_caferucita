<!DOCTYPE html>
<html>
<head>
    <title>Recuperar Contrasena</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
  <div class="row">

<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
</div>
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
<img src="<?php echo base_url();?>/images/logo.png" alt="" style="width:100%;height:auto" vspace="50"/>
    </div>

  </div>
</div>




<div class="container">
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <section class="login-form">

 
         

<?php echo form_open('recoverpassword/confirmarpassword/'); ?>


        
    <div class="form-signin">       
      <div class="text-center">
        <h3>Cambiar de Contraseña </h3>
       </div>
       <br>
          <input name="password" type="password" class="form-control input-lg" id="password" placeholder="Contraseña" required="" />
          <br>
          <input name="password1" type="password" class="form-control input-lg" id="password1" placeholder="Contraseña" required="" />
          <input type="hidden" name="codigo" value="<?php print $codigo?>"/>
          <br>
          <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in" />
    </div>






      <div class="form-group">
      <div
        class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-4 col-lg-offset-4"
        role="alert">
        <font color="red">
        <?php echo validation_errors(); ?>
        </font>
      </div>
    </div>
        
      
</body>
</html>