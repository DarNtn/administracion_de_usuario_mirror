<?php

//
//ini_set('display_errors', 1);
//
//date_default_timezone_set('Etc/UTC');
require_once '../../Plugins/PHPMailer/PHPMailerAutoload.php';

class Mail {

    function correo($correo,$contenido) {
        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";
//    $mail->SMTPDebug  = 2;
//        $mail->SMTPKeepAlive = true;
//    $mail->Debugoutput='html';
        $mail->SMTPSecure = 'tls'; //tls 587, ssl 465
        $mail->Port = 587;
        $mail->IsSMTP();  // Especifica si se va a enviar como smtp
        $mail->Host = 'smtp.gmail.com';  // smtp del servidor de correo
        $mail->SMTPAuth = true;
        $mail->Username = "innovasyspruebas@gmail.com";
        $mail->Password = "innovaSy";
        $mail->Username = "wilso.quintolmedo@gmail.com";
        $mail->Password = "olmedo12345W";
//        $mail->From = "innovasyspruebas@gmail.com";
//        $mail->FromName = "Prueba";
        $mail->IsHTML(true);
        $mail->AddAddress($correo, 'Prueba');
        $mail->Subject = utf8_decode('PHPMailer GMail SMTP test');
        $mail->Body = $contenido;
        if (!$mail->Send()) {
            /* echo "Message could not be sent. <p>";
              echo "Mailer Error: " . $mail->ErrorInfo; */
            $result = '0';
        } else {
            $result = '1';
        }
        $mail->ClearAddresses();
            $mail->smtpClose();
        return $result;
    }

}
