<?php

require_once '../conexion/php_conexion.php';

class Profesor extends php_conexion {        
    
    function crearProfesor($cedula, $nombres, $apellidos, $especialidadId, 
            $telefono, $correo, $usuarioCreacion, $generoId, $estadoCivilId, 
            $direccion, $fechaNacimiento, $fechaInicioLaboral, $anosExperiencia, 
            $nCargas, $curriculum, $usuario, $contrasena) {

        // Se registra usuario y contraseña en la tabla usuario
        $idUsuarioIngresado = $this->realizarIngresoId("                                
            INSERT INTO usuario VALUES('$usuario', '$contrasena', 'p', NULL, 1);
        ");

        if($idUsuarioIngresado>0){
            $respuesta = $this->realizarIngreso("                                
                INSERT INTO personal VALUES(NULL, '$nombres', '$apellidos',
                    $especialidadId, '$telefono', '$correo', '2018-02-22',
                    $usuarioCreacion, $generoId, $estadoCivilId, '$direccion',
                    '$fechaNacimiento', '$fechaInicioLaboral', $anosExperiencia,
                    $nCargas, $curriculum, $idUsuarioIngresado, '', '$cedula');
            ");
            return $respuesta;
        }

        return 0;

    }
    
    function obtenerListaProfesores(){
        
        $respuesta= $this->realizarConsulta(" 
            
            select 
                personal. cedula, personal.nombres, personal. apellidos, personal.mail as correo,
                usuario.usuario,
                estados.nombre as estado
            from 
                personal, usuario, estados
            where 
                personal.usuario_id = usuario.usuario_id and usuario.estado_id = estados.estado_id;
            
        ");
        
        return $respuesta;
        
    }
 
    function obtenerProfesorPorCedula($cedula){
    
        $respuesta= $this->realizarConsulta(" 
            
            select 
                personal.*,
                usuario.usuario, usuario.clave,
                estados.nombre as estado
            from 
                personal, usuario, estados
            where 
                personal.usuario_id = usuario.usuario_id and usuario.estado_id = estados.estado_id
                and personal.cedula = '$cedula';
            
        ");
        
        return $respuesta;
        
    }
    
    function foto($id, $direccion) {
        
        return $this->realizarIngreso("UPDATE personal SET foto='$direccion' where cedula='$id'");
        
    }
    
    function curriculum($id, $direccion) {
        
        return $this->realizarIngreso("UPDATE personal SET curriculum_direccion='$direccion' where cedula='$id'");
        
    }
 
    function deshabilitarProfesor($cedula, $estado){
        
        $usuario_id = $this->realizarConsulta("select usuario_id from personal where cedula='$cedula'");
        $usuario_id = $usuario_id[0]['usuario_id'];
                
        if ($estado == "Activo") {
            return $this->realizarIngreso("UPDATE usuario SET estado_id=2 where usuario_id='$usuario_id'");
        } elseif ($estado == "Inactivo") {
            return $this->realizarIngreso("UPDATE usuario SET estado_id=1 where usuario_id='$usuario_id'");
        }
    }

    
    function getMensajesEntrada($uProf){
        $consulta = $this->realizarConsulta("SELECT p.personal_id as id FROM personal p, usuario u WHERE p.usuario_id = u.usuario_id AND u.usuario = '$uProf'");
        if ($consulta){
            $idProf = $consulta[0]['id'];
            $mensajes = $this->realizarConsulta("SELECT c.nombre as curso, c.paralelo, a.nombre as autnombre, a.apellido as autapellido, m.id_mensaje, m.asunto, m.contenido, m.fecha FROM mensaje_autorizado ma, mensaje m, autorizado a, alumno al, cursos c WHERE ma.id_mensaje = m.id_mensaje AND ma.cedula_autorizado = a.cedula AND ma.cedula_alumno = al.cedula AND al.curso_id = c.curso_id AND ma.profesor_id = '$idProf'");
            
            return $mensajes;            
        }
        return null;
    }
    
    function getMensaje($idMensaje){
        $adjunto = $this->realizarConsulta("SELECT * FROM adjunto WHERE mensaje_id='$idMensaje'");  
        $mensaje = $this->realizarConsulta("SELECT c.nombre as curso, c.paralelo, a.nombre as autnombre, a.apellido as autapellido, m.id_mensaje, m.asunto, m.contenido, m.fecha FROM mensaje_autorizado ma, mensaje m, autorizado a, alumno al, cursos c WHERE ma.id_mensaje = m.id_mensaje AND ma.cedula_autorizado = a.cedula AND ma.cedula_alumno = al.cedula AND al.curso_id = c.curso_id AND m.id_mensaje = '$idMensaje'");
        //$mensaje = $this->realizarConsulta("SELECT * FROM mensaje WHERE id_mensaje = '$idMensaje'");     
                
        return $this->respuestaJson(array("mensaje" => $mensaje[0], "adjunto" => $adjunto[0]));
    }
    
    function getCitaciones($uProf){
        $consulta = $this->realizarConsulta("SELECT p.personal_id as id FROM personal p, usuario u WHERE p.usuario_id = u.usuario_id AND u.usuario = '$uProf'");
        if ($consulta){
            $idProf = $consulta[0]['id'];
            $citaciones = $this->realizarConsulta("SELECT c.nombre as curso, c.paralelo, m.asunto, m.contenido, ci.fecha, ci.hora, ci.duración, mc.id_mensaje_curso as id FROM mensaje_curso mc, mensaje m, citacion ci, cursos c WHERE mc.mensaje = m.id_mensaje AND mc.curso = c.curso_id AND mc.mensaje = ci.id_citacion AND mc.profesor = '$idProf'");
            
            return $citaciones;            
        }
        return null;
    }
    
    function getCitacion($idCitacion){
        $adjunto = $this->realizarConsulta("SELECT * FROM adjunto a, mensaje_curso mc WHERE mc.mensaje = a.mensaje_id AND mc.id_mensaje_curso = '$idCitacion'");  
        $mensaje = $this->realizarConsulta("SELECT m.asunto, m.contenido, m.fecha FROM mensaje m, mensaje_curso mc WHERE mc.mensaje = m.id_mensaje AND mc.id_mensaje_curso = '$idCitacion'");
        $citacion = $this->realizarConsulta("SELECT c.nombre as curso, c.paralelo, ci.fecha, ci.hora, ci.duración FROM mensaje_curso mc, citacion ci, cursos c WHERE mc.mensaje = ci.id_citacion AND mc.curso = c.curso_id AND mc.id_mensaje_curso = '$idCitacion'");
        
        return $this->respuestaJson(array("mensaje" => $mensaje[0], "adjunto" => $adjunto[0], "citacion" => $citacion[0]));
    }
    
}