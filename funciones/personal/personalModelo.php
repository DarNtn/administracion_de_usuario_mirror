<?php

require_once '../conexion/php_conexion.php';

class Personal extends php_conexion {

    public function get() {
        $respuesta = $this->realizarConsulta("
            SELECT personal_id as id, nombres as nombre,apellidos as apellido,cedula as identificacion,telefono as tel,
e.descripcion as ocupacion,mail as email,estado_id as estado,g.genero_id as sexo,g.sexo as genero,
estado_civil_id,fechaNac,fechaLaboral,direccion,e.especialidad_id as ocupacion_id,
TIMESTAMPDIFF(YEAR,p.fechaNac,curdate()) as edad,TIMESTAMPDIFF(YEAR,p.fechaLaboral,curdate()) as laboral,
p.curriculum_direccion,ce.tipo as categoria ,ce.categoria_empleo_id as categoria_id
FROM personal p, generos g,especialidades e, categorias_empleo ce
where p.genero_id=g.genero_id and p.especialidad_id=e.especialidad_id and e.categoria_empleo_id=ce.categoria_empleo_id");
        return $respuesta;
    }

    public function getCedula($cedula) {
        $respuesta = $this->realizarConsulta("
            SELECT *
            FROM personal 
            WHERE cedula='$cedula'");
        return $respuesta;
    }

    public function getId($idPersonal) {
        $respuesta = $this->realizarConsulta("
            SELECT personal_id as id, nombres as nombre,apellidos as apellido,cedula as identificacion,
                   telefono as tel,mail as email,estado_id as estado,
                   g.genero_id as sexo,estado_civil_id,fechaNac,fechaLaboral,direccion,
                   e.especialidad_id as ocupacion_id,p.curriculum_direccion,ce.categoria_empleo_id as categoria_id,
                   p.aniosExperiencia,p.cargas,p.curriculum_direccion
            FROM personal p, generos g,especialidades e, categorias_empleo ce
            WHERE p.genero_id=g.genero_id and p.especialidad_id=e.especialidad_id and
                  e.categoria_empleo_id=ce.categoria_empleo_id and personal_id='$idPersonal'");
        return $respuesta;
    }

    public function getEspecialidades($idEspecialidad) {
        $respuesta = $this->realizarConsulta("
            SELECT
            especialidad_id as id, descripcion as nombre 
            FROM especialidades 
            WHERE categoria_empleo_id='$idEspecialidad'");
        return $respuesta;
    }

    public function set($cedula, $nombres, $apellidos, $especialidad, $telefono, $email, $sexo, $estadoCivil, $direccion, $fechaNac, $fechaLab, $anios, $cargas, $estado) {
        $data = $this->getCedula($cedula);
        if ($data == null) {
            $resultado = $this->realizarIngresoId("INSERT INTO personal VALUES(null,'$nombres','$apellidos','$cedula','$especialidad','$telefono','$email', '$estado','$sexo','$estadoCivil','$direccion','$fechaNac'," . ($fechaLab == "" ? "NULL" : "'$fechaLab'") . ",'$anios','$cargas',null)");
            if ($resultado > 0) {
                $this->historial(1, 'personal', 'insertar', $resultado, 'registro de un postulante en el sistema');
//                return $this->mensajes('success', 'Registro exitoso');
                return $resultado;
            } else {
                die($this->mensajes('error', 'No se pudo hacer el registro'));
            }
        } else {
            die($this->mensajes('error', 'Registro con numero de cédula existente'));
        }
    }

    public function setImage($idPersonal, $urlarchivo) {
        $data = $this->getId($idPersonal);
        if ($data != null) {
            $this->realizarIngreso("UPDATE personal SET curriculum_direccion='$urlarchivo' WHERE personal_id='$idPersonal'");
        } else {
            return $this->mensajes('error', 'Postulante con registro no existente');
        }
    }

    public function edit($idPersonal, $cedula, $nombres, $apellidos, $especialidad, $telefono, $email, $sexo, $estadoCivil, $direccion, $fechaNac, $fechaLab, $anios, $cargas, $estado, $urlarchivo) {
        $data = $this->getId($idPersonal);
        if ($data != NULL) {
            if ($urlarchivo != "") {
                $resultado = $this->realizarIngreso("UPDATE personal SET nombres='$nombres',apellidos='$apellidos',cedula='$cedula',especialidad_id='$especialidad',telefono='$telefono',mail='$email', estado_id='$estado',genero_id='$sexo',estado_civil_id='$estadoCivil',direccion='$direccion',fechaNac='$fechaNac',fechaLaboral=" . ($fechaLab == "" ? "NULL" : "'$fechaLab'") . ",aniosExperiencia='$anios',cargas='$cargas',curriculum_direccion='$urlarchivo' where personal_id='$idPersonal'");
            } else {
                $resultado = $this->realizarIngreso("UPDATE personal SET nombres='$nombres',apellidos='$apellidos',cedula='$cedula',especialidad_id='$especialidad',telefono='$telefono',mail='$email', estado_id='$estado',genero_id='$sexo',estado_civil_id='$estadoCivil',direccion='$direccion',fechaNac='$fechaNac',fechaLaboral=" . ($fechaLab == "" ? "NULL" : "'$fechaLab'") . ",aniosExperiencia='$anios',cargas='$cargas' where personal_id='$idPersonal'");
            }
            if ($resultado > 0) {
                $this->historial(1, 'personal', 'editar', $idPersonal, 'edición de un postulante en el sistema');
                die($this->mensajes('info', 'Edición realizada con exito'));
            } else {
                die($this->mensajes('info', 'No hay cambios presentes'));
            }
        } else {
            die($this->mensajes('error', 'Postulante con registro no existente'));
        }
    }

}
