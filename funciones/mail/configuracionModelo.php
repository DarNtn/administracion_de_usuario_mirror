<?php
require_once '../conexion/php_conexion.php';

class ConfiguracionMail extends php_conexion {
  public function Obtener($useId) {
    $correo = 'A';
    $clave = 'A';
    list($respuesta) = $this->realizarConsulta("
            SELECT correo, clave
            FROM configuracion where $useId");
    foreach ($respuesta as $line_num=>$line) {
      if ($line_num == 'correo') {
        $correo = $line;
      } else if ($line_num == 'clave') {
        $clave = $line;
      }
    }
    return array($correo, $clave);
  }

  function Cambio($new_mail, $new_pass, $useId) {
    list($correo, $clave) =  $this->Obtener();
    $data = $this->realizarIngreso("UPDATE configuracion SET correo='$new_mail', clave='$new_pass' where usuario_id='$useId'");
    if ($data > 0) {
      return $this->response('success', 'Registro exitoso');
    } else {
      return $this->response('error', 'No se pudo cambiar el correo');
    }
  }
}
