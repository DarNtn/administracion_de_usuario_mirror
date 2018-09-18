<?php

require_once '../conexion/php_conexion.php';
require_once '../salon/salonModelo.php';

class Periodo extends php_conexion {

    public function get() {
        $respuesta = $this->realizarConsulta("
            SELECT periodo_id, anio_inicio, anio_fin, estado_id, fecha_inicio_periodo, fecha_fin_periodo
            FROM periodo_electivo");
        return $respuesta;
    }

    public function getPeriodo($anio_inicio, $anio_fin) {
        $respuesta = $this->realizarConsulta("
            SELECT periodo_id, anio_inicio, anio_fin, estado_id, fecha_inicio_periodo, fecha_fin_periodo
            FROM periodo_electivo 
            WHERE anio_inicio='$anio_inicio' and anio_fin='$anio_fin'");
        return $respuesta;
    }

    public function getId($idPeriodo) {
        $respuesta = $this->realizarConsulta("
            SELECT periodo_id, anio_inicio, anio_fin, estado_id, fecha_inicio_periodo, fecha_fin_periodo
            FROM periodo_electivo
            WHERE periodo_id='$idPeriodo'");
        return $respuesta;
    }

    public function set($anio_inicio, $anio_fin, $fecha_inicio, $fecha_fin, $estado) {
        $data = $this->getPeriodo($anio_inicio, $anio_fin);
        if ($data == null) {
            $resultado = $this->realizarIngresoId("INSERT INTO periodo_electivo VALUES(null,'$anio_inicio','$anio_fin',' $estado','$fecha_inicio','$fecha_fin')");
            if ($resultado > 0) {
                $this->historial(1, 'periodo_electivo', 'insertar', $resultado, 'registro de un período en el sistema');
                return $this->mensajes('success', 'Registro exitoso');
            } else {
                return $this->mensajes('error', 'No se pudo hacer el registro');
            }
        } else {
            return $this->mensajes('error', 'Registro de período existente');
        }
    }

    public function editEstadoPeriodo($id, $estado) {
        if ($estado == 2) {
            $this->realizarIngreso("UPDATE periodo_electivo SET estado_id=2 where periodo_id='$id'");
            $salon = new Salon();
            $datos = $salon->realizarConsulta("SELECT * FROM salones where periodo_id='$id' and estado_id=1");
            for ($i = 0; $i < count($datos); $i++) {
                $salon->editEstadoSalon($datos[$i]['salon_id'], 2);
            }
        } else {
            $this->realizarIngreso("UPDATE periodo_electivo SET estado_id=1 where periodo_id='$id'");
        }
    }

    public function edit($idPeriodo, $anio_inicio, $anio_fin, $fecha_inicio, $fecha_fin) {
        $data = $this->getId($idPeriodo);
        if ($data != null) {
            $resultado = $this->realizarIngreso("UPDATE periodo_electivo SET anio_inicio='$anio_inicio', anio_fin='$anio_fin', fecha_inicio_periodo='$fecha_inicio', fecha_fin_periodo='$fecha_fin' where periodo_id='$idPeriodo'");
            if ($resultado > 0) {
                $this->historial(1, 'periodo_electivo', 'editar', $idPeriodo, 'edicion de un período electivo en el sistema');
                return $this->mensajes('success', 'Período editado exitosamente');
            } else {
                return $this->mensajes('info', 'No hay cambios presentes');
            }
        } else {
            return $this->mensajes('error', 'Período con registro no existente');
        }
    }

}
