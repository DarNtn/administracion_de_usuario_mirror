<?php
include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
?>
<link rel="stylesheet" href="assets/css/extra.css"/>
<script src="funciones/usuario/funcionesUsuario.js" type="text/javascript"></script>
<script src="assets/js/ValidarContrasena.js" type="text/javascript"></script>
<script src="assets/js/ValidarCedula.js" type="text/javascript"></script>
<!-- Inicio del Cabecera-->
<div class="panel" style="background: #50BFE6">
    <div class="panel-heading" style="color: white">

        <div class="row">

            <div class="col-md-2">
                <center><img src="assets/img/usuarios.png" class="img-circle img-polaroid" width="70" height="65"></center>
            </div>
            <div class="col-md-8">
                <center><h5>Registro & Control de Usuarios</h5></center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center><a href="#nuevo" role="button" class="btn btn-danger" data-toggle="modal">
                        <strong><i class="glyphicon glyphicon-plus"></i> </strong><strong class="hidden-xs">Ingresar Nuevo</strong><strong> Usuario</strong>
                    </a></center>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Cabecera-->
<!-- Inicio del Tabla-->
<div class="table-responsive">
    <table id="tblUsuarios" class="mdl-data-table" cellspacing="0" style="width: 100%">
        <thead>
        <th>N°</th>
        <th>Cedula</th>
        <th>Nombres</th>
        <th>Usuario</th>
        <th class="noExport">Clave</th>
        <th class="noExport">Tipo</th>
        <th class="noExport">Estado</th>
        <th class="noExport">Acción</th>
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

                <center><h4 style="color: #55d9cb;">Registro de Usuario</h4></center>
                <form id="registarUsuario" method="post">
                    <input type="hidden" name="opcion" value="Guardar_usuarios"/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                                <input class="form-control" type="text" id="ced" name="cedula" placeholder="Cedula" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control" type="text" name="nombre" placeholder="Nombres completos" required="true">
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
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input class="form-control" type="email"  name="email" placeholder="Ej: admin@alguien.com" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <select name="tipo" class="form-control" required="">
                                <option value="">Escoger Tipo de Usuario</option>
                                <option value="a">Administrador</option>
                                <option value="u">Usuario</option>
                            </select>
                        </div><br>
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
                <form id="editarUsuario" method="post">
                    <input type="hidden" name="opcion" value="Editar_usuarios"/>
                    <input type="hidden" name="id" id="id" value=""/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                                <input class="form-control" type="text" id="cedula" name="cedula" placeholder="Cedula" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombres completos" required="true">
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input class="form-control" type="password" id="claveEd" name="clave" placeholder="Clave" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input class="form-control" type="password" id="re-claveEd" name="re-clave" placeholder="Repetir Clave" required="true"/>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input class="form-control" type="email" id="email"  name="email" placeholder="Ej: admin@alguien.com" required="true"/>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <select name="tipo" id="tipo" class="form-control" required="">
                                <option value="">Escoger Tipo de Usuario</option>
                                <option value="a">Administrador</option>
                                <option value="u">Usuario</option>
                            </select>
                        </div><br>
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
