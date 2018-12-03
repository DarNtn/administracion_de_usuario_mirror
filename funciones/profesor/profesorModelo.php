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
    
    function getListaProfesores(){
        
        $respuesta= $this->realizarConsulta(" 
            
            select 

            alumno.cedula, alumno.nombres, alumno.apellidos, alumno.direccion, alumno.fecha_nacimiento, alumno.foto_direccion, alumno.observacion, alumno.pension, 
            generos.sexo,
            lugares.provincia, lugares.ciudad,
            estados.nombre as 'estado', 
            instituciones.nombre as 'institucion', 
            datos_medicos.tiene_discapacidad, datos_medicos.porcentaje_discapacidad, tipo_discapacidad,
            grupo_sanguineo.nombre as 'grupo_sanguineo'

            from alumno alumno, generos generos, lugares lugares, estados estados, instituciones instituciones, datos_medicos datos_medicos, grupo_sanguineo grupo_sanguineo
            where alumno.genero_id=generos.genero_id and alumno.cedula=datos_medicos.alumnos_cedula and alumno.instituciones_id=instituciones.institucion_id and alumno.lugar_id=lugares.lugar_id and datos_medicos.idgrupo_sanguineo=grupo_sanguineo.idgrupo_sanguineo and estados.estado_id=alumno.estado_id;
            
        ");
        
        return $respuesta;
        
    }
}