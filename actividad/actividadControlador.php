<?php

header("Content-Type: application/json;charset=utf-8");
require_once ('actividadModel.php');
session_start();
$calendarioActividad = new Actividad();

if ($_POST['opcion'] == 'listaActividades') {
    echo $calendarioActividad->respuestaJson($calendarioActividad->getEventosActividad());
}

if ($_POST['opcion'] == 'EditarActividad') {
    if (empty($_POST['id_actividad']) && empty($_POST['fecha_inicio']) && empty($_POST['fecha_fin']) && empty($_POST['tipo'])) {
        echo $calendarioActividad->mensajes('error', 'Algunos campos están vacios!');
    } else {
        $fInicio = strtotime($_POST['fecha_inicio']);
        $fFin = strtotime($_POST['fecha_fin']);
        if ($_POST['tipo'] == 1) {
            $colorActividad = "#ffca05";
            $descripcion = "Máximo aguaje de ";
        } else if ($_POST['tipo'] == 2) {
            $colorActividad = "#009688";
            $descripcion = "Aguaje de ";
        } else if ($_POST['tipo'] == 3) {
            $colorActividad = "#960000";
            $descripcion = "Auditoría de ";
        } else if ($_POST['tipo'] == 4) {
            $colorActividad = "#34495E";
            $descripcion = "Paro de Planta de ";
        }
        if ($fFin >= $fInicio) {
            $calendarioActividad->EditActividad($_POST['id_actividad'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $descripcion, $colorActividad, $_POST['tipo'], $_SESSION['id_usuario']);
        } else {
            echo $calendarioActividad->mensajes('error', 'La fecha de finalización debe ser mayor a la de inicio!');
        }
    }
}
if ($_POST['opcion'] == 'GuardarActividad') {
    if (empty($_POST['fecha_inicio']) && empty($_POST['fecha_fin']) && empty($_POST['tipo'])) {
        echo $calendarioActividad->mensajes('error', 'Algunos campos están vacios!');
    } else {
        $fInicio = strtotime($_POST['fecha_inicio']);
        $fFin = strtotime($_POST['fecha_fin']);
//        
        if ($_POST['tipo'] == 1) {
            $colorActividad = "#ffca05";
            $descripcion = "Máximo aguaje de ";
        } else if ($_POST['tipo'] == 2) {
            $colorActividad = "#009688";
            $descripcion = "Aguaje de ";
        } else if ($_POST['tipo'] == 3) {
            $colorActividad = "#960000";
            $descripcion = "Auditoría de ";
        } else if ($_POST['tipo'] == 4) {
            $colorActividad = "#34495E";
            $descripcion = "Paro de Planta de ";
        }
        if ($fFin >= $fInicio) {
            $calendarioActividad->AddActividad($_POST['fecha_inicio'], $_POST['fecha_fin'], $descripcion, $colorActividad, $_POST['tipo'], $_SESSION['id_usuario']);
        } else {
            echo $calendarioActividad->mensajes('error', 'La fecha de finalización debe ser mayor a la de inicio!');
        }
    }
}

if ($_POST['opcion'] == 'EliminarActividad') {
    if (empty($_POST['id_actividad'])) {
        echo $calendarioActividad->mensajes('error', 'Algunos campos están vacios!');
    } else {
        $calendarioActividad->EliminarActividad($_POST['id_actividad'], $_SESSION['id_usuario']);
    }
}











    