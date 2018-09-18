<?php

require_once '../conexion/php_conexion.php';

class Curso extends php_conexion {

    public function get() {
        $respuesta = $this->realizarConsulta("
            SELECT c.curso_id as id,c.nombre as salon,c.jornada as horario,c.cant_alumnos as numero,
                   c.paralelo as para,c.estado_id as estado,n.nombre as nivel, c.nivel_id as nivelI 
            FROM cursos c, nivel_educacion n 
            WHERE c.nivel_id=n.nivel_id");
        return $respuesta;
    }

    public function getCurso($nombre, $paralelo) {
        $respuesta = $this->realizarConsulta("
            SELECT * 
            FROM cursos 
            WHERE nombre='$nombre' and paralelo='$paralelo'");
        return $respuesta;
    }

    public function getId($idCurso) {
        $respuesta = $this->realizarConsulta("
            SELECT curso_id as id,nombre as salon,jornada as horario,cant_alumnos as numero,
                   paralelo as para,estado_id as estado,nivel_id as nivelI
            FROM cursos 
            WHERE curso_id='$idCurso'");
        return $respuesta;
    }

    public function set($nombre, $jornada, $cantidad, $paralelo, $estado, $nivel) {
        $data = $this->getCurso($nombre, $paralelo);
        if ($data == null) {
            $resultado = $this->realizarIngresoId("INSERT INTO cursos VALUES (null,'$nombre','$jornada','$cantidad','$paralelo','$estado','$nivel')");
            if ($resultado > 0) {
                $this->historial(1, 'cursos', 'insertar', $resultado, 'registro de un curso en el sistema');
                return $this->mensajes('success', 'Registro exitoso');
            } else {
                return $this->mensajes('error', 'No se pudo hacer el registro');
            }
        } else {
            return $this->mensajes('error', 'Registro de curso existente');
        }
    }

    public function edit($idCurso, $nombre, $jornada, $cantidad, $paralelo, $estado, $nivel) {
        $data = $this->getId($idCurso);
        if ($data != null) {
            $resultado = $this->realizarIngreso("UPDATE cursos SET nombre='$nombre', jornada='$jornada', cant_alumnos='$cantidad',paralelo='$paralelo',estado_id='$estado',nivel_id='$nivel' where curso_id='$idCurso'");
            if ($resultado > 0) {
                $this->historial(1, 'cursos', 'editar', $idCurso, 'edición de curso en el sistema');
                return $this->mensajes('success', 'Usuario editado exitosamente');
            } else {
                return $this->mensajes('info', 'No hay cambios presentes');
            }
        } else {
            return $this->mensajes('error', 'Usuario con registro no existente');
        }
    }

}
