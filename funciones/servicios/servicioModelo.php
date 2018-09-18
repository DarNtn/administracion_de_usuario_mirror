<?php

require_once '../conexion/php_conexion.php';

class Servicio extends php_conexion {

    public function get() {
        $respuesta = $this->realizarConsulta("
            SELECT s.*,t.nombre as tipo 
            FROM servicios s,tipo_servicio t 
            WHERE s.tipo_servicio_id=t.tipo_servicio_id;");
        return $respuesta;
    }

    public function getServicio($nombre) {
        $respuesta = $this->realizarConsulta("
            SELECT *
            FROM servicios 
            WHERE nombre='$nombre'");
        return $respuesta;
    }

    public function getId($idServicio) {
        $respuesta = $this->realizarConsulta("
            SELECT * 
            FROM servicios 
            WHERE servicio_id='$idServicio'");
        return $respuesta;
    }

    public function set($nombre, $valor, $tipo, $estado) {
        $data = $this->getServicio($nombre);
        if ($data == null) {
            $resultado = $this->realizarIngresoId("INSERT INTO servicios VALUES(null,'$nombre','$valor','$tipo','$estado')");
            if ($resultado > 0) {
                $this->historial(1, 'servicios', 'insertar', $resultado, 'registro de un servicio en el sistema');
                return $this->mensajes('success', 'Registro exitoso');
            } else {
                return $this->mensajes('error', 'No se pudo hacer el registro');
            }
        } else {
            return $this->mensajes('error', 'Ya existe un registro con el mismo nombre');
        }
    }

    public function edit($idServicio, $nombre, $valor, $tipo, $estado) {
        $data = $this->getId($idServicio);
        if ($data != null) {
            $resultado = $this->realizarIngreso("UPDATE servicios SET nombre='$nombre', valor_servicio='$valor' , tipo_servicio_id='$tipo',estado_id='$estado' where servicio_id='$idServicio'");
            if ($resultado > 0) {
                $this->historial(1, 'servicios', 'editar', $idServicio, 'edicion de un servicio en el sistema');
                return $this->mensajes('success', 'Servicio editado exitosamente');
            } else {
                return $this->mensajes('info', 'No hay cambios presentes');
            }
        } else {
            return $this->mensajes('error', 'Servicio con registro no existente');
        }
    }

}
