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
    
}