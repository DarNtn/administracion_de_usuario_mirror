<?php
session_start();

header("Content-Type: application/json;charset=utf-8");
require_once('citacionesModelo.php');
require_once '../conexion/php_conexion.php';

$Citacion = new Citaciones();
$responses = new php_conexion();

$metodo = $_SERVER["REQUEST_METHOD"];
$stra = explode(".php",$_SERVER["REQUEST_URI"]);
$count = count(explode("/",$stra[0]));
$ruta = implode("/", array_slice(explode("/", $_SERVER["REQUEST_URI"]),$count));
$datos = json_decode(file_get_contents("php://input"));

switch($metodo) {
  case 'GET': 
    switch ($ruta) {
      case 'citaciones':
        list($estado, $datos) =$Citacion->ObtenerTodas();
        echo  $responses->response('success', $datos);
        // list($estado, $datos) =$Plantilla->ObtenerTodas($useId);
        // echo  $responses->response('success', $datos);
        break;
    }
    break;
}
?>

