<?php
include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
?>
<script src="funciones/contrasena/funcionesContrasena.js" type="text/javascript"></script>
<div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-info">
        <div class="panel-heading">
        <center>
            <strong>
                <img src="assets/img/seguridad.png" class="img-rounded img-polaroid" width="50" height="65"> 
                <h5>Cambiar Contraseña</h5>               
            </strong>
        </center>
        </div>
        <div class="panel-body">
            <?php
                $id = "";
                if (!empty($_GET['id'])) {
                    $id = $_GET['id'];
                }
            ?>
            <input type="hidden" id="username" value="<?php echo $_SESSION['username']?>">
            <input type="hidden" id="tipoUsuario" value="<?php echo $_SESSION['tipo_usu']?>">
            
            <div class="col-md-8 col-md-offset-2">
                <label><strong>Contraseña Antigua: </strong></label><br>
                <input type="password" class="form-control" id="contrasenaAntigua" required><br>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <label><strong>Nueva Contraseña: </strong></label><br>
                <input type="password" class="form-control" id="contrasenaNueva" required><br>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <button tyoe="button" onclick="cambiarContrasena()" class="btn btn-primary btn-block">
                    Cambiar Contraseña
                </button>
            </div>	   
        </div>
    </div>
    </div>
<?php