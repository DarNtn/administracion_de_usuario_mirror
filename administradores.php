<?php
include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
?>
<link rel="stylesheet" href="assets/css/extra.css"/>
<script src="funciones/administradores/funcionesAdministradores.js" type="text/javascript"></script>
<script src="assets/js/ValidarContrasena.js" type="text/javascript"></script>
<script src="assets/js/ValidarCedula.js" type="text/javascript"></script>
<script src="assets/js/inputfile.js" type="text/javascript"></script>


<!-- Inicio del Cabecera-->
<div class="panel" style="background: #50BFE6">
    <div class="panel-heading" style="color: white">

        <div class="row">

            <div class="col-md-2">
                <center><img src="assets/img/personal.png" class="img-circle img-polaroid" width="70" height="65"></center>
            </div>
            <div class="col-md-8">
                <center><h5>Registro & Control de Administradores</h5></center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center><a href="#nuevo" role="button" class="btn btn-danger" data-toggle="modal" id="ingresarNuevoBoton">
                        <strong><i class="glyphicon glyphicon-plus"></i> </strong><strong class="hidden-xs">Ingresar Nuevo</strong><strong> Administrador</strong>
                    </a></center>
            </div>
        </div>
    </div>
</div>

<!-- // nombre
// apellido
// correo
// foto (null)
// cedula
// usuarios_usuario_id not null
// cedula_copy1 (null) 

usuario
clave
tipo
estado_id

-->

<!-- usuario | clave  | tipo | usuario_id | estado_id  -->
<!-- Inicio del ModalNuevo-->
<div id="nuevo" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"> 
            <div class="modal-body">

                <center><h4 style="color: #55d9cb;">Registros de Adminstrador</h4></center>
                <form id="registarAdministrador" enctype="multipart/form-data" method="post" >
                    <input type="hidden" name="opcion" value="Guardar_administrador"/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                                <input class="form-control" type="text" id="ced" name="cedula" placeholder="Cédula" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                <input class="form-control" type="email" name="correo" placeholder="Email" required=""/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control" type="text" name="usuario" placeholder="Usuario" required=""/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input class="form-control" type="password" id="clavecorreo" name="clavecorreo" placeholder="Clave Correo" required=""/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control" type="text" name="nombre" placeholder="Nombres del Adminstrador" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control" type="text" name="apellido" placeholder="Apellidos del Adminstrador" required="true"/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input class="form-control" type="password" id="clave" name="clave" placeholder="Clave" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input class="form-control" type="password" id="re-clave" name="re-clave" placeholder="Repetir Clave" required="true"/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group btn-group-justified">
                                <input type="radio" class="estado" name="estado_id" value="1" checked="" id="estadoActivo"/>
                                <label for="estadoActivo"><i class="fa fa-power-off"></i> Activo</label>
                                <input type="radio" class="estado" name="estado_id" value="2" id="estadoInactivo" />
                                <label for="estadoInactivo" class=""><i class="fa fa-power-off"></i> Inactivo</label>
                            </div>
                        </div>
                    </div>
                    <!--<br>-->
<!--                    <div class="row">
                      <div class="col-lg-12">
                           <?php
//                          $dir = "/funciones/administradores/archivos/fotos/" . $id . ".jpg";
//                          echo '
//                              <div class="text-center">
//                                  <img src="' . $dir . '" width="200" height="170" id="imgFotografia" class="rounded mx-auto d-block" alt="El administrador no posee fotografía" />
//                              </div>'
                          ?>
                          <div class="input-group-datos input-group-icon">
                              <div class="input-group">
                                  <label class="input-group-btn">
                                      <span class="btn" style="background: #55d9cb;color: white">
                                          Fotografia&hellip; <input type="file" id="inputFotografia" style="display: none;" accept=".jpg">
                                      </span>
                                  </label>
                                  <input type="text" class="form-control input" name="foto" readonly>
                              </div>
                        </div>
                      </div>
                    </div>
                    <br>-->
<!--                    <br>
                    <br>-->
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
                <center><h4 style="color: #55d9cb;">Modificación de Usuario</h4></center>
                <form id="editarAdministrador" method="post" value="Editar_usuario">
                    <input type="hidden" name="opcion" value="Editar_usuarios"/>
                    <input type="hidden" name="usuario_id" id="usuario_id" value=""/>
                    <input type="hidden" name="admin_id" id="admin_id" value=""/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">Cedula: </span>
                                <input class="form-control" type="text" id="cedula" name="cedula" placeholder="Cedula" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">Correo: </span>
                                <input class="form-control" type="email" name="correo" id="correo" placeholder="Email" required=""/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">Usuario: </span>
                                <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuario" required=""/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input class="form-control" type="password" id="clavecorreo_edit" name="clavecorreo" placeholder="Clave Correo" required=""/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">Nombre: </span>
                                <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombres del Adminstrador" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">Apellido: </span>
                                <input class="form-control" type="text" name="apellido" id="apellido" placeholder="Apellidos del Adminstrador" required="true"/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input class="form-control" type="password" id="clave_edit" name="clave" placeholder="Clave" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input class="form-control" type="password" id="re_clave_edit" name="re-clave" placeholder="Repetir Clave" required="true"/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group btn-group-justified">
                                <input type="radio" class="estado" name="estado_id" value="1" checked="" id="estadoActivoEd"/>
                                <label for="estadoActivoEd"><i class="fa fa-power-off"></i> Activo</label>
                                <input type="radio" class="estado" name="estado_id" value="2" id="estadoInactivoEd" />
                                <label for="estadoInactivoEd" class=""><i class="fa fa-power-off"></i> Inactivo</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" id="btn_enviar_actualizar" class="btn btn-info btn-block btn-sm" value="Guardar">
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
<!-- Fin del ModalEditar-->
<!-- Inicio del Tabla-->
<div class="table-responsive">
    <table id="tblAdministradores" class="mdl-data-table" cellspacing="0" style="width: 100%">
        <thead>
        <th>N°</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Usuario</th>
        <th>Correo</th>
        <th>Cedula</th>
        <th>Estado</th>
        <th>Cambiar Estado</th>
        <th>Editar</th>
        </thead>
        <tbody></tbody>
    </table>
</div>
<!-- Fin del Tabla-->

<!-- <div class="row">
                      <div class="col-lg-12">
                      <?php

$dir = "/funciones/administradores/archivos/fotos/" . $id . ".jpg";
echo '
    <div class="text-center">
        <img src="' . $dir . '" width="200" height="170" id="imgFotografia" class="rounded mx-auto d-block" alt="El administrador no posee fotografía" />
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
</div>
</div>
<br>
<br>
<br>
<br> -->
<?php
