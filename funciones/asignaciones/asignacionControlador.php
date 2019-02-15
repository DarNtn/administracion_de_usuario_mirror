<?php

header("Content-Type: application/json;charset=utf-8");
require_once('../curso/cursoModelo.php');

$curso = new Curso();

if ($_POST['opcion'] == "idCurso") {
    $idCurso = $_POST['id'];
    echo ($curso->respuestaJson($curso->getId($idCurso)));
}

if ($_POST['opcion'] == "listaCursos") {
    echo ($curso->respuestaJson($curso->getCursosAsignados()));
}

if ($_POST['opcion'] == "cursosJornada") {
    echo ($curso->respuestaJson($curso->getCursosbyJornada($_POST['jornada'])));
}

if ($_POST['opcion'] == "paralelosCurso") {
    echo ($curso->respuestaJson($curso->getParalelosbyJornadaCurso($_POST['curso'], $_POST['jornada'])));
}

if ($_POST['opcion'] == "materiasAsignadas") {
    echo ($curso->respuestaJson($curso->getMateriasAsignadas($_POST['idCurso'])));
}

if ($_POST['opcion'] == "Asignar_dirigente") {
    echo $curso->asignarDirigente($_POST['dirigente'], $_POST['curso'], $_POST['paralelo'], $_POST['jornada']);
}

if ($_POST['opcion'] == "Asignar_materias") {       
    $idCurso = $_POST['idCurso'];
    $curso->eliminarAsignacionesMateria($idCurso);
    
    $lista = $_POST['materias'];
    $flag = true;
    foreach ($lista as $i => $value){
        if ($value != null){
            $resultado = $curso->asignarMateria($i, $value['idProfesor'], $idCurso);
            if (!$resultado){
                $flag = false;
            }
        }
    }
    if ($flag){
        echo $curso->mensajes('success', 'Asignaciones realizadas exitosamente');
    }else{
        echo $curso->mensajes('error', 'Lo sentimos, no se pudo realizar el registro');
    }
    
}

if ($_POST['opcion'] == "Cambiar_dirigente") {
    echo $curso->cambiarDirigente($_POST['Ejornada'], $_POST['Ecurso'], $_POST['Eparalelo'], $_POST['Edirigente']);    
    //echo $curso->asignarDirigente($_POST['Edirigente'], $_POST['Ecurso'], $_POST['Eparalelo'], $_POST['Ejornada']);    
}

if ($_POST['opcion'] == "alumnosCurso"){
    echo ($curso->respuestaJson($curso->getAlumnosCurso($_POST['cursoId'])));
}

if ($_POST['opcion'] == "alumnosEscuela"){
    echo ($curso->respuestaJson($curso->getAlumnosEscuela()));
}

if ($_POST['opcion'] == "agregarAlumnos"){
    echo $curso->agregarAlumnos($_POST['cursoId'], $_POST['alumnos']);
}

if ($_POST['opcion'] == "retirarAlumno"){
    echo $curso->retirarAlumno($_POST['alumno']);
}