<?php
session_start();
ini_set('max_execution_time', 3000);
// require_once 'correoconfig.php';
// require_once('comunicadoModelo.php');
header('Content-Type: application/json');
require_once '../conexion/php_conexion.php';
$responses = new php_conexion();
require_once('../mail/mail.php');
$mail = new mailEnviar();

$metodo = $_SERVER["REQUEST_METHOD"];
$stra = explode(".php",$_SERVER["REQUEST_URI"]);
$count = count(explode("/",$stra[0]));
$ruta = implode("/", array_slice(explode("/", $_SERVER["REQUEST_URI"]),$count));
$datos = json_decode(file_get_contents("php://input"));

switch($metodo) { 
  case 'POST': 
    switch ($ruta) {
      case 'enviar':
        $useId = $_SESSION['user'];
        $plantilla = $datos->plantilla;
        $correo = $datos->correo;
        $asunto = $datos->asunto;
        $mail->enviarMensaje($correo, $asunto, $plantilla);
        if ($mail == 'no-enviado') {
          echo  $responses->response('error', "El correo no existe");
        } else {
          echo  $responses->response('success', "El correo fue enviado");
        }
      break;
    }
    break;
}
// $comunicado = new Comunicado();
// if (!empty($_POST['contenido'])) {
//     if (!empty($_POST['seleccion']) && $_POST['seleccion'] == 'todos') {
//         $correos = $comunicado->get();
//     } else if (!empty($_POST['correo']) && $_POST['seleccion'] == 'especifico') {
//         $correos = $_POST['correo'];
//     }
//     if (!empty($correos)) {
//         $exito = 0;
//         $error = 0;
//         $fCorreo = new Mail();
//         if ($_POST['seleccion'] == 'todos') {
//             for ($i = 0; $i < count($correos); $i++) {
//                 $resultado = $fCorreo->correo($correos[$i][1], $_POST['contenido']);
//             }
//         } else {
//             $resultado = $fCorreo->correo($correos, $_POST['contenido']);
//         }
//         if ($resultado == 1) {
//             $exito++;
//         } else {
//             $error++;
//         }
//         echo $comunicado->mensajes('info', 'exito');
//     } else {
//         echo $comunicado->mensajes('info', 'Sin direcion de correo, verifique');
//     }
// } else {
//     echo $comunicado->mensajes('info', 'Contenido de Correo vacio');
// }

?>
