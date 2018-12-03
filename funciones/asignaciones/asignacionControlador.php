<?php

header("Content-Type: application/json;charset=utf-8");
require_once('../curso/cursoModelo.php');
# Traer los datos de un usuario
$curso = new Curso();
if ($_POST['opcion'] == "idCurso") {
    $idCurso = $_POST['id'];
    echo ($curso->respuestaJson($curso->getId($idCurso)));
}

//if ($_POST['opcion'] == "cedulaUsuario") {
//    $cedula=$_POST['cedula'];
//    echo ($curso->respuestaJson($curso->getCedula($cedula)));
//}

if ($_POST['opcion'] == "listaCursos") {
    echo ($curso->respuestaJson($curso->getCursosAsignados()));
}

if ($_POST['opcion'] == "cursosJornada") {
    echo ($curso->respuestaJson($curso->getCursosbyJornada($_POST['jornada'])));
}

if ($_POST['opcion'] == "paralelosCurso") {
    echo ($curso->respuestaJson($curso->getParalelosbyJornadaCurso($_POST['curso'], $_POST['jornada'])));
}

if ($_POST['opcion'] == "Asignar_dirigente") {
    echo $curso->asignarDirigente($_POST['dirigente'], $_POST['curso'], $_POST['paralelo'], $_POST['jornada']);
}

if ($_POST['opcion'] == "Cambiar_dirigente") {
    echo $curso->cambiarDirigente($_POST['Ejornada'], $_POST['Ecurso'], $_POST['Eparalelo'], $_POST['Edirigente']);    
    //echo $curso->asignarDirigente($_POST['Edirigente'], $_POST['Ecurso'], $_POST['Eparalelo'], $_POST['Ejornada']);    
}