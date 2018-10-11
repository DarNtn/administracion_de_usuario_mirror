<?php
include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
$opcion = "";
if (!empty($_GET['id'])) {
    $opcion = 'Modificar_estudiante2';
} else {
    $opcion = 'ingresar_estudiante';
}
?>

<link rel="stylesheet" href="assets/css/extra.css"/>
<script src="funciones/estudiantes/functionEstudiantesAcciones.js" type="text/javascript"></script>
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
                <center><h5>Registro de Estudiantes</h5></center>
            </div>
        </div>
    </div>
</div>

<!--Body-->
<div class="panel">
    <div class="panel-body">
        <?php
        $opcion = "";
        if (!empty($_GET['id'])) {
            $opcion = 'Modificar_estudiante2';
        } else {
            $opcion = 'ingresar_estudiante';
        }
        ?>
        <form id="formulario" enctype="multipart/form-data" method="post">
            <input type="hidden" name="opcion" value="<?php echo $opcion; ?>"/>
            <input type="hidden" id="id" name="id" value="">
            
            <!--Datos personales-->
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Datos Personales</legend>
                <div class="row">
                    <!--Cedula-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                            <input class="form-control" type="text" id="ced" name="cedula" placeholder="Cédula"/>
                        </div>
                        <br>
                    </div>
                    <!--Nombres-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input class="form-control" type="text" id="nombres" name="nombres" placeholder="Nombres" required=""/>
                        </div><br>
                    </div>
                    <!--Apellidos-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input class="form-control" type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required=""/>
                        </div><br>
                    </div>
                    <!--Lugar Nacimiento-->
                    <div class="col-lg-3">
                        <select id="lugar_nacimiento" name="lugar_nacimiento" class="form-control">
                            <?php
                            $t_lugares = $conexion->realizarConsulta("SELECT * FROM lugares;");
                            for ($l = 0; $l < sizeof($t_lugares); $l++) {
                                echo '<option value="' . $t_lugares[$l]['lugar_id'] . '">' . $t_lugares[$l]['provincia'] . ' - ' . $t_lugares[$l]['ciudad'] . '</option>';
                            }
                            ?>
                        </select>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <!--Dirección-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                            <input class="form-control" type="text" id="direccion" name="direccion" placeholder="Dirección" required=""/>
                        </div><br>
                    </div>
                    <!--Fecha de Nacimiento-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            <input class="form-control" type="date" id="fechaNac" name="fechaNac" placeholder="Fecha de nacimiento" onblur="calcularEdad(fechaNac.value, '#edad');" required=""/>
                        </div><br>
                    </div>
                    <!--Edad-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-exclamation-sign"></i></span>
                            <input class="form-control" type="text" id="edad" placeholder="Edad" disabled="true"/>
                        </div><br>
                    </div>
                    <!--Institución-->
                    <div class="col-lg-3">
                        <select id="tipoI" name="tipoI" class="form-control">
                            <?php
                            $t_instituto = $conexion->realizarConsulta("SELECT institucion_id as id,nombre as instituto FROM instituciones;");
                            for ($a = 0; $a < sizeof($t_instituto); $a++) {
                                echo '<option value="' . $t_instituto[$a]['id'] . '">' . $t_instituto[$a]['instituto'] . '</option>';
                            }
                            ?>
                        </select>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <!--Género-->
                    <div class="col-lg-3">
                        <select class="form-control" id="genero" name="genero">
                            <option value="">Escoja Genero</option>
                            <option value="1">Masculino</option>
                            <option value="2">Femenino</option>
                        </select><br>
                    </div>
                    <!--Pensión-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                            <input class="form-control" type="number" id="pension" name="pension" placeholder="Valor de pensión" required=""/>
                        </div><br>
                    </div>
                </div>
            </fieldset> 
            
            <br/>
            
            <!--Datos Médicos-->
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Datos Médicos</legend>
                <div class="row">
                    <!--Tiene discapacidad-->
                    <div class="col-lg-3">
                        <select id="tiene_discapacidad" name="tiene_discapacidad" class="form-control iinput" onChange="if (this.options[0].selected)
                                    porcentaje.disabled = true;
                                else
                                    porcentaje.disabled = false;
                                if (this.options[0].selected)
                                    tipoD.disabled = true;
                                else
                                    tipoD.disabled = false;">
                            <option value="NO" selected>SIN DISCAPACIDAD</option>
                            <option value="SI">CON DISCAPACIDAD</option>
                        </select><br>
                    </div>
                    <!--Porcentaje discapacidad-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                            <input class="form-control" type="number" id="porcentaje" name="porcentaje_discapacidad" placeholder="Porcentaje de discapacidad" min="0" disabled=""/>
                        </div>
                        <br>
                    </div>
                    <!--Tipo discapacidad-->
                    <div class="col-lg-3">
                        <select class="form-control" id="tipoD" name="tipo" disabled="">
                            <option value="">Escoja Capacidad Especial</option>
                            <option value="fisica">Física</option>
                            <option value="auditiva">Auditiva</option>
                            <option value="visual">Visual</option>
                            <option value="psiquica">Psíquica</option>
                            <option value="intelectual">Intelectual</option>
                            <option value="mental">Mental</option>
                        </select>
                    </div>
                    <!--Tipo de sangre-->
                    <div class="col-lg-3">
                        <select class="form-control" id="tipo_sangre" name="tipo_sangre">
                            <?php
                                $t_sangre = $conexion->realizarConsulta("SELECT idgrupo_sanguineo as id, nombre FROM grupo_sanguineo;");
                                for ($a = 0; $a < sizeof($t_sangre); $a++) {
                                    echo '<option value="' . $t_sangre[$a]['id'] . '">' . $t_sangre[$a]['nombre'] . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </fieldset>
            
            <br/>
            
            <!--Documentos-->
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Documentos</legend>
                <div class="row">
                    <!--Certificados-->
                    <div class="col-lg-6">
                        <div class="input-group-datos input-group-icon">
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn" style="background: #55d9cb;color: white">
                                        Certificado&hellip; <input type="file" name="certificado" style="display: none;" accept=".jpg">
                                    </span>
                                </label>
                                <input type="text" class="form-control iinput" readonly>
                            </div>

                        </div><br>
                    </div>
                    <!--Fotografía-->
                    <div class="col-lg-6">
                        <div class="input-group-datos input-group-icon">
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn" style="background: #55d9cb;color: white">
                                        Fotografia&hellip; <input type="file" name="imagen" style="display: none;" accept=".jpg">
                                    </span>
                                </label>
                                <input type="text" class="form-control iinput" readonly>
                            </div>
                        </div><br>
                    </div>
                </div>
            </fieldset>
            
            <br/>
            
            <!--Observaciones-->
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Observación</legend>
                <div class="row"> 
                    <div class="col-lg-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                            <textarea class="form-control" id="observacion" name="observacion" style="height: 10vh;max-height: 10vh"></textarea>
                        </div>
                        <br>
                    </div>
                </div>
            </fieldset>

            <br/>
            
            <!--Gestionar autorización-->
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Autorización</legend>
                <div class="row"> 
                    <div class="col-lg-12">
                        <a class="btn btn-success btn-block" style="overflow: hidden" href="#nuevo" role="button" data-toggle="modal" title="Nuevo Representante">
                            <span class="glyphicon glyphicon-user"></span> Gestionar
                        </a>
                    </div>
                </div>
            </fieldset>
            
            <br/><br/>
            
            <!--Seleccionar curso-->
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Curso</legend>
                <div class="row">
                    <div class="col-lg-12">
                        <select id="lugar_nacimiento" name="lugar_nacimiento" class="form-control">
                            <!--AQUÍ SE DEBE HACER UNA CONSULTA A LA BASE PARA EXTRAER TODOS LOS CURSOS CREADOS-->
                            <?php
                                //$t_lugares = $conexion->realizarConsulta("SELECT * FROM lugares;");
                                //for ($l = 0; $l < sizeof($t_lugares); $l++) {
                                //echo '<option value="' . $t_lugares[$l]['lugar_id'] . '">' . $t_lugares[$l]['provincia'] . ' - ' . $t_lugares[$l]['ciudad'] . '</option>';
                                //}
                            ?>
                        </select>
                    </div>
                </div>
            </fieldset>
            
            <br/><br/>
            
            <fieldset class="scheduler-border">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-info btn-block btn-sm" >
                             <i class="fa fa-save"> </i> Guardar
                         </button>
                    </div>
                </div>
            </fieldset>
            
<!--            <div class="row"><div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 col-lg-offset-7">
                    <p></p>
                    <a class="btn btn-success btn-block" style="overflow: hidden" href="#nuevo" role="button" data-toggle="modal" title="Nuevo Representante">
                        <span class="glyphicon glyphicon-user"></span>Gestionar</a>
                </div></div>-->
<!--            <div class="table-responsive">
                <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Cédula</th>
                            <th>Nombres </th>
                            <th>Apellidos</td>
                            <th>Estado civil</th>
                            <th>Parentesco</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>-->
            
        </form>
    </div>
</div>

<div id="nuevo" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">  
            <div class="modal-body">

                <center> <h3 style="color: #55d9cb;">Crear Representante</h3></center>

                <form id="formularioRepresentante" enctype="multipart/form-data"  method="post">
                    <div style="padding: 0em 3em 0em 3em;">
                        <input type="hidden" name="opcion" value="Guardar_representante"/>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                    <input class="form-control" type="text" id="cedulaR" name="cedula" placeholder="Cédula" onblur="datos(cedulaR.value);" required=""/>
                                </div><br>
                            </div>
                            <div class="col-lg-6">
                                <select class="form-control" id="tipoC" name="tipoC" required="">
                                    <option value="">Escoja estado</option>
                                    <option value="1">Soltero(a)</option>
                                    <option value="2">Casado(a)</option>
                                    <option value="3">Viudo(a)</option>
                                    <option value="4">Divorciado(a)</option>
                                    <option value="5">Unión de Hecho</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                    <input class="form-control" type="text" id="nombresR" name="nombres" placeholder="Nombres" required=""/>
                                </div><br>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                    <input class="form-control" type="text" id="apellidosR" name="apellidos" placeholder="Apellidos" required=""/>
                                </div><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input class="form-control" type="date" id="fechaN" name="fechaNac" placeholder="Fecha de nacimiento" onblur="calcularEdad(fechaN.value, '#edad2');" required=""/>
                                </div><br>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-exclamation-sign"></i></span>
                                    <input class="form-control"  type="text" id="edad2" placeholder="Edad" disabled="true"/>
                                </div><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                    <input class="form-control" type="text" id="direccionR" name="direccion" placeholder="Dirección" required=""/>
                                </div><br>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                    <input class="form-control" type="number" id="telefono" name="telefono" placeholder="Teléfono" required="true"/>
                                </div><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mail-forward"></i></span>
                                    <input class="form-control" type="email" id="mail" name="mail" placeholder="Email" required=""/>
                                </div><br>
                            </div>  

                            <div class="col-lg-6">
                                <div class="btn-group btn-group-justified">
                                    <input class="estado" type="radio" name="genero" value="1" id="gender-m" checked=""/>
                                    <label for="gender-m"><i class="fa fa-male"></i>Hombre</label>
                                    <input class="estado" type="radio" name="genero" value="2" id="gender-fem"/>
                                    <label for="gender-fem"><i class="fa fa-female" ></i>Mujer</label>
                                </div><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <select class="form-control" id="parentesco" name="parentesco" required="">
                                    <option value="">Escoja parentesco</option>
                                    <?php
                                    $parentesco = $conexion->realizarConsulta("SELECT * FROM parentesco;");
                                    for ($pa = 0; $pa < sizeof($parentesco); $pa++) {
                                        echo '<option value="' . $parentesco[$pa]['parentesco_id'] . '">' . $parentesco[$pa]['parntesco'] . '</option>';
                                    }
                                    ?>
                                </select><br>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group-datos input-group-icon">
                                    <div class="input-group">
                                        <label class="input-group-btn">
                                            <span class="btn" style="background: #55d9cb;color: white">
                                                Certificado&hellip; <input type="file" id="certificadoRepresentante" name="certificadoRepresentante" style="display: none;" accept=".jpg">
                                            </span>
                                        </label>
                                        <input type="text" class="form-control iinput" readonly>
                                    </div>

                                </div>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group-datos input-group-icon">
                                    <button type="submit" class="btn btn-info btn-block btn-sm" value="Guardar">
                                        <i class="fa fa-save"> </i> Guardar</button>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group-datos input-group-icon">
                                    <button class="btn btn-warning btn-block btn-sm" data-dismiss="modal" value="Cancelar">
                                        <i class="fa fa-trash"> </i> Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Fin del Cabecera-->
<?php
include_once('footer.php');
