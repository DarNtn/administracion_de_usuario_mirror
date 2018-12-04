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
    echo ($curso->respuestaJson($curso->get()));
}

if ($_POST['opcion'] == "materiasCurso") {
    echo ($curso->respuestaJson($curso->getMateriasCurso($_POST['idCurso'])));
}
