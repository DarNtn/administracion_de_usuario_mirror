<?php
include_once('header.php');
include_once './funciones/Link/dataTableLink.php';
?>
<link rel="stylesheet" href="assets/css/extra.css"/>
<script src="funciones/pagos/funcionesPago.js" type="text/javascript"></script>
<script src="funciones/pagos/funcionesOrdenes.js" type="text/javascript"></script>
<script src="assets/js/ValidarContrasena.js" type="text/javascript"></script>
<script src="assets/js/ValidarCedula.js" type="text/javascript"></script>
<!-- Inicio del Cabecera-->
<div class="panel" style="background: #50BFE6">
    <div class="panel-heading" style="color: white">

        <div class="row">

            <div class="col-md-2">
                <center><img src="assets/img/pagos.png" class="img-profile img-polaroid" width="70" height="65"></center>
            </div>
            <div class="col-md-8">
                <center><h4>Control y registros de cuentas</h4></center>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Cabecera-->
<!-- Inicio de Menu de Pagos -->
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Pagos vencidos</a></li>
    <li><a data-toggle="tab" href="#menu1">Pagos del mes</a></li>
    <!--<li><a data-toggle="tab" href="#menu2">Asignar pagos</a></li>-->
</ul>

<div class="tab-content">
    <!-- Inicio Primera tab ontenido -->
    <div id="home" class="tab-pane fade in active">
        <h4 class="text-center" style="margin: 0 0; padding: 0 0;"><label class="label label-warning">Consulta de Pagos Vencidos</label></h4>

        <div class="row">
            <div class="col-md-5" >
                <form id="formBusqueda" name="formBusqueda" method="post" action="">
                    <h6 id="texto" class="text-primary">Buscar Todos</h6>
                    <div class="input-group">
                        <input type="hidden" name="opcion" value="buscarPagosPendientes">
                        <input type="hidden" id="valor" name="valor" value="1">
                        <input id="cedula" name="buscar_cedula" placeholder="Buscar" class="form-control" type="text" disabled="">
                        <div class="input-group-btn">
                            Button and dropdown menu 
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#" onclick="valor.value = '1';
                                        texto.innerHTML = $(this)[0].text;
                                        cedula.disabled = true;">Buscar Todos</a></li>
                                <li><a href="#" onclick="valor.value = '2';
                                        texto.innerHTML = $(this)[0].text;
                                        cedula.disabled = false;">Buscar por Nombre Representante</a></li>
                                <li><a href="#" onclick="valor.value = '3';
                                        texto.innerHTML = $(this)[0].text;
                                        cedula.disabled = false;">Buscar por Cedula Representante</a></li>
                                <li><a href="#" onclick="valor.value = '4';
                                        texto.innerHTML = $(this)[0].text;
                                        cedula.disabled = false;">Buscar por Nombre de Alumno</a></li>
                            </ul>
                            <button type="submit" class="btn btn-default">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3 col-md-offset-4" style="margin-top: 30px">
                <button id="butom" class="btn btn-block btn-info">Enviar Pagos a Correo</button>
            </div>
        </div>
        <br>                    
        <form>
            <div class="table-responsive">
                <table id="tblPagosVencidos" class="mdl-data-table" cellspacing="0" style="width:100%;white-space: pre-line !important;">
                    <thead>
                        <tr>
                            <th><center><strong>N°</strong></center></th>
                    <th><center><strong>Estudiante</strong></center></th>
                    <th><center><strong>Concepto Pago</strong></center></th>                                    
                    <th><center><strong>Período</strong></center></th>
                    <th><center><strong>Mes</strong></center></th>
                    <th><center><strong>Fecha Vencimiento</strong></center></th>
                    <th><center><strong>Valor</strong></center></th>
                    <th class="noExport">&nbsp;</th>
                    <th>IdRepresentante</th>
                    <th>IdAlumno</th>
                    <th>Email</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot id="footer">
                        <tr>
                            <th colspan="8" style="text-align:right">Total:</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </form>     

    </div>
    <!-- Fin Primera tab ontenido -->
    <!-- Inicio Segundo tab ontenido -->
    <div id="menu1" class="tab-pane fade">

        <h4 class="text-center" style="margin: 0 0; padding: 0 0;"><label class="label label-info">Consulta de Pagos</label></h4>
        <!-- Inicio formulario de busqueda de representante-->
        <div class="row">
            <div class="col-md-5" >
                <form id="formBuscarRepresentantes" name="formBuscarRepresentantes" method="post" action="">
                    <h6 id="textopago" class="text-primary">Buscar por Cedula Representante</h6>
                    <div class="input-group">
                        <input type="hidden" name="opcion" value="buscarRepresentante">
                        <input type="hidden" id="valorRepresentante" name="valor" value="1">
                        <input id="bus" name="buscar_cedula" placeholder="Buscar" class="form-control" type="text">
                        <div class="input-group-btn">
                            Button and dropdown menu 
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#" onclick="valorRepresentante.value = '1';
                                        textopago.innerHTML = $(this)[0].text;">Buscar por Cedula Representante</a></li>
                                <li><a href="#" onclick="valorRepresentante.value = '2';
                                        textopago.innerHTML = $(this)[0].text;">Buscar por Nombres Representante</a></li>
                                <li><a href="#" onclick="valorRepresentante.value = '3';
                                        textopago.innerHTML = $(this)[0].text;">Buscar por Apellidos Representante</a></li>
                            </ul>
                            <button type="submit" class="btn btn-default">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><br>
        <!-- Fin formulario de busqueda de representante-->
        <form id="vistaRepresentante">
            <div class="row">
                <div class="col-md-4">
                    <input id="cedulaR" class="form-control" placeholder="Cédula" type="text" readonly=""/><br>
                </div>
                <div class="col-md-4">
                    <input id="nombresR" class="form-control" placeholder="Nombres" type="text" readonly=""><br>
                </div>
                <div class="col-md-4">
                    <input id="apellidosR" class="form-control" placeholder="Apellidos" type="text" readonly=""><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <input id="telefonoR" class="form-control" placeholder="Teléfono" type="text" readonly=""><br>
                </div>
                <div class="col-md-8">
                    <input id="direccionR" class="form-control" placeholder="Dirección" type="text" readonly=""/><br>
                </div>
            </div>
        </form>
        <!-- Inicio de tabla, alumno que posee el representante-->
        <div class="table-responsive" >                      
            <table id="tblRepresentados" class="mdl-data-table" cellspacing="0" style="width:100%;white-space: pre-line !important;">
                <thead>
                    <tr >
                        <td>N°</td>
                        <td>Cedula</td>
                        <td>Nombres </td>
                        <td>Apellidos</td>
                        <td>Representante</td>
                        <td>Direccion</td>
                        <td>Acciones</td>
                        <td>Id</td>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- Fin de tabla, alumno que posee el representante-->
        <!-- Inicio de Datos Facturas -->
        <form id="pagosF" method="post">
            <div class="row">
                <div class="col-md-2"><h6><label class="label label-info">Factura Unica:</label><input type="checkbox" id="cFactura" style="width:15px;height:15px;" checked="true"></h6></div>
                <div class="col-md-2"><h6><label class="label label-info">Numero de Factura:</label></h6></div>
                <div class="col-md-2"><input style="margin-top: 19px;" id="facturaU" type="number" name="nfactura[]" value="" class="form-control"></div>
                <div class="col-md-2"><h6><label class="label label-info">Forma de pago:</label></h6></div>
                <div class="col-md-2">
                    <select style="margin-top: 19px;" id="fpago" name="fpago" class="form-control">
                        <option value="1">Efectivo</option>
                        <option value="2">T.Crédito/T.Débito</option>
                        <option value="3">Cheque</option>
                        <option value="4">D.Electrónico</option>
                        <option value="5">Otros</option> 
                    </select>
                </div>
                <div class="col-md-2"><h6><label class="label label-primary" id="valorFacturado"></label></h6></div>
            </div>

            <div class="row" id="facturas">

                

            </div><br>
            <div class="col-md-4 col-md-offset-4">
                <button class="btn btn-block btn-primary">Registar Pagos</button>
            </div>
        </form>
        <!-- Fin de Datos Facturas -->
        <!-- Inicio de Modal Lista Representantes-->
        <div id="representantes" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg"> 
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Seleccione Representante</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive" >                      
                            <table id="tblRepresentantes" class="mdl-data-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr style="background:#55d9cb;color:#fff">
                                        <td>N°</td>
                                        <td>Cedula</td>
                                        <td>Nombres </td>
                                        <td>Apellidos</td>
                                        <td>Direccion</td>
                                        <td>Telefono</td>
                                        <td>IdRepresentante</td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="button" class="btn btn-primary"><strong><i class="icon-ok"></i> Seleccionar</strong></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Fin de Modal Lista Representantes -->
        <!-- Inicio de Modal de Ordenes -->
        <div id="ordenes" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Seleccione Valores a pagar</h4>
                    </div>
                    <div class="modal-body">
                        <h6 style="margin-top:0px"><label class="label label-info">Valor:<strong id="valorOrdenes">0</strong></label></h6>
                        <div class="table-responsive" >                      
                            <table id="tblResulOrdenes" class="mdl-data-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr style="background:#55d9cb;color:#fff">
                                        <td>N°</td>
                                        <th>Concepto Pago</th>                                    
                                        <th>Periodo</th>
                                        <th>Mes</th>
                                        <th>Fecha Vencimiento</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="valorO" type="button" class="btn btn-primary"><strong><i class="icon-ok"></i> Guardar</strong></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Fin de Modal de Ordenes -->
    </div>
    <!-- Fin Segundo tab ontenido -->
    <!-- Inicio Tercero tab ontenido -->
<!--    <div id="menu2" class="tab-pane fade">
        <h3>Menu 2</h3>
        <p>En Construcción</p>
    </div>-->
    <!-- Fin Tercero tab ontenido -->
</div>
<!-- Fin de Menu de Pagos -->
<?php
include_once('footer.php');
