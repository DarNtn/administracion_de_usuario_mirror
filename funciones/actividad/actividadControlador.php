<?php

header("Content-Type: application/json;charset=utf-8");
require_once ('actividadModel.php');
session_start();
$calendarioActividad = new Actividad();

if ($_POST['opcion'] == 'listaActividades') {
    echo $calendarioActividad->respuestaJson($calendarioActividad->getEventosActividad());
}

if ($_POST['opcion'] == 'GuardarActividad') {
    if (empty($_POST['fecha_inicio']) && empty($_POST['fecha_fin']) && empty($_POST['tipo'])) {
        echo $calendarioActividad->mensajes('error', 'Algunos campos están vacios!');
    } else {
        $fInicio = strtotime($_POST['fecha_inicio']);
        $fFin = strtotime($_POST['fecha_fin']);
        
        if ($fFin >= $fInicio) {
            $calendarioActividad->AddActividad($_POST['fecha_inicio'], $_POST['fecha_fin'], $descripcion, $colorActividad, $_POST['tipo'], $_SESSION['id_usuario']);
        } else {
            echo $calendarioActividad->mensajes('error', 'La fecha de finalización debe ser mayor a la de inicio!');
        }
    }
}









    