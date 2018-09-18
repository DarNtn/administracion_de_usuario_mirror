<?php

include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
?>
<script src="funciones/periodo/funcionesPeriodo.js" type="text/javascript"></script>
<link href="assets/css/extra.css" rel="stylesheet" type="text/css"/>
<!-- Inicio del Cabecera-->
<div class="panel" style="background: #50BFE6">
    <div class="panel-heading" style="color: white">

        <div class="row">

            <div class="col-md-2">
                <center><img src="assets/img/date.png" class="img-circle img-polaroid" width="70" height="65"></center>
            </div>
            <div class="col-md-8">
                <center><h5>Registro de Períodos</h5></center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center><a href="#nuevo" role="button" class="btn btn-danger" data-toggle="modal">
                        <strong><i class="glyphicon glyphicon-plus"></i> </strong><strong class="hidden-xs">Ingresar Nuevo</strong><strong> Período</strong>
                    </a></center>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Cabecera-->
<!-- Parte del Tabla-->
<div class="table-responsive">
    <table id="tblPeriodos" class="mdl-data-table" cellspacing="0" width="100%">
        <thead>
        <th>N°</th>
        <th>Año Inicio</th>
        <th>Año Fin</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th class="noExport">Estado</th>
        <th class="noExport">Acción</th>
        <th>Id</th>
        </thead>
        <tbody></tbody>
    </table>
</div>
<!-- Parte del Tabla-->
<!-- Inicio del ModalNuevo-->
<div id="nuevo" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"> 
            <div class="modal-body">

                <center><h4 style="color: #55d9cb;">Registros de Período</h4></center>
                <form id="registarPeriodo" method="post">
                    <input type="hidden" name="opcion" value="Guardar_periodos"/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input class="form-control" type="number" name="anio_inicio" min="1990" max="2100" placeholder="Año inicio de período" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input class="form-control" type="number" name="anio_fin" min="1990" max="2100" placeholder="Año fin de período" required="true">
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input class="form-control" type="date" id="clave" name="fecha_inicio" placeholder="Fecha inicio de período" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input class="form-control" type="date" id="re-clave" name="fecha_fin" placeholder="Fecha fin de período" required="true"/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group btn-group-justified">
                                <input type="radio" class="estado" name="estado" value="1" checked="" id="estadoActivo"/>
                                <label for="estadoActivo"><i class="fa fa-power-off"></i> Activo</label>
                                <input type="radio" class="estado" name="estado" value="2" id="estadoInactivo" />
                                <label for="estadoInactivo" class=""><i class="fa fa-power-off"></i> Inactivo</label>
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
<!-- Inicio del ModalNuevo-->
<div id="editar" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"> 
            <div class="modal-body">

                <center><h4 style="color: #55d9cb;">Modificación de Período</h4></center>
                <form id="editarPeriodo" method="post">
                    <input type="hidden" name="opcion" value="Editar_periodos"/>
                    <input type="hidden" name="id" id="id" value=""/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input class="form-control" type="number" id="anio_inicio" name="anio_inicio" min="1990" max="2100" placeholder="Año inicio de período" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input class="form-control" type="number" id="anio_fin" name="anio_fin" min="1990" max="2100" placeholder="Año fin de período" required="true">
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input class="form-control" type="date" id="fecha_inicio" name="fecha_inicio" placeholder="Fecha inicio de período" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input class="form-control" type="date" id="fecha_fin" name="fecha_fin" placeholder="Fecha fin de período" required="true"/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
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
