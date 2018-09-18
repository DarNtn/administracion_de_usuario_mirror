<?php
header("Content-Type: application/json;charset=utf-8");
require_once('pagoModelo.php');
# Traer los datos de un usuario
$pagos = new Pago;
//if ($_POST['opcion'] == "idPeriodo") {
//    $idPeriodo=$_POST['id'];
//    echo ($pagos->respuestaJson($pagos->getId($idPeriodo)));
//}
//if ($_POST['opcion'] == "cedulaUsuario") {
//    $cedula=$_POST['cedula'];
//    echo ($usuario->respuestaJson($usuario->getCedula($cedula)));
//}
if ($_POST['opcion'] == "buscarPagosPendientes") {
    if(empty($_POST['buscar_cedula'])){
        $bus=' ';
    }else{
        $bus=$_POST['buscar_cedula'];
    }
    echo ($pagos->respuestaJson($pagos->get($bus,$_POST['valor'])));
}

if ($_POST['opcion'] == "buscarRepresentante") {
    if(empty($_POST['buscar_cedula']) || empty($_POST['valor'])){
        echo $pagos->mensajes("error","Algunos campos estan vacios");
    }else{
        echo ($pagos->respuestaJson($pagos->getRepresentantes($_POST['buscar_cedula'],$_POST['valor'])));
    }  
}

if ($_POST['opcion'] == "BuscarListaRepresentados") {
        echo ($pagos->respuestaJson($pagos->getRepresentados($_POST['idR']))); 
}

if ($_POST['opcion'] == "BuscarListaOrdenes") {
        echo ($pagos->respuestaJson($pagos->getOrdenesRepresentado($_POST['idE']))); 
}

//if($_POST['opcion']=="Guardar_periodos"){
//if(empty($_POST['anio_inicio']) || empty($_POST['anio_fin']) || empty($_POST['fecha_inicio']) || empty($_POST['fecha_fin']) || empty($_POST['estado'])){
//    echo $pagos->mensajes("error","Algunos campos estan vacios");
//}else{
//    echo $pagos->set($_POST['anio_inicio'],$_POST['anio_fin'],$_POST['fecha_inicio'],$_POST['fecha_fin'],$_POST['estado']);
//}
//}
//if ($_POST['opcion'] == "estadoPeriodo") {
//    $pagos->editEstadoPeriodo($_POST['id'],$_POST['estado']);
//    echo $pagos->mensajes('success', 'aqui');
//}
//if($_POST['opcion']=="Editar_periodos"){
//if(empty($_POST['id']) || empty($_POST['anio_inicio']) || empty($_POST['anio_fin']) || empty($_POST['fecha_inicio']) || empty($_POST['fecha_fin'])){
//    echo $pagos->mensajes("error","Algunos campos estan vacios");
//}else{
//    echo $pagos->edit($_POST['id'],$_POST['anio_inicio'],$_POST['anio_fin'],$_POST['fecha_inicio'],$_POST['fecha_fin']);
//}
//}
