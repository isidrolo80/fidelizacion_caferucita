<!DOCTYPE html>
<html>
<head>
    <title>Nueva Gift Card</title>
    <script   src="http://code.jquery.com/jquery-3.3.1.js"   integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="   crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Favicons -->
<link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
<link rel="manifest" href="/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

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

 <?php
if (isset($exito)) {
?>

<script type="text/javascript">alert("Se realizó el cobro con éxito");</script>

<?php
}
?>
         

<?php echo form_open('vendedor/make_qr'); ?>








        
    <div class="form-signin">       
      
       <br>
       <div class="text-center">
      <h3>Crear Gift Cards</h3> <br>
       </div>
          <input id="email" type="text" name="email" placeholder="email" required class="form-control input-lg" value="<?php echo $email;?>" readonly/>
          <br>

          <input name="name" type="text" class="form-control input-lg" id="name" placeholder="Nombre y Apellido" required="" />
          <br>

          <input name="cedula_ruc" type="number" min="10" class="form-control input-lg" id="cedula_ruc" placeholder="Cedula o RUC" required="" />
          <br>

          <input name="ammount" type="number" min="0" step="0.01" class="form-control input-lg" id="ammount" placeholder="Monto" required="" />
          <br>
           <div class="checkbox text-center">
            <input id='entradaHidden' type='hidden' value='0' name='entrada'>
            <label><input type="checkbox" value="1" name="entrada" id="entrada"> Incluir un café gratis?</label>
          </div>
          <br>
          <input type="submit" class="btn btn-lg btn-primary btn-block" value="Crear Gift Card" />
          <br>  
    </div>

    <a href="<?php echo base_url();?>/index.php/vendedor/logout">Logout</a>






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