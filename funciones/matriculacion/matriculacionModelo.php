<?php

require_once '../conexion/php_conexion.php';

class Matricula extends php_conexion {

    function buscarEstudiante($id) {
        $dato = $this->realizarConsulta("SELECT * from alumnos where alumno_id='$id'");
        return $dato;
    }

    function representanteAlumno($id) {
        $dato = $this->realizarConsulta("SELECT * FROM asignar_representante a, representantes r
where a.representante_id=r.representante_id and a.alumno_id='$id'");
        return $dato;
    }

    function cambiarPrincipal($id, $idR) {
        $this->realizarIngreso("UPDATE asignar_representante SET principal=2 where alumno_id='$id' and principal=1");
        $this->realizarIngreso("UPDATE asignar_representante SET principal=1 where alumno_id='$id' and representante_id='$idR'");
    }

    function crearAlumnoSalon($alumno, $salon, $servicio, $mesI, $mesF, $periodo) {
        $datos = $this->realizarConsulta("SELECT lc.*,s.periodo_id FROM lista_curso lc,salones s 
            where lc.salon_id=s.salon_id and lc.alumno_id='$alumno' and s.periodo_id='$periodo'");
        if ($datos == null) {
            $representante = $this->realizarConsulta("SELECT * FROM asignar_representante where alumno_id='$alumno' and principal=1;");
            if ($representante != null) {
                $meses = self::calcularMese($mesI, $mesF);
                if ($meses > 0) {
                    $result = $this->realizarIngresoId("INSERT INTO lista_curso (alumno_id,salon_id,representante_id,estado_id) VALUES ('$alumno','$salon','" . $representante[0]['representante_id'] . "',1)");
                    $idOrden = self::matriculacion($result, $servicio, $mesI, $meses);
                    echo $this->mensajes("success", $idOrden);
                } else {
                    echo $this->mensajes("error", "Valores de meses incorretos");
                }
            } else {
                echo $this->mensajes("error", "Selecciones un representante para el alumno");
            }
        } else {
            echo $this->mensajes("error", "El Alumno ya cuenta con una matricula vigente en el periodo actual");
        }
    }

    function matriculacion($id, $servicio, $mesI, $meses) {
        $mes = $mesI . '-01';
        $result = $this->realizarIngresoId("INSERT INTO orden_pagos (servicio_id,fecha_pago,fecha_vencimiento_pago,estado_id,lista_curso_id) VALUES (1,CURDATE(),LAST_DAY(CURDATE()),1,'$id');");
        for ($i = 0; $i < $meses; $i++) {
            $this->realizarIngreso("INSERT INTO orden_pagos (servicio_id,fecha_pago,fecha_vencimiento_pago,estado_id,lista_curso_id) VALUES (2,DATE_ADD(Date_format('$mes','%Y-%m-15'),INTERVAL '$i' MONTH),LAST_DAY(DATE_ADD('$mes',INTERVAL '$i' MONTH)),1,'$id');");
            $this->realizarIngreso("INSERT INTO orden_pagos (servicio_id,fecha_pago,fecha_vencimiento_pago,estado_id,lista_curso_id) VALUES ('$servicio',DATE_ADD(Date_format('$mes','%Y-%m-15'),INTERVAL '$i' MONTH),LAST_DAY(DATE_ADD('$mes',INTERVAL '$i' MONTH)),1,'$id');");
        }
        if ($result != null) {
            $result = 'Exito en el registor de Matricula';
        } else {
            $result = 'Fallo en el registor de Matricula';
        }
        return $result;
    }

    function calcularMese($inicio, $fin) {
        $datetime1 = new DateTime($inicio);
        $datetime2 = new DateTime($fin);
        # obtenemos la diferencia entre las dos fechas
        $interval = $datetime2->diff($datetime1);
        # obtenemos la diferencia en meses
        $intervalMeses = $interval->format("%m");
        # obtenemos la diferencia en años y la multiplicamos por 12 para tener los meses
        $intervalAnos = $interval->format("%y") * 12;
        return $intervalMeses + $intervalAnos + 1;
    }

}
