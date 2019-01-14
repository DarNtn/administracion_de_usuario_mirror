<?php

require_once '../conexion/php_conexion.php';

class Profesor extends php_conexion {        

    function crearProfesor($cedula, $nombres, $apellidos, $especialidadId, 
                $telefono, $correo, $usuarioCreacion, $generoId, $estadoCivilId, 
                $direccion, $fechaNacimiento, $fechaInicioLaboral, $anosExperiencia, 
                $nCargas, $curriculum, $foto, $usuario, $contrasena) {

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
                    $nCargas, $curriculum, $idUsuarioIngresado, $foto, '$cedula');
            ");
            return $respuesta;
        }
        
        return 0;
        
    }
    
    
    function getMensajesEntrada($idProf){
        $consulta = $this->realizarConsulta("SELECT * FROM personal WHERE personal_id = '$idProf'");
        if ($consulta){
            $mensajes = $this->realizarConsulta("SELECT c.nombre as curso, c.paralelo, a.nombre as autnombre, a.apellido as autapellido, m.id_mensaje, m.asunto, m.contenido, m.fecha FROM mensaje_autorizado ma, mensaje m, autorizado a, alumno al, cursos c WHERE ma.id_mensaje = m.id_mensaje AND ma.cedula_autorizado = a.cedula AND ma.cedula_alumno = al.cedula AND al.curso_id = c.curso_id AND ma.profesor_id = '$idProf'");
            
            return $mensajes;            
        }
        return null;
    }
    
    function getMensaje($idMensaje){
        $adjunto = $this->realizarConsulta("SELECT * FROM adjunto WHERE mensaje_id='$idMensaje'");        
        $mensaje = $this->realizarConsulta("SELECT * FROM mensaje WHERE id_mensaje = '$idMensaje'");     
                
        return $this->respuestaJson(array("mensaje" => $mensaje[0], "adjunto" => $adjunto[0]));
    }
    
}