<?php

require_once '../conexion/php_conexion.php';
require_once('../mail/mail.php');
class Contrasena extends php_conexion {

    public function cambiarContrasena($username, $tipoUsuario, $contrasenaAntigua, $contrasenaNueva){
       
        if($tipoUsuario == "a"){
            
            $res = $this->realizarConsulta("
                select usuario_id 
                from usuario 
                where tipo='a' and usuario='$username' and clave='$contrasenaAntigua';
            ");
            if($res != null){
                $usuario_id = $res[0]['usuario_id'];
                $correo = $this->realizarConsulta("
                    select correo from administrador where usuarios_usuario_id=$usuario_id;
                ");
                $correo = $correo[0]['correo'];
            }
        }
        
        if($tipoUsuario == "p"){
            
            $res = $this->realizarConsulta("
                select usuario_id 
                from usuario 
                where tipo='p' and usuario='$username' and clave='$contrasenaAntigua';
            ");
        
            if($res != null){
                $usuario_id = $res[0]['usuario_id'];
                $correo = $this->realizarConsulta("
                    select mail from personal where usuario_id=$usuario_id;
                ");
                $correo = $correo[0]['mail'];
            }
            
        }
        
        if($res != null){
            $usuario_id = $res[0]['usuario_id'];
            $res = $this->realizarIngreso("
                update usuario 
                set clave='$contrasenaNueva'
                where usuario_id=$usuario_id;
            ");
            
            if($correo!=null){
                $mail = new mailEnviar();
                list($estado, $mensaje) = $mail->enviarMensaje($correo, "Cambio de contrasena", "Buenas tardes. Le informamos que su contrasena ha sido cambiada.");     
            }
            
            return $this->mensajes('success', 'Contraseña modificada con éxito');
        }else{
            return $this->mensajes('error', 'Contraseña incorrecta'); 
        }
         
    }
}
