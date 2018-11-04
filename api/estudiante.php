<?php

function getEstudiante($cedula){
    
    global $php_conexion;
    
    if (!empty($cedula)) {
        $dato = $php_conexion->realizarConsulta("
            SELECT  alumno.cedula, alumno.nombres, alumno.apellidos, alumno.direccion, alumno.fecha_nacimiento,
                    alumno.observacion, alumno.pension,
                    generos.sexo,
                    estados.nombre as 'estado',
                    instituciones.nombre as 'institucion',
                    datos_medicos.tiene_discapacidad, datos_medicos.porcentaje_discapacidad, datos_medicos.tipo_discapacidad,
                    grupo_sanguineo.nombre as 'grupo_sanguineo'
            FROM    alumno alumno, datos_medicos datos_medicos, grupo_sanguineo grupo_sanguineo, generos generos,
                    estados estados, instituciones instituciones
            WHERE   alumno.cedula = datos_medicos.alumnos_cedula and 
                    datos_medicos.idgrupo_sanguineo = grupo_sanguineo.idgrupo_sanguineo and 
                    alumno.cedula = '$cedula' and 
                    generos.genero_id = alumno.genero_id and
                    estados.estado_id = alumno.estado_id and
                    instituciones.institucion_id = alumno.instituciones_id;
        ");
    }
    
    $respuesta = $dato!=null ? "true" : "false";
    
    $json = array("respuesta" => $respuesta,
                   "alumno" => $dato[0] );
        
    return json_encode($json);
    
}
