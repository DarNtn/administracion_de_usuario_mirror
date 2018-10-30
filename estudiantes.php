<?php
include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
?>
<link rel="stylesheet" href="assets/css/extra.css"/>
<script src="funciones/estudiantes/funcionesEstudiante.js" type="text/javascript"></script>
<!-- Inicio del Cabecera-->
<div class="panel" style="background: #50BFE6">
    <div class="panel-heading" style="color: white">

        <div class="row">

            <div class="col-md-2">
                <center><img src="assets/img/date.png" class="img-circle img-polaroid" width="70" height="65"></center>
            </div>
            <div class="col-md-8">
                <center><h5>Registro de Estudiantes</h5></center>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <center><a href="crear_estudiante.php" class="btn btn-danger" >
                        <strong><i class="glyphicon glyphicon-plus"></i> </strong><strong class="hidden-xs">Ingresar Nuevo</strong><strong> Estudiante</strong>
                    </a></center>
            </div>
        </div>
        
    </div>
</div>

<div class="table-responsive">
    <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
        <thead>
            <tr class="success">
                <th>N°</th>
                <th>Cédula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Género</th>
                <th>Dirección</th>
                <th>Curso</th>
                <th>Representante</th>
                <th>Estado</th>
                <th class="noExport">Opciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-- Fin del Cabecera-->
<?php
include_once('footer.php');
