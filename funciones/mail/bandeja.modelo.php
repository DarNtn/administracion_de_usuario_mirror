<?php
require_once('configuracionModelo.php');

final class BandejaEntrada {
  public function Conectar($useId) {
    if (! function_exists('imap_open')) {
      return array(false, "IMAP is not configured.");
    }
    $mail = new ConfiguracionMail();
    list($correo, $clave) = $mail->Obtener($useId);
    $connection = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', $correo, $clave);
    if (!$connection) {
      return array(false, "Cannot connect to Gmail");
      // imap_last_error()
    }
    return array(true, 'Conectado corretamente', $connection);
  }

  public function ObtenerMensajes($connection) {
    $emailData = imap_search($connection, 'SINCE 14-May-2018');
    if (! empty($emailData)) {
      $array = array();
      foreach ($emailData as $emailIdent) {
        $msg_no = $emailIdent->msgno;
        $overview = imap_fetch_overview($connection, $emailIdent, 0);
        $message = imap_fetchbody($connection, $emailIdent, '1.1');
        if ($message == "") {
          $message = imap_fetchbody($connection, $emailIdent, "1");
        }
        $messageParse =  trim(quoted_printable_decode($message));
        $header = imap_headerinfo($connection, $emailIdent);
        $fromaddr = $header->from[0]->mailbox . "@" . $header->from[0]->host;
        $messageExcerpt = substr($message, 0, 150);
        $partialMessage = trim(quoted_printable_decode($messageExcerpt)); 
        $date = date("d/m/Y", strtotime($overview[0]->date));
        $data['id'] = $emailIdent;
        $data['remitente'] = $fromaddr;
        $data['fecha'] = $date;
        $data['mensaje'] = $message;
        $data['body'] = $messageParse;
        $data['from'] = $overview[0]->from;
        $data['subject'] = $overview[0]->subject;
        array_push($array, $data);
      }
      return $array;
    } else {
      return array([]);
    }
  }

  public function borrarMensaje($connection, $emailIdentv) {
    $delete = imap_delete($connection, $emailIdentv);
    $borrado = imap_expunge($connection);
    if ($borrado || $delete) {
      return array(true, "Mensaje borrado correctamente");
    }
    return array(false, "No se pudo borrar el mensaje");
  }
}
?>