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

if ($_POST['opcion'] == "Asignar_dirigente") {
    echo $curso->asignarDirigente($_POST['dirigente'], $_POST['curso'], $_POST['paralelo'], null);
}

if ($_POST['opcion'] == "Guardar_cursos") {
    if (empty($_POST['nombre']) || empty($_POST['nivel']) || empty($_POST['jornada']) || empty($_POST['paralelo']) || empty($_POST['cantidad']) || empty($_POST['estado'])) {
        echo $curso->mensajes("error", "Algunos campos estan vacios");
    } else {
        echo $curso->set($_POST['nombre'], $_POST['jornada'], $_POST['cantidad'], $_POST['paralelo'], $_POST['estado'], $_POST['nivel']);
    }
}

if ($_POST['opcion'] == "Editar_cursos") {
    if (empty($_POST['id']) || empty($_POST['nombre']) || empty($_POST['nivel']) || empty($_POST['jornada']) || empty($_POST['paralelo']) || empty($_POST['cantidad']) || empty($_POST['estado'])) {
        echo $curso->mensajes("error", "Algunos campos estan vacios");
    } else {
        echo $curso->edit($_POST['id'], $_POST['nombre'], $_POST['jornada'], $_POST['cantidad'], $_POST['paralelo'], $_POST['estado'], $_POST['nivel']);
    }
}