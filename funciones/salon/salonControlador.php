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
    echo $salon->respuestaJson($salon->get());
}

if ($_POST['opcion'] == "Guardar_salon_multiple") {
    echo $salon->set($_POST['periodo'], $_POST['jornada'], $_POST['nivel'], $_POST['paralelo'], $_POST['nEstudiantes']);
}

if ($_POST['opcion'] == "estadoSalon") {
    $salon->editEstadoSalon($_POST['id'],$_POST['estado']);
    echo $salon->mensajes('success', 'aqui');
}
if ($_POST['opcion'] == "Editar_salon") {
    echo $salon->edit($_POST['id'], $_POST['periodo'], $_POST['jornada'], $_POST['nivel'], $_POST['paralelo'], $_POST['nEstudiantes']);
}