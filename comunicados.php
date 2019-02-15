<?php
include_once('header.php');
?>
<script src="Plugins/EditorJquery/summernote.min.js" type="text/javascript"></script>
<link href="Plugins/EditorJquery/summernote.css" rel="stylesheet" type="text/css"/>
<script src="funciones/comunicados/funcionComunicado.js" type="text/javascript"></script>
<link href="assets/css/extra.css" rel="stylesheet" type="text/css"/>

<!-- Inicio del Cabecera-->
<span id="user" style="display:none"><?php echo $_SESSION['username']; ?></span>
<span id="tipo" style="display:none"><?php echo $_SESSION['tipo_usu'] ?></span>
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
<form id="correoCurso" enctype="multipart/form-data" style="max-width: 100%">
    <div class="row">
        <div class="col-md-3">
            <label for="curso">Cursos disponibles</label>
            <select class="form-control" id="curso" name="curso" title="Curso">
                <option selected disabled style="display:none;" value="">Seleccione curso...</option>                                
            </select>
        </div>
        <div class="col-md-9">
            <label for="">Cursos destinatarios:</label>
            <div id="cursosSeleccionados" class="row-border">
                Ninguno seleccionado
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3">
            <label for="asunto">Asunto</label>
            <select class="form-control" id="asunto" name="asunto" required title="Asunto">
                <option selected disabled style="display:none;" value="">Seleccione asunto...</option>
                <?php
                $asuntos = $conexion->realizarConsulta("SELECT id_mensaje as id, asunto FROM mensaje WHERE tipo='Plantilla'");
                for ($b = 0; $b < sizeof($asuntos); $b++) {
                    echo '<option value="' . $asuntos[$b]['id'] . '">' . $asuntos[$b]['asunto'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" id="otroAsunto" class="form-control" style="margin-top: 26px; display:none" required title="Asunto" placeholder="Ingrese asunto..." disabled>
        </div>
    </div><br>
    <!--input name="correo" id="correo" class="form-control" style="max-width: 100%;" placeholder="Correo electronico. Ejemplo: Ejemplo@gmail.com"><br-->
    <textarea name="contenido" class="summernote" id="contents" title="Contents"></textarea><br>
    <div class="adjunto-panel" style="padding: 0px 10px"></div>
    <button type="submit" class="btn btn-block btn-info">Enviar</button>
</form>
<!-- Fin del Comunicado-->
<?php
include_once('footer.php');
