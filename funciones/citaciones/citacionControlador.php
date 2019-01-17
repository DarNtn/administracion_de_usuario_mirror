<?php

header("Content-Type: application/json;charset=utf-8");
require_once('../profesor/profesorModelo.php');
# Traer los datos de un usuario
$profesor = new Profesor();

if ($_POST['opcion'] == "citaciones") {
    $uProf = $_POST['user'];
    echo ($profesor->respuestaJson($profesor->getCitaciones($uProf)));
}

if ($_POST['opcion'] == "getCitacion") {    
    echo $profesor->getCitacion($_POST['id']);
}