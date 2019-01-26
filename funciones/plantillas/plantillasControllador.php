<?php
session_start();

header("Content-Type: application/json;charset=utf-8");
require_once('plantillasModelo.php');
require_once '../conexion/php_conexion.php';

$Plantilla = new Plantillas();
$responses = new php_conexion();

$metodo = $_SERVER["REQUEST_METHOD"];
$stra = explode(".php",$_SERVER["REQUEST_URI"]);
$count = count(explode("/",$stra[0]));
$ruta = implode("/", array_slice(explode("/", $_SERVER["REQUEST_URI"]),$count));
$datos = json_decode(file_get_contents("php://input"));

switch($metodo) {
  case 'GET': 
    switch ($ruta) {
      case 'plantillas':
        $useId = $_SESSION['user'];
        list($estado, $datos) =$Plantilla->ObtenerTodas($useId);
        echo  $responses->response('success', $datos);
        break;
    }
    break;  
  case 'POST': 
    switch ($ruta) {
      case 'crear':
        $useId = $_SESSION['user'];
        $plantilla = $datos->plantilla;
        $asunto = $datos->asunto;
        list($estado, $mensaje) = $Plantilla->Crear($useId, $asunto, $plantilla);
        if ($estado) {
          echo  $responses->response('success', $mensaje);
        } else {
          echo  $responses->response('error', $mensaje);
        }
      break;
      case 'eliminar':
        $id = $datos->id;
        list($estado, $mensaje) =$Plantilla->Eliminar($id);
        echo  $responses->response('error', $mensaje);
      break;
    }
    break;
}
?>

