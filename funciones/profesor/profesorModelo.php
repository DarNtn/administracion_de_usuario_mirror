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
}