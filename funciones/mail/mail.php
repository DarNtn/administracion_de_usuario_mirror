<?php
require '../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
require 'configuracionModelo.php';

// Habilitar aplicaciones menos seguras en el mail
// https://support.google.com/accounts/answer/6010255
class mailEnviar {
    public function enviar($correo, $nombreUsuario, $contrasena) {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0; // 0 para produccion y 2 para debugging
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAutoTLS = false;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $configuracion = new ConfiguracionMail();
        list($correoDest, $claveDest) = $configuracion->Obtener();
        $mail->Username = $correoDest; // ;
        $mail->Password = $claveDest; // ;

        $mail->setFrom($correoDest, 'Escuelas');
        $mail->addAddress($correo, $nombreUsuario);
        $mail->Subject = 'Clave y usuario';
        $mail->isHTML(true); 
        $mail->Body = 'Su <b>usuario</b> es: ' . $nombreUsuario . ', y su <b>clave</b> es: ' . $contrasena;
        $mail->AltBody = 'This is a plain-text message body';

        if (!$mail->send()) {
            return 'no-enviado';
        } else {
            return 'enviado';
        }
     }
     
    public function enviarMensaje($correo, $subject, $mensaje) {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0; // 0 para produccion y 2 para debugging
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAutoTLS = false;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $configuracion = new ConfiguracionMail();
        list($correoDest, $claveDest) = $configuracion->Obtener();
        $mail->Username = $correoDest; // ;
        $mail->Password = $claveDest; // ;

        $mail->setFrom($correoDest, 'Escuelas');
        $mail->addAddress($correo, "");
        $mail->Subject = $subject;
        $mail->isHTML(true); 
        $mail->Body = $mensaje;
        $mail->AltBody = 'This is a plain-text message body';

        if (!$mail->send()) {
            return 'no-enviado';
        } else {
            return 'enviado';
        }
     }
}