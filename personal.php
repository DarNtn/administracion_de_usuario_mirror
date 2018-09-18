<?php
include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
?>
<link rel="stylesheet" href="assets/css/extra.css"/>
<script src="funciones/personal/funcionesPersonal.js" type="text/javascript"></script>
<script src="assets/js/ValidarCedula.js" type="text/javascript"></script>
<script src="assets/js/calcularEdad.js" type="text/javascript"></script>
<script src="assets/js/inputfile.js" type="text/javascript"></script>
<!-- Inicio del Cabecera-->
<div class="panel" style="background: #50BFE6">
    <div class="panel-heading" style="color: white">

        <div class="row">

            <div class="col-md-2">
                <center><img src="assets/img/personal.png" class="img-circle img-polaroid" width="70" height="65"></center>
            </div>
            <div class="col-md-8">
                <center><h5>Registro & Control de Personal</h5></center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center><a href="#nuevo" role="button" class="btn btn-danger" data-toggle="modal">
                        <strong><i class="glyphicon glyphicon-plus"></i> </strong><strong class="hidden-xs">Ingresar Nuevo</strong><strong> Postulante</strong>
                    </a></center>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Cabecera-->
<!-- Inicio del Tabla-->
<div class="table-responsive">
    <table id="tblPersol" class=" mdl-data-table" cellspacing="0" style="width:100%;white-space: pre-line !important;">
        <thead>
        <th>N°</th>
        <th>Cédula</th>
        <th>Nombres y Apellidos</th>
        <th>Especialidad</th>
        <th>Email</th>
        <th>Teléfono</th>
<!--        <th>Edad</th>-->
<!--        <th>Años de servicio</th>-->
        <th class="noExport">Estado</th>
<!--        <th class="noExport">Curriculum</th>-->
        <th class="noExport">Acción</th>
<!--        <th>genero</th>-->
        <th>Categoria</th>
        <th>Id</th>
        </thead>
        <tbody></tbody>
    </table>
