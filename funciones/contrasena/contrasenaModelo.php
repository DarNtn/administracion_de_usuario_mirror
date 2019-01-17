<?php

require_once '../conexion/php_conexion.php';

class Contrasena extends php_conexion {

    public function cambiarContrasena($username, $tipoUsuario, $contrasenaAntigua, $contrasenaNueva){
       
        if($tipoUsuario == "a"){
            
            $res = $this->realizarConsulta("
                select usuario_id from usuario where tipo='a' and usuario='$username' and clave='$contrasenaAntigua';
            ");
        }
        
        if($tipoUsuario == "p"){
            
            $res = $this->realizarConsulta("
                select usuario_id 
                from usuario 
                where tipo='p' and usuario='$username' and clave='$contrasenaAntigua';
            ");
            
        }
        
        if($res != null){
            $usuario_id = $res[0]['usuario_id'];
            $res = $this->realizarIngreso("
                update usuario 
                set clave='$contrasenaNueva'
                where usuario_id=$usuario_id;
            ");
            return $this->mensajes('success', 'Contraseña modificada con éxito');
        }else{
            return $this->mensajes('error', 'Contraseña incorrecta'); 
        }
         
    }
}
