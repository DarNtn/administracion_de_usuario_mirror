<?php
include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
?>
<link rel="stylesheet" href="assets/css/extra.css"/>
<script src="funciones/curso/funcionesCurso.js" type="text/javascript"></script>
<!-- Inicio del Cabecera-->
<div class="panel" style="background: #50BFE6">
    <div class="panel-heading" style="color: white">

        <div class="row">

            <div class="col-md-2">
                <center><img src="assets/img/curse.png" class="img-circle img-polaroid" width="70" height="65"></center>
            </div>
            <div class="col-md-8">
                <center><h5>Registro & Control de Cursos</h5></center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center><a href="#nuevo" role="button" class="btn btn-danger" data-toggle="modal">
                        <strong><i class="glyphicon glyphicon-plus"></i> </strong><strong class="hidden-xs">Ingresar Nuevo</strong><strong> Curso</strong>
                    </a></center>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Cabecera-->
<!-- Inicio del Tabla-->
<div class="table-responsive" >
    <table id="tblCursos" class="mdl-data-table" cellspacing="0" style="width: 100%">
        <thead>
        <th>N°</th>
        <th>Curso</th>
        <th>Jornada</th>
        <th>Cantidad</th>
        <th>Paralelo</th>
        <th>Nivel</th>
        <th class="noExport">Estado</th>
        <th class="noExport">Acción</th>
        <th>nivelId</th>
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
                <form id="registarCurso" method="post">
                    <input type="hidden" name="opcion" value="Guardar_cursos"/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                <input class="form-control" type="text"  name="nombre" placeholder="Nombre del Curso" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" name="nivel" required="">
                                <?php
//                                $t_nivel = $conexion->realizarConsulta("SELECT nivel_id as id,nombre as estado FROM nivel_educacion");
//                                for ($a = 0; $a < sizeof($t_nivel); $a++) {
//                                    echo '<option value="' . $t_nivel[$a]['id'] . '">' . $t_nivel[$a]['estado'] . '</option>';
//                                }
                                ?>
                            </select><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-times-o"></i></span>
                                <input class="form-control" type="text" name="jornada" placeholder="Jornada(Matutina,Vespertina)" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-delicious"></i></span>
                                <input class="form-control" type="text" name="paralelo" placeholder="Paralelo(A,B,C,1,2,3)" required="true"/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                                <input class="form-control" type="number"  name="cantidad" placeholder="Cantidad de Estudiantes" required="true"/>
                            </div><br>
                        </div>
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
