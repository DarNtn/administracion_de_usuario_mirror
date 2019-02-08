<?php
require_once '../conexion/php_conexion.php';

class Citaciones extends php_conexion  {
  function ObtenerTodas() {
    $respuesta = $this->realizarConsulta("
      SELECT citacion.curso_nombre as curso_nombre, citacion.materia as materia, citacion.asunto, citacion.fecha as fecha, citacion.hora as hora FROM citacion inner join citacion_curso on citacion.id_citacion = citacion_curso.citacion inner join usuario on citacion_curso.usuario = usuario.usuario_id");
    return array(true, $respuesta);
  }
}

// citacion citacion_curso