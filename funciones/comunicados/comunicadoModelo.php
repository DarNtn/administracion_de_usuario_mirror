<?php

require_once '../conexion/php_conexion.php';

class Comunicado extends php_conexion {

    public function get() {
        $respuesta = $this->realizarConsulta("
            SELECT distinct(r.representante_id),r.email
            FROM asignar_representante ar,representantes r
            WHERE ar.representante_id=r.representante_id and ar.principal=1;");
        return $respuesta;
    }

}
