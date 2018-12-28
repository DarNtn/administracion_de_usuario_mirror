<?php

require_once '../conexion/php_conexion.php';

class Curso extends php_conexion {

    public function get() {
        $respuesta = $this->realizarConsulta("
            SELECT c.curso_id as id,c.nombre as curso,c.jornada as jornada,c.cant_alumnos as cantidad,
                   c.paralelo as paralelo,e.nombre as estado,n.nombre as nivel, pl.anio_inicio as aInicio, pl.anio_fin as aFin
            FROM cursos c, periodo_electivo pl, nivel_educacion n, estados e
            WHERE c.nivel_id=n.nivel_id and c.estado_id = e.estado_id and c.periodo_electivo_periodo_id = pl.periodo_id");
        return $respuesta;
    }
    
    public function getCursosAsignados() {
        $respuesta = $this->realizarConsulta("
            SELECT c.curso_id as id,c.nombre as curso,c.jornada as jornada,c.cant_alumnos as cantidad,
                   c.paralelo as paralelo,e.nombre as estado,n.nombre as nivel, pl.anio_inicio as aInicio, pl.anio_fin as aFin, pr.nombres as nombre, pr.apellidos as apellido
            FROM cursos c, periodo_electivo pl, nivel_educacion n, estados e, personal pr
            WHERE c.nivel_id=n.nivel_id and c.estado_id = e.estado_id and c.periodo_electivo_periodo_id = pl.periodo_id and c.dirigente = pr.personal_id");
        return $respuesta;
    }
    
    public function getCursosbyJornada($jornada){
        //$respuesta = $this->realizarConsulta("SELECT curso_id as id, nombre as curso FROM cursos WHERE jornada='$jornada'");
        $respuesta = $this->realizarConsulta("SELECT DISTINCT nombre as curso FROM cursos WHERE jornada='$jornada'");
        
        return $respuesta;
    }
    
    public function getParalelosbyJornadaCurso($curso, $jornada){
        $respuesta = $this->realizarConsulta("SELECT paralelo FROM cursos WHERE nombre='$curso' and jornada='$jornada' and dirigente=0");
        
        return $respuesta;
    }
    
    public function getMateriasCurso($idCurso){
        $respuesta = $this->realizarConsulta("SELECT m.id_materia as id, m.nombre as materia FROM cursos c, detalle_materia dm, materia m WHERE c.curso_id = '$idCurso' and c.curso_id = dm.id_curso and dm.id_materia = m.id_materia");
        
        return $respuesta;
    }
    
    public function getMateriasAsignadas($idCurso){
        $respuesta = $this->realizarConsulta("SELECT m.id_materia as id, m.nombre as materia, dm.id_profesor, p.nombres, p.apellidos FROM cursos c, detalle_materia dm, materia m, personal p WHERE c.curso_id = '$idCurso' and c.curso_id = dm.id_curso and dm.id_materia = m.id_materia and dm.id_profesor = p.personal_id");
        
        return $respuesta;
    }
    
    public function asignarMateria($idMateria, $idProfesor, $idCurso){
        $resultado = $this->realizarIngresoId("INSERT INTO detalle_materia (id_materia, id_profesor, id_curso) VALUES ('$idMateria', '$idProfesor', '$idCurso')");
        if ($resultado > 0){
            return true;
        } else {
            return false;
        }
    }
    
    public function eliminarAsignacionesMateria($idCurso){
        $this->realizarIngreso("DELETE FROM detalle_materia WHERE id_curso = '$idCurso'");
                
    }


    public function getIdCurso($curso, $jornada, $paralelo, $idProfesor){          
        $respuesta = $this->realizarConsulta("SELECT curso_id as id FROM cursos WHERE nombre='$curso' and jornada='$jornada' and paralelo='$paralelo' and dirigente='$idProfesor'");
        
        return $respuesta;
    }
    
    public function asignarDirigente($idProfesor, $curso, $paralelo, $jornada){
        $resultado = $this->realizarIngreso("UPDATE cursos SET dirigente='$idProfesor' WHERE nombre='$curso' and paralelo='$paralelo' and jornada='$jornada'");
        if ($resultado > 0){
            return $this->mensajes('success', 'Registro exitoso');
        } else{
            return $this->mensajes('error', 'No se pudo realizar el registro');
        }        
    }
        
    public function cambiarDirigente($jornada, $curso, $paralelo, $idProfesor) {
        $idCurso = $this->getIdCurso($curso, $jornada, $paralelo, $idProfesor);
        
        if ($idCurso){
            return $this->mensajes('warning', 'El profesor ya consta como dirigente');
        } else {
            $resultado = $this->realizarIngreso("UPDATE cursos SET dirigente='$idProfesor' WHERE nombre='$curso' and paralelo='$paralelo' and jornada='$jornada'");
            if ($resultado > 0){
                return $this->mensajes('success', 'Cambio de dirigente realizado');
            } else {
                return $this->mensajes('error', 'No se pudo realizar la edición');
            }
        }
    }
    
    public function disponibilidadProf($idCurso, $clase, $dia){
        $materia = $clase['materia'];
        $desde = $clase['desde'];
        $hasta = $clase['hasta'];        
        $idProf = null;
        $retorno = array('estado' => "success", 'mensaje' => "El horario se registró exitosamente");
        $respuesta = $this->realizarConsulta("SELECT id_profesor as idP FROM detalle_materia WHERE id_materia = '$materia' AND id_curso = '$idCurso'");
        if ($respuesta){
            $idProf = $respuesta[0]['idP'];
            
            $respuesta = $this->realizarConsulta("SELECT h.hora_inicio, h.hora_fin FROM detalle_materia dm, horario h WHERE dm.id_detalle_materia = h.id_detalle_materia AND id_profesor = '$idProf' AND NOT id_curso='$idCurso' AND dia='$dia'");
            if ($respuesta){
                for ($a = 0; $a < count($respuesta); $a++){
                    if (! ($desde >= $respuesta[$a]['hora_fin'] || $hasta <= $respuesta[$a]['hora_inicio'])){                    
                        $profesor = $this->realizarConsulta("SELECT nombres, apellidos FROM personal WHERE personal_id='$idProf'")[0];
                        $retorno = array('estado' => "error", 'mensaje' => "No se pudo registrar el horario debido a un cruce de horas en el horario del profesor " . $profesor['nombres'] . " " . $profesor['apellidos'] . " en el día " . $dia);
                        break;
                    }
                }
            }
        }
        return $retorno;
    }
    
    public function getHorarioCurso($idCurso){
        $respuesta = $this->realizarConsulta("SELECT * FROM horario h, detalle_materia dm WHERE h.id_detalle_materia = dm.id_detalle_materia AND dm.id_curso = '$idCurso'");
        $horario = array("Lunes" => array(), "Martes" => array(), "Miercoles" => array(), "Jueves" => array(), "Viernes" => array());
        if ($respuesta){
            for ($a = 0; $a < count($respuesta); $a++){                
                $horario[$respuesta[$a]['dia']][] = array("desde" => $respuesta[$a]['hora_inicio'], "hasta" => $respuesta[$a]['hora_fin'], "materia" => $respuesta[$a]['id_materia']);
            }                        
        }
        
        return $this->respuestaJson($horario);
    }
    
    public function guardarHorarioCurso($horario, $idCurso){
        $dias = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes"];
        
        $this->borrarHorarios($idCurso);
        for ($a = 0; $a < count($dias); $a++){
            $dia = $dias[$a];
            if (array_key_exists($dia, $horario)){
                $clases = $horario[$dia];        

                for ($b = 0; $b < count($clases); $b++){
                    $clase = $clases[$b];
                    $materia = $clase['materia'];
                    $h_inicio = $clase['desde'];
                    $h_fin = $clase['hasta'];
                    $respuesta = $this->realizarConsulta("SELECT id_detalle_materia as id FROM detalle_materia WHERE id_curso='$idCurso' AND id_materia='$materia'")[0]['id'];
                    $this->realizarIngreso("INSERT INTO horario (dia, hora_inicio, hora_fin, id_detalle_materia) VALUES ('$dia', '$h_inicio', '$h_fin', '$respuesta')");
                }     
            }                   
        }
    }
    
    public function borrarHorarios($idCurso){
        $this->realizarIngreso("DELETE FROM horario WHERE id_horario in (SELECT id FROM (SELECT id_horario as id FROM horario h, detalle_materia dm WHERE dm.id_detalle_materia = h.id_detalle_materia AND dm.id_curso = '$idCurso') AS c)");
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
                return $this->mensajes('success', 'Curso editado exitosamente');
            } else {
                return $this->mensajes('info', 'No hay cambios presentes');
            }
        } else {
            return $this->mensajes('error', 'Curso con registro no existente');
        }
    }

}
