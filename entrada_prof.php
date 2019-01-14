<?php
include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
?>
<link rel="stylesheet" href="assets/css/extra.css"/>
<script src="funciones/bandejas/funcionesBandejas.js" type="text/javascript"></script>
<!-- Inicio del Cabecera-->
<div class="panel" style="background: #50BFE6">
    <div class="panel-heading" style="color: white">

        <div class="row">

            <div class="col-md-2">
                <center><img src="assets/img/curse.png" class="img-circle img-polaroid" width="70" height="65"></center>
            </div>
            <div class="col-md-8">
                <center><h5>Bandeja de Entrada</h5></center>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Cabecera-->
<!-- Inicio del Tabla-->
<div class="table-responsive" >
    <table id="tblEntrada" class="mdl-data-table" cellspacing="0" style="width: 100%">
        <thead>
        <th></th>
        <th style="text-align: left">Curso</th>
        <th style="text-align: left">Remitente</th>
        <th></th>
        <th style="text-align: left">Fecha</th>                
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

                <center><h5 style="color: #55d9cb;">Mensaje</h5></center>
                <form id="mensajeview">                    
                    <div class="row" style="margin: 5 0;">
                        <div class="col-md-4">
                            <label>Remitente: </label>
                        </div>
                        <div class="col-md-8">
                            <input disabled class="form-control" type="text" id='remitente'/>
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
<!-- Inicio del ModalNuevo-->
<div id="editar" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"> 
            <div class="modal-body">

                <center><h4 style="color: #55d9cb;">Modificación de Curso</h4></center>
                <form id="editarCurso" method="post">
                    <input type="hidden" name="opcion" value="Editar_cursos"/>
                    <input type="hidden" name="id" id="id" value=""/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre del Curso" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" id="nivel" name="nivel" required="">
                                <?php
                                for ($b = 0; $b < sizeof($t_nivel); $b++) {
                                    echo '<option value="' . $t_nivel[$b]['id'] . '">' . $t_nivel[$b]['estado'] . '</option>';
                                }
                                ?>
                            </select><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-times-o"></i></span>
                                <input class="form-control" type="text" id="jornada" name="jornada" placeholder="Jornada(Matutina,Vespertina)" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-delicious"></i></span>
                                <input class="form-control" type="text" id="paralelo" name="paralelo" placeholder="Paralelo(A,B,C,1,2,3)" required="true"/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                                <input class="form-control" type="number" id="cantidad"  name="cantidad" placeholder="Cantidad de Estudiantes" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-group btn-group-justified">
                                <input type="radio" class="estado" name="estado" value="1" checked="" id="estadoActivoEd"/>
                                <label for="estadoActivoEd"><i class="fa fa-power-off"></i> Activo</label>
                                <input type="radio" class="estado" name="estado" value="2" id="estadoInactivoEd" />
                                <label for="estadoInactivoEd" class=""><i class="fa fa-power-off"></i> Inactivo</label>
                            </div>
                        </div>
                    </div>
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
