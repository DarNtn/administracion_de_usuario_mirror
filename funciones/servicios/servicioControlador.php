<?php
header("Content-Type: application/json;charset=utf-8");
require_once('servicioModelo.php');
# Traer los datos de un usuario
$servicio = new Servicio();
if ($_POST['opcion'] == "idServicio") {
    $idServicio=$_POST['id'];
    echo ($servicio->respuestaJson($servicio->getId($idServicio)));
}
//if ($_POST['opcion'] == "cedulaUsuario") {
//    $cedula=$_POST['cedula'];
//    echo ($usuario->respuestaJson($usuario->getCedula($cedula)));
//}
if ($_POST['opcion'] == "listaServicios") {
    echo ($servicio->respuestaJson($servicio->get()));
}
if($_POST['opcion']=="Guardar_servicios"){
if(empty($_POST['nombre']) || empty($_POST['valor']) || empty($_POST['tipo']) || empty($_POST['estado'])){
    echo $servicio->mensajes("error","Algunos campos estan vacios");
}else{
    echo $servicio->set($_POST['nombre'],$_POST['valor'],$_POST['tipo'],$_POST['estado']);
}
}
if($_POST['opcion']=="Editar_servicios"){
if(empty($_POST['id']) || empty($_POST['nombre']) || empty($_POST['valor']) || empty($_POST['tipo']) || empty($_POST['estado'])){
    echo $servicio->mensajes("error","Algunos campos estan vacios");
}else{
    echo $servicio->edit($_POST['id'],$_POST['nombre'],$_POST['valor'],$_POST['tipo'],$_POST['estado']);
}
}
