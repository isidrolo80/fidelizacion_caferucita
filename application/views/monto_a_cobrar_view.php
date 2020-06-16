<!DOCTYPE html>
<html>
<head>
    <title>Cobrar Gift Cards</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

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
<img src="<?php echo base_url();?>images/logo.png" alt="" vspace="50" style="width:100%;height:auto"/>
    </div>

  </div>
</div>


<div class="container">
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <section class="login-form">

 
         

<?php echo form_open('vendedor/cobrar'); ?>


        
    <div class="form-signin">       
      <div class="text-center">
    <h1>Monto A Cobrar</h1>
    <br><br>
    <h4>Email: <b><?php echo $email;?></b></h4>
    <h3>Saldo: <b><?php echo $valor;?></b></h3> <br>
    <h5>Nombre: <b><?php echo $nombre;?></b></h5>
    <h5>Cedula/Ruc: <b><?php echo $cedula_ruc;?></b></h5>
    <h5>Entrada: <b><?php if($entrada==0){echo "NO TIENE CAFE GRATIS";} else if ($entrada==1) {echo "SI TIENE CAFE GRATIS";} ?> </b> </h5>

    
       </div>

          <br>
          <input name="monto" type="number" min="0" step="0.01" class="form-control input-lg" id="monto" placeholder="Monto" required="" />
          <input type="hidden" name="codigoQR" value="<?php echo $codigoQR;?>">
          <input type="hidden" name="email" value="<?php echo $email;?>">
          <br>

                    <?php 
          if ($entrada == 0) {

            echo " <div class='checkbox text-center'>
                      <input id='entradaHidden' type='hidden' value='0' name='entrada'>
                      <h4>NO TIENE CAFE GRATIS </h4>
                  </div>
              <br>
          <br>";

          }else if ($entrada == 1) {
            echo " <div class='checkbox text-center'>
                <input id='entradaHidden' type='hidden' value='1' name='entrada'>
                <label><input type='checkbox' value='0' name='entrada' id='entrada'> COBRAR CAFE GRATIS?</label>
              </div>
              <br>
          <br>";
          }

          ?>

          <input type="submit" class="btn btn-lg btn-primary btn-block" value="Cobrar" />
          <br>  
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