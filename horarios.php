<?php
include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
?>
<link rel="stylesheet" href="assets/css/extra.css"/>
<script src="funciones/horarios/funcionesHorarios.js" type="text/javascript"></script>
<!-- Inicio del Cabecera-->
<div class="panel" style="background: #50BFE6">
    <div class="panel-heading" style="color: white">

        <div class="row">

            <div class="col-md-2">
                <center><img src="assets/img/salon.png" class="img-circle img-polaroid" width="70" height="65"></center>
            </div>
            <div class="col-md-8">
                <center><h5>Gestor de Horarios de Clase</h5></center>
            </div>
        </div>
        <div class="row">
            <!--div class="col-md-12">
                <center><a href="#nuevo" role="button" class="btn btn-danger" data-toggle="modal">
                    <strong><i class="glyphicon glyphicon-plus"></i> </strong><strong class="hidden-xs">Nueva Asignación</strong>
                </a></center>
            </div-->
        </div>
    </div>
</div>
<!-- Fin del Cabecera-->
<!-- Inicio del Tabla-->
<div class="table-responsive" >
    <table id="tblCursos" class="mdl-data-table" cellspacing="0" style="width:100%;white-space: pre-line !important;">
        <thead>
        <th>N°</th>
        <th>Curso</th>
        <th>Nivel</th>
        <th>Paralelo</th>
        <th>Jornada</th>        
        <th>Período</th>        
        <th class="noExport">Acción</th>    
        <th>Id</th>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-- Fin del Tabla-->
<!-- Inicio del ModalNuevo-->
<div id="editor" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"> 
            <div class="modal-body">

                <center><h4 style="color: #55d9cb;">Gestor de Horario</h4></center>
                <center><h4 id="curso-name" style="color: #55d9cb;">Curso - Paralelo</h4></center>
                <span style="display:none;" id="idCurso"></span>
                <div class="row extended">
                    <div class="col-md-2"><center><strong>LUNES</strong></center></div>
                    <div class="col-md-2"><center><strong>MARTES</strong></center></div>
                    <div class="col-md-2"><center><strong>MIÉRCOLES</strong></center></div>
                    <div class="col-md-2"><center><strong>JUEVES</strong></center></div>
                    <div class="col-md-2"><center><strong>VIERNES</strong></center></div>
                </div>
                <div class="row extended">
                    <div class="col-md-2">
                        <center><button class="btn btn-default round addHora" value="Lunes" title="Añadir clase"><span class="glyphicon glyphicon-plus"></span></button></center>
                        <div id="Lunes"></div>
                    </div>
                    <div class="col-md-2">
                        <center><button class="btn btn-default round addHora" value="Martes"  title="Añadir clase"><span class="glyphicon glyphicon-plus"></span></button></center>
                        <div id="Martes"></div>
                    </div>
                    <div class="col-md-2">
                        <center><button class="btn btn-default round addHora" value="Miercoles" title="Añadir clase"><span class="glyphicon glyphicon-plus"></span></button></center>
                        <div id="Miercoles"></div>
                    </div>
                    <div class="col-md-2">
                        <center><button class="btn btn-default round addHora" value="Jueves" title="Añadir clase"><span class="glyphicon glyphicon-plus"></span></button></center>
                        <div id="Jueves"></div>
                    </div>
                    <div class="col-md-2">
                        <center><button class="btn btn-default round addHora" value="Viernes" title="Añadir clase"><span class="glyphicon glyphicon-plus"></span></button></center>
                        <div id="Viernes"></div>
                    </div>
                </div>
                <form id="guardarHorario" method="post">                                      
                    <br>                    
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" id="btn_enviar" class="btn btn-info btn-block btn-sm" value="Guardar">
                                <i class="fa fa-save"> </i> Guardar
                            </button><br>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-warning btn-block btn-sm" data-dismiss="modal" value="Cancelar">
                                <i class="fa fa-trash"> </i> Cancelar
                            </button><br>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin del ModalNuevo-->
<?php
include_once('footer.php');
