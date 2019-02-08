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
        $colorActividad = "#df1601";
        $descripcion = $_POST['descripcionActividad'];
        if ($fFin >= $fInicio) {
            $calendarioActividad->EditActividad($_POST['id_actividad'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $descripcion, $colorActividad, 0, 0);
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
        $colorActividad = "#df1601";
        $descripcion = $_POST['descripcionActividad'];
        if ($fFin >= $fInicio) {
            $calendarioActividad->AddActividad($_POST['fecha_inicio'], $_POST['fecha_fin'], $descripcion, $colorActividad, 0, 0);
        } else {
            echo $calendarioActividad->mensajes('error', 'La fecha de finalización debe ser mayor a la de inicio!');
        }
    }
}
if ($_POST['opcion'] == 'EliminarActividad') {
    if (empty($_POST['id_actividad'])) {
        echo $calendarioActividad->mensajes('error', 'Algunos campos están vacios!');
    } else {
        $calendarioActividad->EliminarActividad($_POST['id_actividad'], 0);
    }
}











    