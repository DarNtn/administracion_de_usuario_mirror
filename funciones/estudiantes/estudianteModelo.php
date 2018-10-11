<?php

require_once '../conexion/php_conexion.php';

class Estudiante extends php_conexion {

    function lista_alumno() {
        $dato = $this->realizarConsulta("                                
            select 

            alumno.cedula, alumno.nombres, alumno.apellidos, alumno.direccion, alumno.fecha_nacimiento, alumno.foto_direccion, alumno.observacion, alumno.certificado_direccion, alumno.pension, 
            generos.sexo,
            lugares.provincia, lugares.ciudad,
            estados.nombre as 'estado', 
            instituciones.nombre as 'institucion',
            cursos.nombre as 'curso', 
            datos_medicos.tiene_discapacidad, datos_medicos.porcentaje_discapacidad, tipo_discapacidad,
            grupo_sanguineo.nombre as 'grupo_sanguineo'

            from alumno alumno, generos generos, lugares lugares, estados estados, instituciones instituciones, cursos cursos, datos_medicos datos_medicos, grupo_sanguineo grupo_sanguineo
            where alumno.genero_id=generos.genero_id and alumno.cedula=datos_medicos.alumnos_cedula and alumno.instituciones_id=instituciones.institucion_id and alumno.lugar_id=lugares.lugar_id and datos_medicos.idgrupo_sanguineo=grupo_sanguineo.idgrupo_sanguineo and estados.estado_id=alumno.estado_id;
        ");
        
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
        
        // Insertar datos médicos
        $porcentaje_discapacidad = (int)$porcentaje_discapacidad;
        $tipo_sangre = (int)$tipo_sangre;
        $tiene_discapacidad = ($tiene_discapacidad == "SI") ? 1: 0;
        $dato = $this->realizarConsulta("SELECT * FROM datos_medicos WHERE alumnos_cedula='$cedula'");
        if($dato == null){
            $resultado = $this->realizarIngreso("INSERT INTO datos_medicos VALUES($tiene_discapacidad, $porcentaje_discapacidad, '$tipoD', '$cedula', $tipo_sangre)");
        }
        
        // Insertar alumno (FALTA)
        // Verificar como se manejan la ruta para las fotografías (foto_direccion)
        // Obtener el id del estado habilitado
        // Verificar como se manejan la ruta para los certificados (certificado_direccion)
        // Obtener pensión
        // Curso queda pendiente, por el momento se pasará 0
        
        $dato = $this->realizarConsulta("SELECT * FROM alumnos WHERE cedula='$cedula'");
        if ($dato == null) {
            $resultado = $this->realizarIngresoId("INSERT INTO alumno VALUES('$cedula', '$nombres', '$apellidos', $sexo, '$direccion', '$fecha_nacimiento', $lugar_nacimiento, '', CURDATE(), '$user', 0, $instituto, '$observacion', '', 0, 0)");
//                    . "'$cedula','$nombres','$apellidos',$sexo,'$direccion',"
//                    . "'$fecha_nacimiento',$lugar_nacimiento,'fotos/user.png',CURDATE(),'$user',null,$instituto,'$observacion',"
//                    . "'certificados/defaul.jpg', null, null)");
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
