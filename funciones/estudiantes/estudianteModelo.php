<?php

require_once '../conexion/php_conexion.php';

class Estudiante extends php_conexion {        

    function lista_alumno() {
        $dato = $this->realizarConsulta("                                
            select 

            alumno.cedula, alumno.nombres, alumno.apellidos, alumno.direccion, alumno.fecha_nacimiento, alumno.foto_direccion, alumno.observacion, alumno.pension, 
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

    function buscarRepresentante($idR) {
        $dato = $this->realizarConsulta("SELECT * FROM autorizado WHERE cedula='$idR'");
        
        if ($dato == NULL) {
            $dato = array('0' => array('0' => '0', 'cedula' => null));            
        }
        return $dato;
    }

    function listaRepresenAsigna($idAlumno) {
        $dato = $this->realizarConsulta("SELECT r.cedula,r.nombre,r.apellido, ec.descripcion, pa.parentesco,r.direccion,r.telefono,r.correo,pa.idparentesco
FROM autorizacion ar,alumno a,autorizado r,estado_civil ec,parentesco pa
where ar.alumno_cedula=a.cedula and ar.autorizado_cedula=r.cedula and r.estado_civil_id=ec.estado_civil_id
and ar.parentesco_id=pa.idparentesco and a.cedula='$idAlumno';");
        return $dato;
    }

    function crearRepresentante($cedula, $nombres, $apellidos, $direccion, $sexo, $telefono, $email, $civil, $cuenta) {
        $dato = $this->realizarConsulta("SELECT * FROM autorizado WHERE cedula='$cedula'");
        if ($dato == null) {
            $cuenta_id = null;           
            if ($cuenta != null){
                $comprobacion = $this->realizarConsulta("SELECT * FROM usuario WHERE usuario='$cuenta[0]'");                
                if ($comprobacion == null) {
                    $cuenta_id = $this->realizarIngresoId("INSERT INTO usuario (usuario, clave, tipo, estado_id) VALUES('$cuenta[0]','$cuenta[1]','r',1)");
                    $this->realizarIngresoId("INSERT INTO autorizado (cedula,nombre,apellido,genero_id,direccion,telefono,correo,estado_civil_id,usuario_usuario_id) VALUES('$cedula','$nombres','$apellidos',$sexo,'$direccion','$telefono','$email',$civil,$cuenta_id)");
                }
            } else{
                $this->realizarIngresoId("INSERT INTO autorizado (cedula,nombre,apellido,genero_id,direccion,telefono,correo,estado_civil_id) VALUES('$cedula','$nombres','$apellidos',$sexo,'$direccion','$telefono','$email',$civil)");
            }
            
            $dato = $this->realizarConsulta("SELECT * FROM autorizado WHERE cedula='$cedula'");
            return $dato==null? null: $cedula;          
        } else {
            return $dato[0]['cedula'];
        }
    }

    function crearEstudiante($cedula, $nombres, $apellidos, $sexo, $direccion, $tiene_discapacidad, $porcentaje_discapacidad, $fecha_nacimiento, $lugar_nacimiento, $tipo_sangre, $user, $instituto, $tipoD, $observacion, $pension) {
        
        // Insertar datos médicos
        $porcentaje_discapacidad = (int)$porcentaje_discapacidad;
        $tipo_sangre = (int)$tipo_sangre;
        $tiene_discapacidad = ($tiene_discapacidad == "SI") ? 2: 1;
        $dato = $this->realizarConsulta("SELECT * FROM datos_medicos WHERE alumnos_cedula='$cedula'");
        if($dato == null){
            $resultado = $this->realizarIngreso("INSERT INTO datos_medicos VALUES($tiene_discapacidad, $porcentaje_discapacidad, '$tipoD', '$cedula', $tipo_sangre)");
            if($resultado == 1){
                // Insertar estudiante
                $estado_id = (int) $this->realizarConsulta("SELECT estado_id FROM estados WHERE nombre='Activo'");
                $dato = $this->realizarConsulta("SELECT * FROM alumnos WHERE cedula='$cedula'");
                if ($dato == null) {
                    $resultado = $this->realizarIngreso("INSERT INTO alumno VALUES('$cedula', '$nombres', '$apellidos', $sexo, '$direccion', '$fecha_nacimiento', $lugar_nacimiento, '', CURDATE(), '$user', $estado_id, $instituto, '$observacion', $pension, 0)");
                    return $resultado;
                }
                
            }
        }
        return $resultado;
        
    }

    function fotoEstudiante($id, $direccion) {
        return $this->realizarIngreso("UPDATE alumno SET foto_direccion='$direccion' where cedula='$id'");
    }

    function documentoEstudiante($cedula, $nombre, $direccion) {
        return $this->realizarIngreso("insert into documento values('$direccion', '$nombre', '$cedula')");
    }

    function modificarEstudiante($cedula_sin_modificar, $cedula, $nombres, $apellidos, $sexo, $direccion, $tiene_discapacidad, $porcentaje_discapacidad, $fecha_nacimiento, $lugar_nacimiento, $tipo_sangre, $user, $instituto, $tipoD, $observacion) {

        $dato = $this->realizarConsulta("SELECT * FROM alumno WHERE cedula='$cedula_sin_modificar'");
        if ($dato != null) {
            
            // Actualizar alumno
            $this->realizarIngreso("update alumno set cedula='$cedula', nombres='$nombres', apellidos='$apellidos',
					genero_id=$sexo, direccion='$direccion', fecha_nacimiento='$fecha_nacimiento',
                                        lugar_id=$lugar_nacimiento, instituciones_id=$instituto,observacion='$observacion'
                                        where cedula='$cedula_sin_modificar'");
            
            // Actualizar datos médicos de un alumno
            $this->realizarIngreso("update datos_medicos set alumnos_cedula='$cedula', porcentaje_discapacidad=$porcentaje_discapacidad,
                                    tipo_discapacidad='$tipoD', idgrupo_sanguineo=$tipo_sangre, tiene_discapacidad=$tiene_discapacidad
                                    where alumnos_cedula='$cedula_sin_modificar'");
            
            return true;
            
        } else {
            
            return false;
            
        }
    }

    function eliminarRepresentantes($id) {
        $this->realizarIngreso("Delete from autodrizacion where alumno_cedula='$id'");
    }
    
    function eliminarDocumento($direccion) {
        $this->realizarIngreso("Delete from documento where link='$direccion'");
    }

    function asignarRepresentante($alumno, $representate, $tipo, $parentesco) {
        $dato = $this->realizarConsulta("SELECT * FROM asignar_representante WHERE alumno_id='$alumno' and representante_id='$representate'");
        if ($dato == null) {
            $this->realizarIngresoId("INSERT INTO autorizacion (alumno_cedula,autorizado_id,parentesco_id,tipo) VALUES('$alumno','$representate','$parentesco','$tipo')");
        }
    }

    function buscarEstudiante($cedula) {
        $dato = $this->realizarConsulta("select 
            alumno.*,
            datos_medicos.tiene_discapacidad, datos_medicos.porcentaje_discapacidad, tipo_discapacidad,
            grupo_sanguineo.idgrupo_sanguineo as 'grupo_sanguineo_id'

            from alumno alumno, datos_medicos datos_medicos, grupo_sanguineo grupo_sanguineo

            where alumno.cedula=datos_medicos.alumnos_cedula and datos_medicos.idgrupo_sanguineo=grupo_sanguineo.idgrupo_sanguineo and alumno.cedula = '$cedula';
        ");
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

    function cargarDocumentos($cedula){
        $dato = $this->realizarConsulta("                                
            select *
            from documento
            where alumno_cedula='$cedula'
        ");
        
        return $dato;
    }
}
