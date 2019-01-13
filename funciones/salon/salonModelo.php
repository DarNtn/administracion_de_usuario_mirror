<?php

require_once '../conexion/php_conexion.php';

class Salon extends php_conexion {

    public function get() {
        
        $respuesta = $this->realizarConsulta("
            select 
                curso.curso_id, curso.nombre, periodo.anio_inicio, periodo.anio_fin, curso.paralelo, curso.jornada, nivel.nombre as nivel, curso.cant_alumnos as nEstudiantes, curso.estado_id
            from 
                cursos curso, nivel_educacion nivel, periodo_electivo periodo
            where 
                nivel.nivel_id = curso.nivel_id and periodo.periodo_id = curso.periodo_electivo_periodo_id"); 
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
            select 
                *
            from 
                cursos curso
            where 
                curso.curso_id = $idSalon
        ");
        
        return $respuesta;
        
    }

    public function getIdSalon($idSalon) {
        $respuesta = $this->realizarConsulta("
            SELECT *
            FROM salones
            WHERE salon_id='$idSalon'");
        return $respuesta;
    }
    
    public function set($periodo, $jornada, $nivel, $paralelo, $nEstudiantes) {

        $res = $this->realizarIngreso("INSERT INTO `cursos` value (null, 'default', '$jornada', $nEstudiantes, '$paralelo', 1, $nivel, 'admin', CURDATE(), null, $periodo);");
        if($res>0){
            return $this->mensajes('success', 'Registro de curso exitoso');
        }else{
            return $this->mensajes('error', 'No se pudo registrar el curso correctamente'); 
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

    public function edit($idSalon, $periodo, $jornada, $nivel, $paralelo, $nEstudiantes) {
        
        $res = $this->realizarIngreso("
            update 
                cursos
            set 
                jornada='$jornada', nivel_id=$nivel, paralelo='$paralelo', cant_alumnos=$nEstudiantes,
                periodo_electivo_periodo_id=$periodo
            where 
                curso_id=$idSalon"
        );
        
        if($res>0){
            return $this->mensajes('success', 'El curso se ha modificado exitosamente');
        }else{
            return $this->mensajes('error', 'El curso no se ha modificado'); 
        }
        
    }

}
