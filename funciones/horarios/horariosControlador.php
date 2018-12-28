<?php

header("Content-Type: application/json;charset=utf-8");
require_once('../curso/cursoModelo.php');
# Traer los datos de un usuario
$curso = new Curso();
if ($_POST['opcion'] == "idCurso") {
    $idCurso = $_POST['id'];
    echo ($curso->respuestaJson($curso->getId($idCurso)));
}

if ($_POST['opcion'] == "listaCursos") {
    echo ($curso->respuestaJson($curso->get()));
}

if ($_POST['opcion'] == "materiasCurso") {
    echo ($curso->respuestaJson($curso->getMateriasCurso($_POST['idCurso'])));
}

if ($_POST['opcion'] == "getHorario") {
    echo ($curso->getHorarioCurso($_POST['idCurso']));
}

if ($_POST['opcion'] == "Guardar_horario"){
    $dias = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes"];
    $horario = $_POST['horario'];
    $cursoID = $_POST['curso'];    
    $valido = true;
    $respuesta = null;
        
    for ($a = 0; $a < count($dias); $a++){
        if (array_key_exists($dias[$a], $horario)){
            $clases = $horario[$dias[$a]];        
        
            for ($b = 0; $b < count($clases); $b++){
                $respuesta = $curso->disponibilidadProf($cursoID, $clases[$b], $dias[$a]);
                if ($respuesta['estado'] == 'error'){
                    $valido = false;
                    break;
                }
            }            
        }  
        if (!$valido){
            break;
        }
    }
    if ($valido){
        $curso->guardarHorarioCurso($horario, $cursoID);
    }
    
    $curso->mensajes($respuesta['estado'], $respuesta['mensaje']);
}
