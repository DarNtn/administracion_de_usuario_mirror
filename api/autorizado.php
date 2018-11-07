<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Obtiene la información personal de un autorizado/representante/padre a partir de su cédula
function getAutorizado($cedulaR){
    
    global $php_conexion;
    
    if (!empty($cedulaR)) {
        $dato = $php_conexion->realizarConsulta("
            SELECT  a.cedula, a.nombre, a.apellido, a.direccion, a.telefono, a.correo, 
                    ec.descripcion as 'estado_civil',
                    g.sexo                             
            FROM    autorizado a, estado_civil ec, generos g                    
            WHERE   a.cedula = '$cedulaR' and 
                    g.genero_id = a.genero_id and
                    ec.estado_civil_id = a.estado_civil_id;
        ");
    }
    
    $respuesta = $dato!=null ? "true" : "false";
    
    $json = array("respuesta" => $respuesta,
                   "autorizado" => $dato[0] );
        
    return json_encode($json);    
}
// Obtiene una lista de representantes/autorizados/padres que tiene un alumno a partir de la cédula del alumno
function getAutorizados($cedulaAlumno){
    
    global $php_conexion;
    
    if (!empty($cedulaAlumno)){
        $dato = $php_conexion->realizarConsulta("
            SELECT  a.cedula, a.nombre, a.apellido,
                    pa.parentesco,                    
                    au.tipo as funcion                     
            FROM    autorizado a, parentesco pa, autorizacion au, alumno al
            WHERE   a.cedula = au.autorizado_cedula and
                    al.cedula = au.alumno_cedula and
                    al.cedula = '$cedulaAlumno' and 
                    au.parentesco_id = pa.idparentesco;                    
        ");
    }
    
    $respuesta = $dato!=null ? "true" : "false";
    
    $json = array("respuesta" => $respuesta,
                   "autorizados" => $dato );
        
    return json_encode($json);
}