<?php

header("Content-Type: application/json;charset=utf-8");
require_once('mail.php');
require_once('configuracionModelo.php');
require_once '../conexion/php_conexion.php';

$configuracion = new ConfiguracionMail();
$responses = new php_conexion();

$metodo = $_SERVER["REQUEST_METHOD"];
$ruta = implode("/", array_slice(explode("/", $_SERVER["REQUEST_URI"]), 5));
$datos = json_decode(file_get_contents("php://input"));

switch($metodo){
  case 'GET': 
    switch ($ruta) {
      case 'correo':
        list($correo, $clave) = $configuracion->Obtener();
        $datos['correo'] = $correo;
        $datos['clave'] = $clave;
        echo $configuracion->respuestaJson($datos);
        break;
    }
    break;
  case 'POST': 
    switch ($ruta) {
      case 'correo':
        $correo = $datos->correo;
        $clave = $datos->clave;
        $data['correo'] = $correo;
        // $link = $responses->obtenerConexion();
        $data['clave'] = $clave;
        
        $respuesta = $configuracion->Cambio($correo, $clave);
        // mysqli_commit($link);
        $mail = new mailEnviar();
        $mensaje = $mail->enviar($correo, 'yo mismo', 'tmp');
        if ($mensaje === 'enviado') {
          echo $respuesta;
        } else {
          // mysqli_rollback($link);
          echo $responses->response('error', 'El correo y clave no existen');
        }
        break;
    }
    break;
}
?>