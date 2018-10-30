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
<script src="assets/vendor/jquery/jquery-ui.js" type="text/javascript"></script>
<script>
    $(function() {
        $('#buscarR').autocomplete({
            source: "funciones/estudiantes/filtroRepresentantes.php",//['marciano', 'marcia','martillo','peluche','pera'] 
            select: function(){
                
            }
        });
    });
</script>

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
            $id = "";
            if (!empty($_GET['id'])) {
                $opcion = 'Modificar_estudiante2';
                $id = $_GET['id'];
            } else {
                $opcion = 'ingresar_estudiante';
            }
        ?>
        <form id="formulario" enctype="multipart/form-data" method="post">
            <input name="opcion" type="hidden" value="<?php echo $opcion; ?>"/>
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
            
            <!--Datos personales-->
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Datos Personales</legend>
                <div class="row">
                    <!--Cedula-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                            <input class="form-control" type="text" id="ced" name="cedula" placeholder="Cédula" value=""/>
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
                            <input class="form-control" type="number" step="0.01" id="pension" name="pension" placeholder="Valor de pensión" required=""/>
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
                        <select id="tiene_discapacidad" name="tiene_discapacidad" class="form-control input" onChange="if (this.options[0].selected)
                                    porcentaje.disabled = true;
                                else
                                    porcentaje.disabled = false;
                                if (this.options[0].selected)
                                    tipoD.disabled = true;
                                else
                                    tipoD.disabled = false;">
                            <option value="2" selected>SIN DISCAPACIDAD</option>
                            <option value="1">CON DISCAPACIDAD</option>
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
                    <div class="col-lg-12" >
                        <ul class="list-group" id="contenedorDocumentos">
                        </ul>
                        <div class="input-group-datos input-group-icon">
                            <div class="input-group">
                                <div id="selectorDocumentos">
                                    <!--<label for="exampleFormControlFile1">Example file input</label>-->
                                    <input type="file" class="form-control-file" id="inputDocumento" name="documento-1">
                                </div>
                            </div>

                        </div><br>
                    </div>
                    <!--Fotografía-->
                    <div class="col-lg-12">
                        <?php

                            $dir = "/funciones/estudiantes/archivos/fotos/" . $id . ".jpg";
                            echo '
                                <div class="text-center">
                                    <img src="' . $dir . '" width="200" height="170" id="imgFotografia" class="rounded mx-auto d-block" alt="El estudiante no posee fotografía" />
                                </div>'
                        ?>
                        <div class="input-group-datos input-group-icon">
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn" style="background: #55d9cb;color: white">
                                        Fotografia&hellip; <input type="file" id="inputFotografia" name="imagen" style="display: none;" accept=".jpg">
                                    </span>
                                </label>
                                <input type="text" class="form-control input" readonly>
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

