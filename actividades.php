<?php
include_once('header.php');
//session_start();
?>
<br>

<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel">
            <center>
                <h1>Cartelera de Actividades</h1>
            </center>
            <div class="panel-body">
                <div id="calendar" style="margin-top: 20px"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Evento-->
<div id="ModalEdit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button id="closeEd" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Fecha de Actividad</h4>
            </div>
            <form id="formEditActividad" class="" method="post">
                <input type="hidden" id="opcEditar" name="opcion" value="EditarActividad"/>
                <div class="modal-body">
                    <input type="hidden" name="id_actividad" id="id_actividad" value=""/><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Descripción de actividad</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" type="text" id="descripcionActividad" name="descripcionActividad" placeholder="Nombres" required=""/>
                            </div><br>
                        </div>
                        <div class="col-md-12">
                            <label>Fecha de Inicio</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-step-backward"></i></span>
                                <input class="form-control" type="date" id="inicioEd" name="fecha_inicio" required="true"/>
                            </div><br>
                        </div>

                        <div class="col-md-12">
                            <label>Fecha de Fin</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-step-forward"></i></span>
                                <input class="form-control" type="date" id="finEd" name="fecha_fin" required="true"/>
                            </div><br>
                        </div>
                    </div>
                    <center><p  id="diasTotalEd" style="padding-top: 10px;"></p></center>
                </div>
                <div class="modal-footer">
                    <button id="btnEditar" type="button" class="btn btn-primary">Editar</button>
                    <button id="btnBorrar" type="button" class="btn btn-danger">Eliminar</button>
                    <button id="btnCancelarEd" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- Fin de Modal Editar Evento-->

<!-- Modal Editar Evento-->
<div id="ModalAdd" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button id="closeEd" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Fecha de Actividad seleccionada</h4>
            </div>
            <form id="formAddActividad" class="" method="post">
                <input type="hidden" id="opcGuardar" name="opcion" value="GuardarActividad"/>
                <div class="modal-body">
                    <input type="hidden" id="id_actividad" value=""/><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Descripción de actividad</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" type="text" id="descripcionActividad" name="descripcionActividad" required=""/>
                            </div><br>
                        </div>
                        <div class="col-md-12">
                            <label>Fecha de Inicio</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-step-backward"></i></span>
                                <input class="form-control" type="date" id="inicioAdd" name="fecha_inicio" required="true"/>
                            </div><br>
                        </div>

                        <div class="col-md-12">
                            <label>Fecha de Fin</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-step-forward"></i></span>
                                <input class="form-control" type="date" id="finAdd" name="fecha_fin" required="true"/>
                            </div><br>
                        </div>
                    </div>
                    <center><p  id="diasTotalAdd" style="padding-top: 10px;"></p></center>
                </div>
                <div class="modal-footer">
                    <button id="btnAdd" type="button" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- Fin de Modal Editar Evento-->

<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery-3.2.1.min.js"></script>    

<script>

</script>

<script src="assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


<!--common script for all pages-->
<script src="assets/js/common-scripts.js"></script>

<!--external script for all pages-->
<script src="Plugins/gritter/js/jquery.gritter.js" type="text/javascript" ></script>
<script src="Plugins/gritter/gritter-conf.js" type="text/javascript" ></script>

<script src="Plugins/full_calendar/js/moment.min.js" type="text/javascript"></script>
<script src="Plugins/full_calendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="Plugins/full_calendar/js/locale-all.js" type="text/javascript"></script>

<script src="Plugins/SweetAlert2/js/sweetalert2.min.js" type="text/javascript"></script>
<script src="funciones/actividad/actividad.js" type="text/javascript"></script>

<!--end external script for all pages-->

</body>
</html>


