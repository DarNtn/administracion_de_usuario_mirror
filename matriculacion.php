<?php
include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
$id = "";
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}
?>
<link rel="stylesheet" href="assets/css/extra.css"/>
<script src="funciones/matriculacion/funcionesMatriculacion.js" type="text/javascript"></script>
<script src="assets/js/ValidarCedula.js" type="text/javascript"></script>
<script src="assets/js/calcularEdad.js" type="text/javascript"></script>

<script src="assets/js/inputfile.js" type="text/javascript"></script>
<!-- Inicio del Cabecera-->
<div class="panel" style="background: #50BFE6">
    <div class="panel-heading" style="color: white">

        <div class="row">

            <div class="col-md-2">
                <center><img src="assets/img/date.png" class="img-circle img-polaroid" width="70" height="65"></center>
            </div>
            <div class="col-md-8">
                <center><h5>Registros de Aula y Matriculacion</h5></center>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="idAlumno" value="<?php echo $id; ?>">




<div class="panel">
    <div class="panel-body">
        <form id="formulario" method="post">
            <input type="hidden" id="id" name="id" value="">
            <input type="hidden" name="opcion" value="Guardar_alumnoSalon">
            <center><h4 style="color: #55d9cb;">Datos del alumno</h4></center>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                        <input class="form-control" type="text" id="ced" name="cedula" placeholder="Cédula" readonly=""/>
                    </div>
                    <br>
                </div>
                <div class="col-lg-6">
                    <select class="form-control" id="tipoI" name="tipoI" disabled="">
                        <?php
                        $t_instituto = $conexion->realizarConsulta("SELECT institucion_id as id,nombre as instituto FROM instituciones;");
                        for ($a = 0; $a < sizeof($t_instituto); $a++) {
                            echo '<option value="' . $t_instituto[$a]['id'] . '">' . $t_instituto[$a]['instituto'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input class="form-control" type="text" id="nombres" name="nombres" placeholder="Nombres" readonly=""/>
                    </div>
                    <br>
                </div>
                <div class="col-lg-6">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input class="form-control" type="text" id="apellidos" name="apellidos" placeholder="Apellidos" readonly=""/>
                    </div>
                    <br>
                </div>
            </div>


            <center><h4 style="color: #55d9cb;">Datos del Representante</h4></center>
            <hr>                     
            <div class="table-responsive" >                      
                <table id="example" class="table table-hover display" cellspacing="0" width="100%">
                    <thead>
                        <tr style="background:#55d9cb;color:#fff">
                            <td>N°</td>
                            <td>Cedula</td>
                            <td>Nombres </td>
                            <td>Apellidos</td>
                            <td>Parentesco</td>
                            <td>Direccion</td>
                            <td>Telefono</td>
                            <td>Tipo</td>
                            <td></td>

                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <center><h4 style="color: #55d9cb;">Registre Curso y Matricula</h4></center>
            <hr>
            <?php $periodo = $conexion->realizarConsulta("SELECT periodo_id as id, anio_inicio as inicio,anio_fin as fin FROM periodo_electivo where estado_id=1;"); ?>
            <input type="hidden" name="periodo" value="<?php echo $periodo[0]['id']; ?>">
            <h5 style="color: #55d9cb;">Periodo Electivo Actual <?php echo $periodo[0]['inicio'] . ' ' . $periodo[0]['fin']; ?></h5>
            <div class="row">
                <div class="col-lg-6">
                    <select class="form-control" id="salon" name="salon">
                            <?php
                            $t_listaS = $conexion->realizarConsulta("SELECT s.salon_id as id,concat(c.nombre,' - ',c.paralelo,' - ',concat(pe.anio_inicio,'-',pe.anio_fin)) as nombre
                                    FROM asignar_profesor ap,salones s,cursos c,periodo_electivo pe
                                    where ap.salon_id=s.salon_id and s.estado_id=1 and s.curso_id=c.curso_id and s.periodo_id=pe.periodo_id group by ap.salon_id;");
                            for ($a = 0; $a < sizeof($t_listaS); $a++) {
                                echo '<option value="' . $t_listaS[$a]['id'] . '">' . $t_listaS[$a]['nombre'] . '</option>';
                            }
                            ?>
                        </select>
                </div>
                <div class="col-lg-6">
                    <select class="form-control" id="servicio" name="servicio">
                        <option value="3">Servicio Medio tiempo</option>
                        <option value="4">Servicio Completo tiempo</option>
                    </select>
                </div>
            </div>




            <div id="meses" class="row">
                <div class="col-lg-6">
                    <h5 class="etiqueta">Mes inicio</h5>
                     <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input class="form-control" type="month" id="mesI" name="mesI"/>
                    </div>
                    <br>
                </div>
                <div class="col-lg-6">
                    <h5 class="etiqueta">Mes Fin</h5>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input class="form-control" type="month" id="mesF" name="mesF"/>
                    </div>
                    <br>
                </div>
            </div>


            <script>

                $('#meses').on('change', function () {
                    var mI = new Date($('#mesI').val());
                    var mF = new Date($('#mesF').val());
                    var totalMese = Math.round(((mF - mI) / 1000 / 60 / 60 / 24 / 30)) + 1;
                    if ((totalMese) > 0) {


                        $('#totalM').val('Total de ' + (totalMese) + ' pension(es)');
                    } else {
                        $('#totalM').val('');
                    }
                });
            </script>      

            <div id="meses" class="row">
                <div class="col-lg-6">
                    <h5 class="etiqueta">Pensiones generadas</h5>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input class="form-control" type="text" id="totalM" disabled/>
                    </div>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group-datos input-group-icon">
                        <button type="submit" class="btn btn-info btn-block btn-sm" >
                            <i class="fa fa-save"> </i> Guardar</button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group-datos input-group-icon">
                        <a href="alumnos_1.php" class="btn btn-warning btn-block btn-sm">
                            <i class="fa fa-trash"> </i> Cancelar</a>
                    </div>
                </div>
            </div>


        </form>
    </div>
</div>









<!-- Fin del Cabecera-->
<?php
include_once('footer.php');
