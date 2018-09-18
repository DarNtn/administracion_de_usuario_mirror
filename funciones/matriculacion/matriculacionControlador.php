<?php

header("Content-Type: application/json;charset=utf-8");
require_once('matriculacionModelo.php');
# Traer los datos de un usuario
$matricula = new Matricula();
if ($_POST['opcion'] == "buscarAlumno") {
    echo $matricula->respuestaJson($matricula->buscarEstudiante($_POST['id']));
}
if ($_POST['opcion'] == "Representantes_Alumnos") {
    echo $matricula->respuestaJson($matricula->representanteAlumno($_POST['id']));
}
if ($_POST['opcion'] == "cambiarPrincipal") {
    echo $matricula->respuestaJson($matricula->cambiarPrincipal($_POST['id'], $_POST['idR']));
}
if ($_POST['opcion'] == "Guardar_alumnoSalon") {
    if (empty($_POST['id']) || empty($_POST['salon']) || empty($_POST['servicio']) || empty($_POST['mesI']) || empty($_POST['mesF']) || empty($_POST['periodo'])) {
        echo $matricula->mensajes("warning", "Algunos campos estan vacios");
    } else {
        $matricula->crearAlumnoSalon($_POST['id'], $_POST['salon'], $_POST['servicio'], $_POST['mesI'], $_POST['mesF'], $_POST['periodo']);
    }
}