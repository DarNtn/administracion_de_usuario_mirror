<?php
session_start();
header("Content-Type: application/json;charset=utf-8");
require_once('estudianteModelo.php');
$estudiante = new Estudiante();

if (isset($_GET['term'])){
    $resul = $estudiante->realizarConsulta("select nombre, apellido from autorizado where nombre like '%".$_GET['term']."%' or apellido like '%".$_GET['term']."%'");
    //$retorno = $estudiante->respuestaJson($resul);
    $lista = array();
    foreach ($resul as $autorizado){
        $lista[] = "".$autorizado['nombre']." ".$autorizado['apellido'];
    }
    
    echo json_encode($lista);
}