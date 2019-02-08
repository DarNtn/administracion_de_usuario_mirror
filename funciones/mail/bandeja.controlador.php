<?php
session_start();
require_once('bandeja.modelo.php');
$bandeja = new BandejaEntrada();
list($error, $mensaje, $conection) = $bandeja->Conectar();

// $mensajes =  $bandeja->ObtenerMensajes($conection);
// list($error2, $mensaje2) =  $bandeja->borrarMensaje($conection, 560);
// echo $mensaje2

header("Content-Type: application/json;charset=utf-8");
require_once '../conexion/php_conexion.php';

$responses = new php_conexion();

$metodo = $_SERVER["REQUEST_METHOD"];
$stra = explode(".php",$_SERVER["REQUEST_URI"]);
$count = count(explode("/",$stra[0]));
$ruta = implode("/", array_slice(explode("/", $_SERVER["REQUEST_URI"]),$count));
$datos = json_decode(file_get_contents("php://input"));

switch($metodo){
  case 'GET': 
    switch ($ruta) {
      case 'correos':
        $bandeja = new BandejaEntrada();
        $useId = $_SESSION['user'];
        list($error, $mensaje, $conection) = $bandeja->Conectar($useId);
        if (!$error) {
          echo $responses->response('error', $mensaje);
        } else {
          $mensajes =  $bandeja->ObtenerMensajes($conection);
          echo $responses->response('success', $mensajes);
        }
        break;
    }
    break;
  case 'POST': 
    switch ($ruta) {
      case 'borrar':
        $id = $datos->id;
        list($error, $mensaje) =  $bandeja->borrarMensaje($conection, $id);
        if (!$error) {
          echo $responses->response('error', $mensaje);
        } else {
          echo $responses->response('success', $mensaje);
        }
        break;
    }
    break;
}
?>