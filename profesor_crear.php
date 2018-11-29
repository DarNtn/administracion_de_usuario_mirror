<?php
    include_once('header.php');
    include_once './funciones/Link/dataTableLink.php';
    $opcion = "";
    if (!empty($_GET['id'])) {
        $opcion = 'actualizarProfesor';
    } else {
        $opcion = 'crearProfesor';
    }
?>

<link rel="stylesheet" href="assets/css/extra.css"/>
<link rel="stylesheet" href="assets/css/jquery-ui.css"/>
<script src="funciones/profesor/profesorFunciones.js" type="text/javascript"></script>
<script src="assets/js/ValidarCedula.js" type="text/javascript"></script>
<script src="assets/js/calcularEdad.js" type="text/javascript"></script>
<script src="assets/js/inputfile.js" type="text/javascript"></script>
<script src="assets/vendor/jquery/jquery-ui.js" type="text/javascript"></script>

<!-- Inicio del Cabecera-->
<div class="panel" style="background: #50BFE6">
    <div class="panel-heading" style="color: white">

        <div class="row">

            <div class="col-md-2">
                <center><img src="assets/img/date.png" class="img-circle img-polaroid" width="70" height="65"></center>
            </div>
            <div class="col-md-8">
                <center><h5>Registro de Profesor</h5></center>
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
                $opcion = 'actualizarProfesor';
                $id = $_GET['id'];
            } else {
                $opcion = 'crearProfesor';
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
                            <input class="form-control" type="text" id="cedula" name="cedula" placeholder="Cédula" required="" onblur="validarCedula(cedula.value);"/>
                        </div>
                        <br>
                    </div>
                    <!--Nombres-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input class="form-control" type="text" name="nombres" placeholder="Nombres" required="true"/>
                        </div><br>
                    </div>
                    <!--Apellidos-->
                    <div class="col-lg-3">
                        <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control" type="text" name="apellidos" placeholder="Apellidos" required="true"/>
                        </div><br>
                    </div>
                    <!--Estado civil-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <select class="form-control" id="estadoCivil" name="estadoCivil" required="">
                                <option value="">Estado civil</option>                                            
                                <?php
                                $estados = $conexion->realizarConsulta("SELECT * FROM estado_civil;");
                                for ($pa = 0; $pa < sizeof($estados); $pa++) {
                                    echo '<option value="' . $estados[$pa]['estado_civil_id'] . '">' . $estados[$pa]['descripcion'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!--Fecha de Nacimiento-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input class="form-control" type="text" id="fechaNacimiento" name="fechaNacimiento" placeholder="Fecha de nacimiento" onfocus="(this.type = 'date')" onblur="calcularEdad(fechaNacimiento.value, '#edad');(this.type = 'text')" required="true"/>
                        </div><br>
                    </div>
                    <!--Edad-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>
                                <input class="form-control" type="text" id="edad" placeholder="Edad" disabled="true"/>
                        </div><br>
                    </div>
                    <!--Email-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input class="form-control" type="email" id="correo" name="correo" placeholder="Correo electrónico" required=""/>
                        </div>
                    </div>
                    <!---Años de experiencia-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-hourglass"></i></span>
                            <input class="form-control" type="number" id="anosExperiencia" name="anosExperiencia" placeholder="Años de experiencia" min="0" required=""/>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <!---Fecha desde que labora-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input class="form-control" type="text" id="fechaInicioLaboral" name="fechaInicioLaboral" placeholder="Fecha desde que labora" onfocus="(this.type = 'date')" onblur="(this.type = 'text')"/>
                        </div>
                    </div>                    
                    <!---NCargas-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                            <input class="form-control" type="number" id="nCargas" name="nCargas" placeholder="Cargas familiares" min="0" required=""/>
                        </div>
                    </div>                    
                    <!---Dirección-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                            <input class="form-control" type="text" id="direccion" name="direccion" placeholder="Dirección" required=""/>
                        </div>
                    </div>
                    <!--Teléfono-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-mobile fa-fw"></i></span>
                            <input class="form-control" type="text" id="telefono" name="telefono" placeholder="Teléfono" required=""/>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <!---Especialidad-->
<!--                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-plus-square"></i></span>
                            <select class="form-control" id="especialidad" name="especialidad"></select>
                        </div>
                    </div>                    -->
                    <!---Género-->
                    <div class="col-lg-3">
                        <select class="form-control" id="genero" name="genero">
                            <option value="">Escoja Genero</option>
                            <option value="1">Masculino</option>
                            <option value="2">Femenino</option>
                        </select><br>
                    </div>                    
                </div>
            </fieldset> 
            
            <br/>
            
            <!--Cuenta-->
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Cuenta</legend>
                <div class="row">
                    <!--Usuario-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
                            <input class="form-control" type="text" id="usuario" name="usuario" placeholder="Usuario"/>
                        </div>
                    </div>
                    <!--Contraseña-->
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Contraseña"/>                                                                              
                        </div>
                    </div>
                </div>
            </fieldset>
            
            <br><br>
            
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
            
            <br>
            
            <fieldset class="scheduler-border">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-info btn-block btn-sm" >
                             <i class="fa fa-save"> </i> Guardar
                         </button>
                    </div>
                </div>
            </fieldset>
            
        </form>
    </div>
</div>

                    