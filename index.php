<?php
    //session_start();
  // error_reporting(-1); // reports all errors
  // ini_set("display_errors", "1"); // shows all errors
  // ini_set("log_errors", 1);
  // ini_set("error_log", "my-errors.log");
    if(!empty($_SESSION['tipo_usu'])){
        if($_SESSION['tipo_usu']=='a' or $_SESSION['tipo_usu']=='u'){
            header('location:inicio.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Entrar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    
<script src="assets/vendor/jquery/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="Plugins/SweetAlert2/sweetalert2.min.js" type="text/javascript"></script>
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="Plugins/SweetAlert2/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="ico/favicon.png">
    <script src="funciones/index/index.js" type="text/javascript"></script>
    <style type="text/css">
      body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #f5f5f5;
	background-image: url(assets/img/fondo.jpg);
	background-size: cover;
        background-position: center;background-repeat: no-repeat;background-attachment: fixed;
      }

      .form-signin {
        max-width: 350px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .center-content{
                position: absolute;
                top: 50%;
                right: -50%;
                left: 50%;
                transform: translate(-50%,-50%);
            }

    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
  </head>

  <body>
    <div class="container-fluid center-content">
        <form id="formulario" name="formulario" method="post" class="form-signin">
        <h2 class="form-signin-heading">Bienvenidos</h2>
        <input type="hidden" name="opcion" value="iniciar">
        <input type="text" name="usuario" class="form-control input-lg" placeholder="Usuario" autocomplete="off"><br>
        <input type="password" name="contra" class="form-control input-lg" placeholder="Contraseña" autocomplete="off"><br>
        <button class="form-control btn btn-primary input-lg" type="submit">Iniciar</button>
        <p>&nbsp;</p>
      </form>
    </div> <!-- /container -->

  </body>
</html>
