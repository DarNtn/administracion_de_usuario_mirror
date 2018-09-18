<?php
include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
?>
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
	//if(!empty($_POST['c1']) and !empty($_POST['c2']) and !empty($_POST['contra'])){
		//cambioClave($_POST['c1'],$_POST['c2'],$_SESSION['user'],$_POST['contra']);
	//}
	?>
            
            <form name="form1" method="post" action="" style="margin: auto" onSubmit="return validar_clave(c1.value,c2.value);">
              <div class="col-md-8 col-md-offset-2">
            <label><strong>Contraseña Antigua: </strong></label><br>
            <input type="password" class="form-control" name="contra" required><br>
            </div>
              <div class="col-md-8 col-md-offset-2">
          <label><strong>Nueva Contraseña: </strong></label><br>
          <input type="password" class="form-control" id="c1" name="c1" required><br>
          </div>
          <div class="col-md-8 col-md-offset-2">
          <label><strong>Repita Nueva Contraseña: </strong></label>
          <input type="password" class="form-control" id="c2" name="c2" required><br>
          </div>
          <div class="col-md-8 col-md-offset-2">
          <input type="submit" name="button" id="button" class="btn btn-primary btn-block" value="Cambiar Contraseña">
          </div>
		  <div class="col-md-8 col-md-offset-2">
		  <p></p>
          </div>
		    
          </form>
        </div>
    </div>
    </div>
<?php
include_once('footer.php');
