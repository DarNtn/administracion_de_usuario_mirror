<?php

require_once '../conexion/php_conexion.php';

class Estudiante extends php_conexion {

    function lista_alumno() {
        $dato = $this->realizarConsulta("SELECT a.alumno_id,a.cedula,a.nombres,a.apellidos,a.direccion,a.tiene_discapacidad,a.porcentaje_discapacidad,
                        	a.fecha_nacimiento,a.lugar_id,a.estado_id,a.grupo_sangrineo_id,a.foto_direccion,
                                g.genero_id,g.sexo,
                                gs.tipo_sangrineo_id,gs.tipo,
                                i.institucion_id,i.nombre,
                                l.provincia,l.ciudad
                                FROM alumnos a,generos g,grupo_sangineo gs,instituciones i, lugares l
                                where a.genero_id=g.genero_id and a.grupo_sangrineo_id=gs.tipo_sangrineo_id 
                                and a.instituciones_id=i.institucion_id and a.lugar_id=l.lugar_id;");

        return $dato;
    }

    function buscarRepresentante($id) {
        $dato = $this->realizarConsulta("SELECT * FROM representantes WHERE cedula='$id'");
        if ($dato == NULL) {
            $dato = array('0' => array('0' => '0', 'representante_id' => '0'));
        }
        return $dato;
    }

    function listaRepresenAsigna($idAlumno) {
        $dato = $this->realizarConsulta("SELECT r.representante_id as id,r.cedula,r.nombres,r.apellidos, ec.descripcion, pa.parntesco,r.direccion,r.telefono,r.email,pa.parentesco_id
FROM asignar_representante ar,alumnos a,representantes r,estado_civil ec,parentesco pa
where ar.alumno_id=a.alumno_id and ar.representante_id=r.representante_id and r.estado_civil_id=ec.estado_civil_id
and ar.parentesco_id=pa.parentesco_id and a.alumno_id='$idAlumno';");
        return $dato;
    }

    function crearRepresentante($cedula, $nombres, $apellidos, $direccion, $sexo, $telefono, $fecha_nacimiento, $email, $user, $civil, $certificado) {
        $dato = $this->realizarConsulta("SELECT * FROM representantes WHERE cedula='$cedula'");
        if ($dato == null) {
            $resultado = $this->realizarIngresoId("INSERT INTO representantes (cedula,nombres,apellidos,genero_id,direccion,telefono,fecha_nacimiento,email,fecha_creacion,usuario_creacion,estado_id,estado_civil_id,certificado_direccion) VALUES('$cedula','$nombres','$apellidos','$sexo','$direccion','$telefono','$fecha_nacimiento','$email',CURDATE(),'$user', 1,'$civil','$certificado')");
            return $resultado;
        } else {
            return $dato[0]['representante_id'];
        }
    }

    function crearEstudiante($cedula, $nombres, $apellidos, $sexo, $direccion, $tiene_discapacidad, $porcentaje_discapacidad, $fecha_nacimiento, $lugar_nacimiento, $tipo_sangre, $user, $instituto, $tipoD, $observacion) {
        $dato = $this->realizarConsulta("SELECT * FROM alumnos WHERE nombres='$nombres' and apellidos='$apellidos'");
        if ($dato == null) {
            $resultado = $this->realizarIngresoId("INSERT INTO alumnos VALUES(null,'$cedula','$nombres','$apellidos','$sexo','$direccion','$tiene_discapacidad','$porcentaje_discapacidad','$fecha_nacimiento','$lugar_nacimiento','$tipo_sangre','fotos/user.png',CURDATE(),'$user',1,'$instituto','$tipoD','$observacion','certificados/defaul.jpg')");
        } else {
            $resultado = 0;
        }
        return $resultado;
    }

    function fotoEstudiante($id, $direccion) {
        $this->realizarIngreso("UPDATE alumnos SET foto_direccion='$direccion' where alumno_id='$id'");
    }

    function certificadoEstudiante($id, $direccion) {
        $this->realizarIngreso("UPDATE alumnos SET certificado_direccion='$direccion' where alumno_id='$id'");
    }

    function modificarEstudiante($id, $cedula, $nombres, $apellidos, $sexo, $direccion, $tiene_discapacidad, $porcentaje_discapacidad, $fecha_nacimiento, $lugar_nacimiento, $tipo_sangre, $user, $instituto, $tipoD, $observacion) {
        $dato = $this->realizarConsulta("SELECT * FROM alumnos WHERE alumno_id='$id'");
        if ($dato != null) {
            $this->realizarIngreso("Update alumnos Set cedula='$cedula',nombres='$nombres',apellidos='$apellidos',
					genero_id='$sexo',direccion='$direccion',tiene_discapacidad='$tiene_discapacidad',porcentaje_discapacidad='$porcentaje_discapacidad',
					fecha_nacimiento='$fecha_nacimiento',lugar_id='$lugar_nacimiento',grupo_sangrineo_id='$tipo_sangre',
                                        fecha_creacion=CURDATE(),usuario_creacion='$user',instituciones_id='$instituto',tipo_de_discapacidad='$tipoD',observacion='$observacion'
                                        Where alumno_id='$id'");
            return "success";
        } else {
            return "Alumno no se pudo modificar";
        }
    }

    function eliminarRepresentantes($id) {
        $this->realizarIngreso("Delete from asignar_representante where alumno_id='$id'");
    }

    function asignarRepresentante($alumno, $representate, $principal, $parentesco) {
        $dato = $this->realizarConsulta("SELECT * FROM asignar_representante WHERE alumno_id='$alumno' and representante_id='$representate'");
        if ($dato == null) {
            $this->realizarIngresoId("INSERT INTO asignar_representante (alumno_id,representante_id,principal,parentesco_id) VALUES('$alumno','$representate','$principal','$parentesco')");
        }
    }

    function buscarEstudiante($id) {
        $dato = $this->realizarConsulta("SELECT * from alumnos where alumno_id='$id'");
        return $dato;
    }

    function estadoAlumno($id, $estado) {
        if ($estado == "2") {
            $this->realizarIngreso("UPDATE alumnos SET estado_id=1 where alumno_id='$id'");
        } else
        if ($estado == "1") {
            $this->realizarIngreso("UPDATE alumnos SET estado_id=2 where alumno_id='$id'");
        }
    }

}