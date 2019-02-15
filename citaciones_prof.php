<?php
include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
?>
<link rel="stylesheet" href="assets/css/extra.css"/>
<script src="funciones/citaciones/funcionesCitaciones.js" type="text/javascript"></script>
<!-- Inicio del Cabecera-->
<div class="panel" style="background: #50BFE6">
    <div class="panel-heading" style="color: white">
        <input hidden id="username" value="<?php echo $_SESSION['username']; ?>" />
        <div class="row">
            <div class="col-md-2">
                <center><img src="assets/img/curse.png" class="img-circle img-polaroid" width="70" height="65"></center>
            </div>
            <div class="col-md-8">
                <center><h5>Citaciones Agendadas</h5></center>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Cabecera-->
<!-- Inicio del Tabla-->
<div class="table-responsive" >
    <table id="tblCitaciones" class="mdl-data-table" cellspacing="0" style="width: 100%">
        <thead>
        <th></th>
        <th style="text-align: left">Curso</th>
        <th style="text-align: left">Asunto</th>        
        <th style="text-align: left">Fecha</th>
        <th style="text-align: left">Hora</th>        
        <th style="text-align: left" class="noExport">Acción</th>        
        <th class="noExport">Id</th>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-- Fin del Tabla-->
<!-- Inicio del ModalNuevo-->
<div id="mensaje" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"> 
            <div class="modal-body">

                <center><h5 style="color: #55d9cb;">Citación</h5></center>
                <form id="mensajeview">                    
                    <div class="row" style="margin: 5 0;">
                        <div class="col-md-4">
                            <label>Hora: </label>
                        </div>
                        <div class="col-md-8">
                            <input disabled class="form-control" type="text" id='hora'/>
                        </div>
                    </div>
                    <div class="row" style="margin: 5 0;">
                        <div class="col-md-4">
                            <label>Asunto: </label>
                        </div>
                        <div class="col-md-8">
                            <input disabled class="form-control" type="text" id='asunto'/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Contenido: </label>
                    </div>
                    <div class="col-md-12" style="margin: 5 0;">
                        <textarea disabled class="form-control" rows="10" id="contenido"></textarea>
                    </div>
                    <div class="row" style="margin: 5 0;">                        
                        <div class="col-md-6" style="margin-left: 50%">
                            <button class="btn btn-warning btn-block btn-sm" data-dismiss="modal" value="cerrar">
                                <i class="fa fa-trash"> </i> Cerrar
                            </button>
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
