<?php
include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
?>
<link rel="stylesheet" href="assets/css/extra.css"/>
<script src="funciones/salon/funcionesSalon.js" type="text/javascript"></script>
<!-- Inicio del Cabecera-->
<div class="panel" style="background: #50BFE6">
    <div class="panel-heading" style="color: white">

        <div class="row">

            <div class="col-md-2">
                <center><img src="assets/img/salon.png" class="img-circle img-polaroid" width="70" height="65"></center>
            </div>
            <div class="col-md-8">
                <center><h5>Registro & Control de Salones de Clases</h5></center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center><a href="#nuevo" role="button" class="btn btn-danger" data-toggle="modal">
                        <strong><i class="glyphicon glyphicon-plus"></i> </strong><strong class="hidden-xs">Ingresar Nuevo</strong><strong> Salon</strong>
                    </a></center>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Cabecera-->
<!-- Inicio del Tabla-->
<div class="table-responsive" >
    <table id="tblSalones" class="mdl-data-table" cellspacing="0" style="width:100%;white-space: pre-line !important;">
        <thead>
        <th>N°</th>
        <th>Nombre</th>
        <th>Paralelo</th>
        <th>Profesor/es</th>
        <th>Período</th>
        <th class="noExport">Estado</th>
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

                <center><h4 style="color: #55d9cb;">Registro de Curso</h4></center>
                <form id="registarSalon" method="post">
                    <input type="hidden" name="opcion" value="Guardar_salon_multiple"/>
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-control" name="curso" required="" >
                                <?php
                                $t_salon = $conexion->realizarConsulta("SELECT curso_id as id,nombre as salon,paralelo as para FROM cursos where estado_id=1");
                                for ($a = 0; $a < sizeof($t_salon); $a++) {
                                    echo '<option value="' . $t_salon[$a]['id'] . '">' . $t_salon[$a]['salon'] . ' ' . $t_salon[$a]['para'] . '</option>';
                                }
                                ?>
                            </select><br><br>
                            <select class="form-control" name="periodo" required="">
                                <?php
                                $t_periodos = $conexion->realizarConsulta("SELECT periodo_id as id, anio_inicio as inicio,anio_fin as fin FROM periodo_electivo where estado_id=1;");
                                for ($c = 0; $c < sizeof($t_periodos); $c++) {
                                    echo '<option value="' . $t_periodos[$c]['id'] . '">' . $t_periodos[$c]['inicio'] . ' - ' . $t_periodos[$c]['fin'] . '</option>';
                                }
                                ?>
                            </select><br><br>
                            <div class="btn-group btn-group-justified">
                                <input type="radio" class="estado" name="estado" value="1" checked="" id="estadoActivo"/>
                                <label for="estadoActivo"><i class="fa fa-power-off"></i> Activo</label>
                                <input type="radio" class="estado" name="estado" value="2" id="estadoInactivo" />
                                <label for="estadoInactivo" class=""><i class="fa fa-power-off"></i> Inactivo</label>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" name="profesor[]" multiple size="6" required="" title="Use Ctrl+click para hacer una selección multiple">
                                <?php
                                $t_profesor = $conexion->realizarConsulta("SELECT p.personal_id as id, p.nombres as nombre, p.apellidos as apellido 
                                                                            FROM personal p,especialidades e 
                                                                                WHERE p.especialidad_id=e.especialidad_id and e.categoria_empleo_id=1 and p.estado_id=1;");
                                for ($b = 0; $b < sizeof($t_profesor); $b++) {
                                    echo '<option value="' . $t_profesor[$b]['id'] . '" style="padding:8px;border: 1px solid rgba(128, 128, 128, 0.36);">' . $t_profesor[$b]['nombre'] . ' ' . $t_profesor[$b]['apellido'] . '</option>';
                                }
                                ?>
                            </select>
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

                <center><h4 style="color: #55d9cb;">Modificación de Curso</h4></center>
                <form id="editarSalon" method="post">
                    <input type="hidden" name="opcion" value="Editar_salon"/>
                    <input type="hidden" name="id" id="id" value=""/>
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-control" id="curso" name="curso" required="" >
                                <?php
                                for ($d = 0; $d < sizeof($t_salon); $d++) {
                                    echo '<option value="' . $t_salon[$d]['id'] . '">' . $t_salon[$d]['salon'] . ' ' . $t_salon[$d]['para'] . '</option>';
                                }
                                ?>
                            </select><br><br>
                            <select class="form-control" id="periodo" name="periodo" required="">
                                <?php
                                for ($e = 0; $e < sizeof($t_periodos); $e++) {
                                    echo '<option value="' . $t_periodos[$e]['id'] . '">' . $t_periodos[$e]['inicio'] . ' - ' . $t_periodos[$e]['fin'] . '</option>';
                                }
                                ?>
                            </select><br><br>
                            <div class="btn-group btn-group-justified">
                                <input type="radio" class="estado" name="estado" value="1" checked="" id="estadoActivoEd"/>
                                <label for="estadoActivoEd"><i class="fa fa-power-off"></i> Activo</label>
                                <input type="radio" class="estado" name="estado" value="2" id="estadoInactivoEd" />
                                <label for="estadoInactivoEd" class=""><i class="fa fa-power-off"></i> Inactivo</label>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" id="profesor" name="profesor[]" multiple size="6" required="" title="Use Ctrl+click para hacer una selección multiple">
                                <?php
                                for ($f = 0; $f < sizeof($t_profesor); $f++) {
                                    echo '<option value="' . $t_profesor[$f]['id'] . '" style="padding:8px;border: 1px solid rgba(128, 128, 128, 0.36);">' . $t_profesor[$f]['nombre'] . ' ' . $t_profesor[$f]['apellido'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div><br>
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
