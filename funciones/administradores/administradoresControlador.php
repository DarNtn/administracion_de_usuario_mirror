<?php
header("Content-Type: application/json;charset=utf-8");
require_once('administradoresModelo.php');
# Traer los datos de un usuario
$usuario = new Usuario();
if ($_POST['opcion'] == "idUsuario") {
    $idUsuario=$_POST['id'];
    echo ($usuario->respuestaJson($usuario->getId($idUsuario)));
}
if ($_POST['opcion'] == "cedulaUsuario") {
    $cedula=$_POST['cedula'];
    echo ($usuario->respuestaJson($usuario->getCedula($cedula)));
}
if ($_POST['opcion'] == "listaAdministradores") {
    echo ($usuario->respuestaJson($usuario->get()));
}
if($_POST['opcion']=="Guardar_administrador"){
if(empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['usuario']) || empty($_POST['correo']) || empty($_POST['clave'])  || empty($_POST['apellido'])|| empty($_POST['estado_id'])){
    echo $usuario->mensajes("error","Algunos campos estan vacios");
}else{
    echo $usuario->set($_POST['cedula'],$_POST['estado_id'],$_POST['nombre'],$_POST['usuario'],$_POST['correo'],$_POST['clave'],$_POST['apellido']);
}
}
if($_POST['opcion']=="Editar_usuarios"){
if(empty($_POST['id']) || empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['clave'])  || empty($_POST['tipo'])|| empty($_POST['estado'])){
    echo $usuario->mensajes("error","Algunos campos estan vacios");
}else{
    echo $usuario->edit($_POST['id'],$_POST['cedula'],$_POST['estado'],$_POST['nombre'],$_POST['email'],$_POST['clave'],$_POST['tipo']);
}
}
