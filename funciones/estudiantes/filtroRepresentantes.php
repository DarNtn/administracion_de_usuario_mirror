<?php
session_start();
header("Content-Type: application/json;charset=utf-8");
require_once('estudianteModelo.php');
$estudiante = new Estudiante();

if (isset($_GET['term'])){
    $resul = $estudiante->realizarConsulta("select nombre, apellido, cedula from autorizado where nombre like '%".$_GET['term']."%' or apellido like '%".$_GET['term']."%' or cedula = '".$_GET['term']."'");    
    $lista = array();
    if ($resul != null){
        foreach ($resul as $autorizado){
            $lista[] = array ("label" => "".$autorizado['nombre']." ".$autorizado['apellido'], 
                "value" => $autorizado['cedula']);
        }
    }
    
    echo json_encode($lista);
}