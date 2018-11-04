<?php

function auth($user, $password){
    
    global $php_conexion;
    
    if (!empty($user) && !empty($password)) {
        $dato = $php_conexion->realizarConsulta("SELECT * FROM usuario WHERE usuario='$user' and clave='$password'");
    }
    
    $respuesta = $dato!=null ? "true" : "false";
    $json = array("respuesta" => $respuesta);
        
    return json_encode($json);
    
}
