<?php

header("Content-Type: application/json;charset=utf-8");
require_once('../profesor/profesorModelo.php');
# Traer los datos de un usuario
$profesor = new Profesor();

if ($_POST['opcion'] == "mensajesEntrada") {
    $uProf = $_POST['user'];
    echo ($profesor->respuestaJson($profesor->getMensajesEntrada($uProf)));
}

if ($_POST['opcion'] == "getMensaje") {    
    echo $profesor->getMensaje($_POST['id']);
}