<!-- Modal Gestionamiento de Autorización -->
<div id="nuevo" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">  
            <div class="modal-body">
                <div class="container-fluid">
                    <center> <h3 style="color: #55d9cb;">Gestionamiento de autorización</h3></center>

                    <form id="formularioRepresentante" enctype="multipart/form-data"  method="post">
                        <div>
                            <input type="hidden" name="opcion" value="Guardar_representante"/>
                            <div class="col-md-12">
                                <h5 style="margin-top: 0">Existente</h5><hr>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span>
                                    <input class="form-control" type="text" id="buscarR" name="busqueda" placeholder="Buscar registrado"/>                                        
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h5>Nuevo</h5><hr>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-vcard fa-fw"></i></span>
                                        <input class="form-control" type="text" id="cedulaR" name="cedula" placeholder="Cédula" onblur="datos(cedulaR.value);" required=""/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                        <input class="form-control" type="text" id="nombresR" name="nombres" placeholder="Nombres" required=""/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                        <input class="form-control" type="text" id="apellidosR" name="apellidos" placeholder="Apellidos" required=""/>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                        <select class="form-control" id="tipoC" name="tipoC" required="">
                                            <option value="">Estado civil</option>
                                            <option value="1">Soltero(a)</option>
                                            <option value="2">Casado(a)</option>
                                            <option value="3">Viudo(a)</option>
                                            <option value="4">Divorciado(a)</option>
                                            <option value="5">Unión de Hecho</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users fa-fw"></i></span>
                                        <select class="form-control" id="parentesco" name="parentesco" required="">
                                            <option value="">Escoja parentesco</option>
                                            <?php
                                            $parentesco = $conexion->realizarConsulta("SELECT * FROM parentesco;");
                                            for ($pa = 0; $pa < sizeof($parentesco); $pa++) {
                                                echo '<option value="' . $parentesco[$pa]['idparentesco'] . '">' . $parentesco[$pa]['parentesco'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-mobile fa-fw"></i></span>
                                        <input class="form-control" type="number" id="telefono" name="telefono" placeholder="Teléfono" required="true"/>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                                        <input class="form-control" type="text" id="direccionR" name="direccion" placeholder="Dirección" required=""/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input class="form-control" type="email" id="mail" name="mail" placeholder="Email" required=""/>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <a style="color: gray">Sexo</a>
                            <div class="btn-group btn-group-justified row">
                                <div class="col-md-4">
                                    <input class="estado" type="radio" name="genero" value="1" id="gender-m" checked=""/>
                                    <label class="form-control" for="gender-m"><i class="fa fa-male"></i> Hombre</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="estado" type="radio" name="genero" value="2" id="gender-fem"/>
                                    <label class="form-control" for="gender-fem"><i class="fa fa-female" ></i> Mujer</label>
                                </div>
                            </div><br>  
                            <div class="row">
                                <div class="col-md-1">
                                    <a style="color:gray">Cuenta</a>                                
                                </div>
                                <div class="col-md-2">
                                    <label class="switch">
                                        <input id="flag" name="checkCuenta" type="checkbox" onchange="
                                            $('input#usuario').prop('disabled', !$('#flag').is(':checked'));
                                            $('input#password').prop('disabled', !$('#flag').is(':checked'));
                                            if (!$('#flag').is(':checked')){
                                                $('input#usuario').val('');
                                                $('input#password').val('');
                                            }
                                        ">
                                        <span class="slider"></span>
                                    </label>                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
                                        <input class="form-control" type="text" id="usuario" name="usuario" placeholder="Usuario" disabled="true"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Contraseña" disabled="true"/>                                                                              
                                    </div>
                                </div>
                            </div><br>

                            <div class="col-md-12">
                                <h5>Función</h5><hr>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="funcion" id="padre" value="padre" checked>
                                <label class="form-check-label" for="padre">Padre/Madre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="funcion" id="representante" value="representante">
                                <label class="form-check-label" for="representante">Representante</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="funcion" id="retirar" value="retirar">
                                <label class="form-check-label" for="retirar">Autorizado a retirar</label>
                            </div>
                            <br>
                                                        
                            <div class="col-md-12">
                                <div class="input-group-datos input-group-icon">
                                    <button id="añadirR" class="btn btn-info btn-block btn-sm" value="Añadir">
                                        <i class="fa fa-plus"> </i> Añadir</button>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <h5>Lista de autorizados</h5><hr>
                            </div>
                            <div class="table-responsive col-md-12">
                                <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr class="success">
                                            <th>N°</th>
                                            <th>Cédula</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Estado Civil</th>
                                            <th>Parentesco</th>
                                            <th>Dirección</th>
                                            <th>Teléfono</th>
                                            <th>Correo</th>
                                            <th>Tipo</th>
                                            <th class="noExport">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="input-group-datos input-group-icon">
                                    <button type="submit" class="btn btn-success btn-block btn-sm" data-dismiss="modal" value="Save">
                                        <i class="fa fa-save"> </i> Guardar</button>
                                </div>
                            </div>                            
                        </div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</div>

<!-- Fin del Cabecera-->
<?php
include_once('footer.php');
