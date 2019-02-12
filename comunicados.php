<?php
include_once('header.php');
?>
<script src="Plugins/EditorJquery/summernote.min.js" type="text/javascript"></script>
<link href="Plugins/EditorJquery/summernote.css" rel="stylesheet" type="text/css"/>
<script src="funciones/comunicados/funcionComunicado.js" type="text/javascript"></script>
<link href="assets/css/extra.css" rel="stylesheet" type="text/css"/>

<!-- Inicio del Cabecera-->
<div class="panel" style="background: #50BFE6">
    <div class="panel-heading" style="color: white">

        <div class="row">

            <div class="col-md-2">
                <center><img src="assets/img/email.png" class="img-profile img-polaroid" width="70" height="65"></center>
            </div>
            <div class="col-md-8">
                <center><h3>Envio de comunicados via correos</h3></center>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Cabecera-->
<!-- Inicio del Comunicado-->
<form id="correoPersonal" enctype="multipart/form-data" style="max-width: 100%">
    <select id="seleccion" name="seleccion" class="form-control">
        <option value="especifico">email específico</option>
        <option value="todos">Todos los representantes activos del período</option>
    </select><br>
    <input name="correo" id="correo" class="form-control" style="max-width: 100%;" placeholder="Correo electronico. Ejemplo: Ejemplo@gmail.com"><br>
    <textarea name="contenido" class="summernote" id="contents" title="Contents"></textarea><br>
    <div class="adjunto-panel" style="padding: 0px 10px"></div>
    <button type="submit" class="btn btn-block btn-info">Enviar</button>
</form>
<!-- Fin del Comunicado-->
<?php
include_once('footer.php');