</div>
<!-- Fin del Tabla-->
<!-- Inicio del ModalNuevo-->
<div id="nuevo" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"> 
            <div class="modal-body">

                <center><h4 style="color: #55d9cb;">Registros de Postulantes</h4></center>
                <form id="registarPersonal" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="opcion" value="Guardar_personal"/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                                <input class="form-control" type="text" id="ced" name="cedula" placeholder="Cédula" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" name="tipoC" required="">
                                <option value="">Escoja Estado Civil</option>
                                <option value="1">Soltero(a)</option>
                                <option value="2">Casado(a)</option>
                                <option value="3">Viudo(a)</option>
                                <option value="4">Divorciado(a)</option>
                                <option value="5">Unión de Hecho</option>
                            </select><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control" type="text" name="nombres" placeholder="Nombres del Postulante" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control" type="text" name="apellidos" placeholder="Apellidos del Postulante" required="true"/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input class="form-control" type="text" id="fechaNac" name="fechaNac" placeholder="Fecha de nacimiento" onfocus="(this.type = 'date')" onblur="calcularEdad(fechaNac.value, '#edad');(this.type = 'text')" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>
                                <input class="form-control" type="text" id="edad" placeholder="Edad" disabled="true"/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-hourglass"></i></span>
                                <input class="form-control" type="number" name="aniosE" placeholder="Años de experiencia" min="0" required=""/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                                <input class="form-control" type="number" name="cargas" placeholder="Cargas familiares" min="0" required=""/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input class="form-control" type="text" name="fechaLab" placeholder="Fecha desde que labora" onfocus="(this.type = 'date')" onblur="(this.type = 'text')"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn" style="background: #55d9cb;color: white">
                                        Curriculum&hellip; <input type="file" name="archivo" style="display: none;" accept=".xlsx,.xls,.doc, .docx,.pdf">
                                    </span>
                                </label>
                                <input type="text" class="form-control iinput" readonly>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-plus-square"></i></span>
                                <select class="form-control" id="categoria" name="categoria">
                                    <?php
                                    $t_categoria = $conexion->realizarConsulta("SELECT categoria_empleo_id as categoria,tipo FROM categorias_empleo");
                                    for ($c = 0; $c < sizeof($t_categoria); $c++) {
                                        echo '<option value="' . $t_categoria[$c]['categoria'] . '">' . $t_categoria[$c]['tipo'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-plus-square"></i></span>
                                <select class="form-control" id="especialidad" name="especialidad">
                                </select>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input class="form-control" type="text" name="direccion" placeholder="Dirección" required=""/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input class="form-control" type="number" name="telefono" placeholder="Teléfono" required=""/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                <input class="form-control" type="email" name="mail" placeholder="Email" required=""/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-group btn-group-justified">
                                <input type="radio" class="estado" name="genero" value="1" checked="" id="generoMale"/>
                                <label for="generoMale"><i class="fa fa-male"></i> Masculino</label>
                                <input type="radio" class="estado" name="genero" value="2" id="generoFemale" />
                                <label for="generoFemale" class=""><i class="fa fa-female"></i> Femenino</label>
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

                <center><h4 style="color: #55d9cb;">Modificación de Usuario</h4></center>
                <form id="editarPersonal" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="opcion" value="Editar_personal"/>
                    <input type="hidden" name="id" id="id" value=""/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                                <input class="form-control" type="text" id="cedula" name="cedula" placeholder="Cédula" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" id="tipoC" name="tipoC" required="">
                                <option value="">Escoja Estado Civil</option>
                                <option value="1">Soltero(a)</option>
                                <option value="2">Casado(a)</option>
                                <option value="3">Viudo(a)</option>
                                <option value="4">Divorciado(a)</option>
                                <option value="5">Unión de Hecho</option>
                            </select><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control" type="text" id="nombres" name="nombres" placeholder="Nombres del Postulante" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control" type="text" id="apellidos" name="apellidos" placeholder="Apellidos del Postulante" required="true"/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input class="form-control" type="text" id="fechaNacEd" name="fechaNac" placeholder="Fecha de nacimiento" onfocus="(this.type = 'date')" onblur="calcularEdad(this.value, '#edadEd');(this.type = 'text')" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>
                                <input class="form-control" type="text" id="edadEd" placeholder="Edad" disabled="true"/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-hourglass"></i></span>
                                <input class="form-control" type="number" id="aniosE" name="aniosE" placeholder="Años de experiencia" min="0" required=""/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                                <input class="form-control" type="number" id="cargas" name="cargas" placeholder="Cargas familiares" min="0" required=""/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input class="form-control" type="text" id="fechaLab" name="fechaLab" placeholder="Fecha desde que labora" onfocus="(this.type = 'date')" onblur="(this.type = 'text')"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn" style="background: #55d9cb;color: white">
                                        Curriculum&hellip; <input type="file" name="archivo" style="display: none;" accept=".xlsx,.xls,.doc, .docx,.pdf">
                                    </span>
                                </label>
                                <input type="text"  id="archivo" class="form-control iinput" readonly>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-plus-square"></i></span>
                                <select class="form-control" id="categoriaM" name="categoria">
                                    <?php
                                    for ($c = 0; $c < sizeof($t_categoria); $c++) {
                                        echo '<option value="' . $t_categoria[$c]['categoria'] . '">' . $t_categoria[$c]['tipo'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-plus-square"></i></span>
                                <select class="form-control" id="especialidadM" name="especialidad">
                                </select>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input class="form-control" type="text" id="direccion" name="direccion" placeholder="Dirección" required=""/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input class="form-control" type="number" id="telefono" name="telefono" placeholder="Teléfono" required=""/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                <input class="form-control" type="email" id="mail" name="mail" placeholder="Email" required=""/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-group btn-group-justified">
                                <input type="radio" class="estado" name="genero" value="1" checked="" id="generoMaleEd"/>
                                <label for="generoMaleEd"><i class="fa fa-male"></i> Masculino</label>
                                <input type="radio" class="estado" name="genero" value="2" id="generoFemaleEd" />
                                <label for="generoFemaleEd" class=""><i class="fa fa-female"></i> Femenino</label>
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


