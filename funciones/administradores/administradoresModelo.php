<?php
require_once '../conexion/php_conexion.php';
require_once('../mail/mail.php');
class Usuario extends php_conexion {

    public function get() {
        $respuesta = $this->realizarConsulta("
        SELECT u.clave as clave, u.usuario_id as usuario_id, u.usuario as usuario, u.estado_id as estado_id, a.admin_id as admin_id, a.nombre as nombre, a.apellido as apellido, a.correo as correo, a.foto as foto, a.cedula as cedula from usuario AS u inner join administrador AS a ON a.usuarios_usuario_id = u.usuario_id");
        return $respuesta;
    }
    // select u.clave as clave, u.usuario_id as usuario_id, u.usuario, a.admin_id as admin_id, a.nombre as nombre, a.apellido as apellido, a.correo as correo, a.foto as foto, a.cedula as cedula from usuario as u inner join administrador as a on a.usuarios_usuario_id = u.usuario_id where u.usuario_id = 38;
    // usuario: clave, estado_id, usuario. administrador: nombre, apellido, correo, foto, cedula

    public function getCedula ($cedula) {
        $respuesta = $this->realizarConsulta("
            SELECT usuario_id
            FROM administrador 
            WHERE cedula='$cedula'");
        return $respuesta;
    }

    public function getId ($idUsuario) {
        $respuesta = $this->realizarConsulta("
        SELECT u.clave as clave, u.usuario_id as usuario_id, u.usuario as usuario, u.estado_id as estado_id, a.admin_id as admin_id, a.nombre as nombre, a.apellido as apellido, a.correo as correo, a.foto as foto, a.cedula as cedula from usuario AS u inner join administrador AS a ON a.usuarios_usuario_id = u.usuario_id 
        WHERE usuario_id='$idUsuario'");
        return $respuesta;
    }

    public function set ($usuario, $clave, $estado_id, $nombre, $apellido, $correo, $cedula, $foto) {
        $tipo = 'a'; // esto estara por default, ya que en la db esta todavia
        $cedulaYaExiste = $this->getCedula($cedula); // FIX

        if (!$cedulaYaExiste) {
            $usuarioId = $this->realizarIngresoId("INSERT INTO usuario VALUES('$usuario', '$clave', '$tipo', null, '$estado_id')");
            
            if ($usuarioId > 0) {
              $fueadminCreado = $this->realizarIngresoId("INSERT INTO administrador (nombre, apellido, correo, foto, cedula, usuarios_usuario_id) VALUES('$nombre', '$apellido', '$correo', 1010, '$cedula', $usuarioId)");
              if ($fueadminCreado > 0) {
                //$this->historial(1, 'usuarios', 'insertar', $usuarioId, 'registro de un usuario en el sistema');
                //$mail = new mailEnviar();
                //list($estado, $mensaje) = $mail->enviar($correo, $usuario, $clave); // TODO: validar cuando no envie el correo y hacer rollback cuando no se guarde el usuario
                return $this->mensajes('success', 'Registro exitoso');
              }
            } else {
                return $this->mensajes('error', 'No se pudo hacer el registro');
            }
        } else {
            return $this->mensajes('error', 'Registro con numero de cédula existente');
        }
    }

    public function edit ($usuario, $clave, $estado_id, $nombre, $apellido, $correo, $cedula, $usuario_id, $admin_id) {
        $data = $this->getId($usuario_id);
        if ($data != null) {
            $resultado = $this->realizarIngreso("UPDATE usuario SET estado_id='$estado_id', usuario='$usuario', clave='$clave', tipo='a' where usuario_id='$usuario_id'");
            // $this->realizarIngreso("UPDATE usuarios SET cedula='$cedula', estado_id='$estado_id', nombre='$nombre', usuario='$usuario', clave='$clave', tipo='$tipo' where usuario_id='$idUsuario'");
            if ($resultado > 0) {
                $this->historial(1, 'usuarios', 'editar', $usuario_id, 'edición de un usuario en el sistema');
                return $this->mensajes('success', 'Usuario editado exitosamente');
            } else {
                return $this->mensajes('info', 'No hay cambios presentes');
            }
        } else {
            return $this->mensajes('error', 'Usuario con registro no existente');
        }
    }
    
    function cambiarEstado($usuarioId, $estadoId){
        
        if ($estadoId == "1") {
            return $this->realizarIngreso("UPDATE usuario SET estado_id=2 where usuario_id='$usuarioId'");
        } elseif ($estadoId == "2") {
            return $this->realizarIngreso("UPDATE usuario SET estado_id=1 where usuario_id='$usuarioId'");
        }
        
    }

}
