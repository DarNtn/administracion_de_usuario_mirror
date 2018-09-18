<?php
header("Content-Type: application/json;charset=utf-8");
require_once('periodoModelo.php');
# Traer los datos de un usuario
$periodo = new Periodo();
if ($_POST['opcion'] == "idPeriodo") {
    $idPeriodo=$_POST['id'];
    echo ($periodo->respuestaJson($periodo->getId($idPeriodo)));
}
//if ($_POST['opcion'] == "cedulaUsuario") {
//    $cedula=$_POST['cedula'];
//    echo ($usuario->respuestaJson($usuario->getCedula($cedula)));
//}
if ($_POST['opcion'] == "listaPeriodos") {
    echo ($periodo->respuestaJson($periodo->get()));
}
if($_POST['opcion']=="Guardar_periodos"){
if(empty($_POST['anio_inicio']) || empty($_POST['anio_fin']) || empty($_POST['fecha_inicio']) || empty($_POST['fecha_fin']) || empty($_POST['estado'])){
    echo $periodo->mensajes("error","Algunos campos estan vacios");
}else{
    echo $periodo->set($_POST['anio_inicio'],$_POST['anio_fin'],$_POST['fecha_inicio'],$_POST['fecha_fin'],$_POST['estado']);
}
}
if ($_POST['opcion'] == "estadoPeriodo") {
    $periodo->editEstadoPeriodo($_POST['id'],$_POST['estado']);
    echo $periodo->mensajes('success', 'aqui');
}
if($_POST['opcion']=="Editar_periodos"){
if(empty($_POST['id']) || empty($_POST['anio_inicio']) || empty($_POST['anio_fin']) || empty($_POST['fecha_inicio']) || empty($_POST['fecha_fin'])){
    echo $periodo->mensajes("error","Algunos campos estan vacios");
}else{
    echo $periodo->edit($_POST['id'],$_POST['anio_inicio'],$_POST['anio_fin'],$_POST['fecha_inicio'],$_POST['fecha_fin']);
}
}
