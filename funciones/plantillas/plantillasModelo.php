<?php
require_once '../conexion/php_conexion.php';

class Plantillas extends php_conexion  {
  function Crear($useId, $asunto, $plantilla) { // $useId, $asunto, $plantilla;
    $usuarioId = $this->realizarIngresoId("INSERT INTO plantillas (admin_id, asunto, plantilla) VALUES('$useId', '$asunto', '$plantilla')");
    if ($usuarioId > 0) {
      return array(true, "Plantilla creada");
    }
    return array(false, "Plantilla no creada");
  }

  function ObtenerTodas($userId) {
    $respuesta = $this->realizarConsulta("
            SELECT * from plantillas where admin_id = '$userId'");
    return array(true, $respuesta);
  }

  function Eliminar($id) {
    $respuesta = $this->realizarConsulta("
            DELETE from plantillas where id = '$id'");
    return array(true, $respuesta);
  }
}