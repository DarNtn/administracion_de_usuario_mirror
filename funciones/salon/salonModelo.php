<?php

require_once '../conexion/php_conexion.php';

class Salon extends php_conexion {

    public function get() {
        $respuesta = $this->realizarConsulta("
            SELECT s.salon_id as id,c.nombre,c.paralelo,GROUP_CONCAT(concat(pr.nombres,' ',pr.apellidos) SEPARATOR ', ') AS profesor
                   ,concat(p.anio_inicio,' - ',p.anio_fin) as periodo,c.curso_id as idC,ap.personal_id as idPr
,p.periodo_id as idP,s.estado_id as estado
FROM asignar_profesor ap,salones s,personal pr,cursos c,periodo_electivo p
WHERE ap.salon_id=s.salon_id and ap.personal_id=pr.personal_id and s.curso_id=c.curso_id and
 s.periodo_id=p.periodo_id and p.estado_id=1
group by c.nombre,paralelo,p.periodo_id");
        return $respuesta;
    }

    public function getSalon($periodo, $curso) {
        $respuesta = $this->realizarConsulta("
            SELECT * 
            FROM salones 
            WHERE periodo_id='$periodo' and curso_id='$curso'");
        return $respuesta;
    }

    public function getAsignacionSalon($profesor, $periodo) {
        $respuesta = $this->realizarConsulta("
            SELECT * 
            FROM asignar_profesor
            WHERE personal_id='$profesor' and periodo_id='$periodo'");
        return $respuesta;
    }

    public function setProfesor($result, $profesor, $periodo) {
        $data = $this->getAsignacionSalon($profesor, $periodo);
        
        if ($data == null) {
            return $resultado = $this->realizarIngresoId("INSERT INTO asignar_profesor (salon_id,personal_id,periodo_id) VALUES ('$result','$profesor','$periodo')");
        } else {
            return 0;
        }
    }

    public function getId($idSalon) {
        $respuesta = $this->realizarConsulta("
            SELECT s.salon_id,s.curso_id,s.periodo_id,ap.asignar_profesor_id,s.estado_id,GROUP_CONCAT(ap.personal_id SEPARATOR ',') as ids 
            FROM salones s, asignar_profesor ap
            WHERE s.salon_id='$idSalon' and ap.salon_id='$idSalon'
            group by s.salon_id;");
        return $respuesta;
    }

    public function getIdSalon($idSalon) {
        $respuesta = $this->realizarConsulta("
            SELECT *
            FROM salones
            WHERE salon_id='$idSalon'");
        return $respuesta;
    }

    public function set($curso, $profesor, $periodo, $estado) {
        $data = $this->getSalon($periodo, $curso);
        if ($data == null) {
            $resultadoSalon = $this->realizarIngresoId("INSERT INTO salones VALUES (null,'$curso','$periodo','$estado')");
            if ($resultadoSalon > 0) {
                $resultadoProfesor = $this->setProfesor($resultadoSalon, $profesor, $periodo);
                if ($resultadoProfesor > 0) {
//                $this->historial(1, 'cursos', 'insertar', $resultado, 'registro de un curso en el sistema');
                    return $this->mensajes('success', 'Registro exitoso');
                } else {
                    $this->realizarIngreso("DELETE FROM salones WHERE salon_id='$resultadoSalon'");
                    return $this->mensajes('error', 'No se pudo hacer el registro');
                }
            } else {
                return $this->mensajes('error', 'No se pudo hacer el registro 1');
            }
        } else {
            $resultadoProfesor = $this->setProfesor($data[0]['salon_id'], $profesor, $periodo);
            if ($resultadoProfesor > 0) {
//                $this->historial(1, 'cursos', 'insertar', $resultado, 'registro de un curso en el sistema');
                return $this->mensajes('success', 'Registro exitoso');
            } else {
                return $this->mensajes('error', 'El profesor asignado ya en encuetra en este curso');
            }
        }
    }

    public function editEstadoSalon($id, $estado) {
        if ($estado == 2) {
            $this->realizarIngreso("UPDATE salones SET estado_id=2 where salon_id='$id'");
//            $datos = realizarConsulta("SELECT * FROM salones where salon_id='$id' and estado_id=1");
//            for ($i = 0; $i < count($datos); $i++) {
//                estadoSalon($datos[$i]['salon_id'], $datos[$i]['estado_id']);
//            }
        } else {
            $this->realizarIngreso("UPDATE salones SET estado_id=1 where salon_id='$id'");
        }
    }

    public function edit($idSalon, $profesor, $periodo) {
        $data = $this->getIdSalon($idSalon);
        if ($data != null) {
            $resultado = $this->realizarIngreso("Delete FROM asignar_profesor where salon_id='$idSalon';");
            if ($resultado > 0) {
//                $this->historial(1, 'cursos', 'editar', $idCurso, 'edición de curso en el sistema');
                for ($i = 0; $i < count($profesor); $i++) {
                    $resultadoProfesor = $this->setProfesor($idSalon, $profesor[$i], $periodo);
                }
                return $this->mensajes('success', 'Editado exitosamente el salon');
            } else {
                return $this->mensajes('info', 'No hay cambios presentes');
            }
        } else {
            return $this->mensajes('error', 'Salon con registro no existente');
        }
    }

}
