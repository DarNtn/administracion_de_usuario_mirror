<?php

ini_set('max_execution_time', 3000);
require_once 'correoconfig.php';
require_once('comunicadoModelo.php');
header('Content-Type: application/json');
$comunicado = new Comunicado();
/*
if (!empty($_POST['contenido'])) {
    if (!empty($_POST['seleccion']) && $_POST['seleccion'] == 'todos') {
        $correos = $comunicado->get();
    } else if (!empty($_POST['correo']) && $_POST['seleccion'] == 'especifico') {
        $correos = $_POST['correo'];
    }
    if (!empty($correos)) {
        $exito = 0;
        $error = 0;
        $fCorreo = new Mail();
        if ($_POST['seleccion'] == 'todos') {
            for ($i = 0; $i < count($correos); $i++) {
                $resultado = $fCorreo->correo($correos[$i][1], $_POST['contenido']);
            }
        } else {
            $resultado = $fCorreo->correo($correos, $_POST['contenido']);
        }
        if ($resultado == 1) {
            $exito++;
        } else {
            $error++;
        }
        echo $comunicado->mensajes('info', 'exito');
    } else {
        echo $comunicado->mensajes('info', 'Sin direcion de correo, verifique');
    }
} else {
    echo $comunicado->mensajes('info', 'Contenido de Correo vacio');
}
 */

if ($_POST['opcion'] == "getPlantilla"){
    echo $comunicado->getPlantilla($_POST['id']);
}

if ($_POST['opcion'] == "enviarComunicado"){
    echo $comunicado->enviarComunicado($_POST['cursosDest'], $_POST['contenido'], $_POST['asunto']);
}

if ($_POST['opcion'] == "getCursos"){
    echo $comunicado->getCursos();
}

if ($_POST['opcion'] == "getCursosProf"){
    echo $comunicado->getCursosProfesor($_POST['username']);
}
