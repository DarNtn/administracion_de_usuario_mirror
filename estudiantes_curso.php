<?php
include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
?>
<link rel="stylesheet" href="assets/css/extra.css"/>
<script src="assets/js/calcularEdad.js" type="text/javascript"></script>
<script src="funciones/asignaciones/estudiantes_curso.js" type="text/javascript"></script>
<!-- Inicio del Cabecera-->
<div class="panel" style="background: #50BFE6">
    <div class="panel-heading" style="color: white">

        <div class="row">

            <div class="col-md-2">
                <center><img src="assets/img/salon.png" class="img-circle img-polaroid" width="70" height="65"></center>
            </div>
            <div class="col-md-8">                
                <center><h4 id="curso-paralelo">Curso - Paralelo</h4></center>
                <center><h6 style="margin:0">Capacidad: <i id="cantidad">0</i>/<i id="capacidad"></i> estudiantes</h6></center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center><a href="#estudiantes" role="button" class="btn btn-danger" data-toggle="modal">
                    <strong><i class="glyphicon glyphicon-plus"></i> </strong><strong class="hidden-xs">Agregar alumno</strong>
                </a></center>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Cabecera-->
<!-- Inicio del Tabla-->
<div class="table-responsive" >
    <table id="tblAlumnos" class="mdl-data-table" cellspacing="0" style="width:100%;white-space: pre-line !important;">
        <thead>
        <th style="text-align: center !important">Alumno</th>
        <th>Edad</th>
        <th class="noExport"></th>    
        <th>Id</th>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md-4">
        <button id="btn_volver" class="btn btn-info btn-block btn-sm" value="Volver">
            <i class="fa fa-arrow-alt-circle-left"> </i> Volver
        </button>
    </div>
</div>
<!-- Fin del Tabla-->
<!-- Inicio del ModalAdministrarEstudiantes-->
<div id="estudiantes" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"> 
            <div class="modal-body">
                <div class="container-fluid">
                    <center><h4 style="color: #55d9cb;">Agregar alumnos al curso</h4></center>                
                    <form id="agregarAlumnos" method="post">                    
                        <div class="col-md-12">
                            <div class="table-responsive" >
                                <table id="tblRegistrados" class="mdl-data-table" cellspacing="0" style="width:100%;white-space: pre-line !important;">
                                    <thead>
                                    <th></th>
                                    <th style="text-align: center !important">Alumno</th>
                                    <th>Edad</th>                                    
                                    <th>Id</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" id="btn_enviar" class="btn btn-info btn-block btn-sm" value="Guardar">
                                        <i class="fa fa-save"> </i> Agregar seleccionados
                                    </button><br>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-warning btn-block btn-sm" data-dismiss="modal" value="Cancelar">
                                        <i class="fa fa-trash"> </i> Cancelar
                                    </button><br>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin del ModalEstudiantes-->
<?php
include_once('footer.php');
