<?php

header("Content-Type: application/json;charset=utf-8");
require_once('contrasenaModelo.php');

$contrasena = new Contrasena();

if ($_POST['opcion'] == "cambiarContrasena") {
    
    $username = $_POST['username'];
    $tipoUsuario = $_POST['tipoUsuario'];
    $contrasenaAntigua = $_POST['contrasenaAntigua'];
    $contrasenaNueva = $_POST['contrasenaNueva'];
    
    echo ($contrasena->cambiarContrasena($username, $tipoUsuario, $contrasenaAntigua, $contrasenaNueva));
    
}
