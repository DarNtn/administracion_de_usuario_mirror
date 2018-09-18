<?php

header("Content-Type: application/json;charset=utf-8");
require_once('salonModelo.php');
# Traer los datos de un usuario
$salon = new Salon();
if ($_POST['opcion'] == "idSalon") {
    $idSalon = $_POST['id'];
    echo ($salon->respuestaJson($salon->getId($idSalon)));
}

//if ($_POST['opcion'] == "cedulaUsuario") {
//    $cedula=$_POST['cedula'];
//    echo ($salon->respuestaJson($salon->getCedula($cedula)));
//}

if ($_POST['opcion'] == "listaSalones") {
    echo ($salon->respuestaJson($salon->get()));
}

if ($_POST['opcion'] == "Guardar_salon_multiple") {
    if (empty($_POST['curso']) || empty($_POST['profesor']) || empty($_POST['periodo']) || empty($_POST['estado'])) {
        echo $salon->mensajes("error", "Algunos campos estan vacios");
    } else {
        $profesores = $_POST['profesor'];
        for ($i = 0; $i < count($profesores); $i++) {
            echo $salon->set($_POST['curso'], $profesores[$i], $_POST['periodo'], $_POST['estado']);
        }    
    }
}
if ($_POST['opcion'] == "estadoSalon") {
    $salon->editEstadoSalon($_POST['id'],$_POST['estado']);
    echo $salon->mensajes('success', 'aqui');
}
if ($_POST['opcion'] == "Editar_salon") {
    if (empty($_POST['id']) || empty($_POST['curso']) || empty($_POST['profesor']) || empty($_POST['periodo']) || empty($_POST['estado'])) {
        echo $salon->mensajes("error", "Algunos campos estan vacios");
    } else {
        echo $salon->edit($_POST['id'], $_POST['profesor'], $_POST['periodo']);
    }
}