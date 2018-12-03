<?php
include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
?>
<link rel="stylesheet" href="assets/css/extra.css"/>
<script src="funciones/asignaciones/funcionesAsignacion.js" type="text/javascript"></script>
<!-- Inicio del Cabecera-->
<div class="panel" style="background: #50BFE6">
    <div class="panel-heading" style="color: white">

        <div class="row">

            <div class="col-md-2">
                <center><img src="assets/img/salon.png" class="img-circle img-polaroid" width="70" height="65"></center>
            </div>
            <div class="col-md-8">
                <center><h5>Asignaciones Curso - Dirigente</h5></center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center><a href="#nuevo" role="button" class="btn btn-danger" data-toggle="modal">
                    <strong><i class="glyphicon glyphicon-plus"></i> </strong><strong class="hidden-xs">Nueva Asignación</strong>
                </a></center>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Cabecera-->
<!-- Inicio del Tabla-->
<div class="table-responsive" >
    <table id="tblAsignaciones" class="mdl-data-table" cellspacing="0" style="width:100%;white-space: pre-line !important;">
        <thead>
        <th>N°</th>
        <th>Curso</th>
        <th>Nivel</th>
        <th>Paralelo</th>
        <th>Jornada</th>        
        <th>Período</th>
        <th>Dirigente</th>
        <th class="noExport">Acción</th>    
        <th>Id</th>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-- Fin del Tabla-->
<!-- Inicio del ModalNuevo-->
<div id="nuevo" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"> 
            <div class="modal-body">

                <center><h4 style="color: #55d9cb;">Asignar Dirigente</h4></center>
                <form id="asignarDirigente" method="post">
                    <input type="hidden" name="opcion" value="Asignar_dirigente"/>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="jornada">Jornada</label>
                            <select class="form-control" id="jornada" name="jornada" required="" title="Jornada">
                                <option selected disabled style="display:none;" value="">Seleccione jornada</option>
                                <?php
                                $t_salon = $conexion->realizarConsulta("SELECT DISTINCT jornada FROM cursos where estado_id=1");                                                                
                                for ($a = 0; $a < sizeof($t_salon); $a++) {
                                    echo '<option value="' . $t_salon[$a]['jornada'] . '">' . $t_salon[$a]['jornada'] . '</option>';
                                }                                                                
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="curso">Curso</label>
                            <select class="form-control" id="curso" name="curso" required="" title="Curso">
                                <option selected disabled style="display:none;" value="">Seleccione curso</option>                                
                                <option disabled value="-">Seleccionar jornada primero</option>
                            </select>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="paralelo">Paralelo</label>
                            <select class="form-control" id="paralelo" name="paralelo" required="" title="Paralelo">
                                <option selected disabled style="display:none;" value="">Seleccione paralelo</option>
                                <option disabled value="-">Seleccionar curso primero</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="dirigente">Dirigente</label>
                            <select class="form-control" name="dirigente" required="" title="Dirigente">
                                <option selected disabled style="display:none;" value="">Seleccione dirigente</option>
                                <?php
                                $t_profesor = $conexion->realizarConsulta("SELECT p.personal_id as id, p.nombres as nombre, p.apellidos as apellido 
                                                                            FROM personal p");
                                for ($b = 0; $b < sizeof($t_profesor); $b++) {
                                    echo '<option value="' . $t_profesor[$b]['id'] . '">' . $t_profesor[$b]['nombre'] . ' ' . $t_profesor[$b]['apellido'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--div class="col-md-4">
                            <label for="periodo">Periodo</label>
                            <select class="form-control" name="periodo" required="">
                        
                                <?php
                                /*$t_periodos = $conexion->realizarConsulta("SELECT periodo_id as id, anio_inicio as inicio,anio_fin as fin FROM periodo_electivo where estado_id=1;");
                                for ($c = 0; $c < sizeof($t_periodos); $c++) {
                                    echo '<option value="' . $t_periodos[$c]['id'] . '">' . $t_periodos[$c]['inicio'] . ' - ' . $t_periodos[$c]['fin'] . '</option>';
                                }*/
                                ?>
                            </select>
                        </div-->
                    </div><br>                    
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
<!-- Inicio del ModalEditar-->
<div id="editar" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"> 
            <div class="modal-body">

                <center><h4 style="color: #55d9cb;">Cambiar dirigente</h4></center>                
                <form id="cambiarDirigente" method="post">
                    <input type="hidden" name="opcion" value="Cambiar_dirigente"/>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="Ejornada">Jornada</label>
                            <select disabled class="form-control" id="Ejornada" name="Ejornada" required="">
                                <option value="" id="jornada_edit"></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="Ecurso">Curso</label>
                            <select disabled class="form-control" id="Ecurso" name="Ecurso" required="" title="Curso">
                                <option value="" id="curso_edit"></option>
                            </select>
                        </div>                        
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="Eparalelo">Paralelo</label>
                            <select disabled class="form-control" id="Eparalelo" name="Eparalelo" required="" title="Paralelo">
                                <option value="" id="paralelo_edit"></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="Edirigente">Dirigente</label>
                            <select class="form-control" id="Edirigente" name="Edirigente" required="" title="Dirigente">
                                <option selected disabled style="display:none;" value="">Seleccione dirigente</option>
                                <?php
                                $profesor = $conexion->realizarConsulta("SELECT p.personal_id as id, p.nombres as nombre, p.apellidos as apellido 
                                                                            FROM personal p");
                                for ($b = 0; $b < sizeof($profesor); $b++) {
                                    echo '<option value="' . $profesor[$b]['id'] . '">' . $profesor[$b]['nombre'] . ' ' . $profesor[$b]['apellido'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        
                    </div><br>                    
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
