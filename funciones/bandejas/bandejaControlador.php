<?php

header("Content-Type: application/json;charset=utf-8");
require_once('../profesor/profesorModelo.php');
# Traer los datos de un usuario
$profesor = new Profesor();

if ($_POST['opcion'] == "mensajesEntrada") {
    $idProf = $_POST['id'];
    echo ($profesor->respuestaJson($profesor->getMensajesEntrada($idProf)));
}

if ($_POST['opcion'] == "getMensaje") {    
    echo $profesor->getMensaje($_POST['id']);
}