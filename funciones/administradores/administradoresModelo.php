<?php
require_once '../conexion/php_conexion.php';
require_once('../mail/mail.php');
class Usuario extends php_conexion {

    public function get() {
        $respuesta = $this->realizarConsulta("
            SELECT usuario_id, usuario, clave, tipo, estado_id
            FROM usuario");
        return $respuesta;
    }

    public function getCedula($cedula) {
        $respuesta = $this->realizarConsulta("
            SELECT usuario_id, cedula, nombre, usuario, clave, tipo, estado
            FROM usuarios 
            WHERE cedula='$cedula'");
        return $respuesta;
    }

    public function getId($idUsuario) {
        $respuesta = $this->realizarConsulta("
            SELECT usuario_id, cedula, nombre, usuario, clave, tipo, estado
            FROM usuarios 
            WHERE usuario_id='$idUsuario'");
        return $respuesta;
    }

    public function set($cedula, $estado_id, $nombre, $usuario, $correo, $clave, $apellido) {
        $tipo = 'a';
        // $data = $this->getCedula($cedula);
        $data = null;
        if ($data == null) {
            $resultado = $this->realizarIngresoId("INSERT INTO usuario VALUES('$usuario', '$clave', '$tipo', null, '$estado_id')");
            if ($resultado > 0) {
                $this->historial(1, 'usuarios', 'insertar', $resultado, 'registro de un usuario en el sistema');
                $mail = new mailEnviar();
                $mail->enviar($correo, $usuario, $clave);
                // 'kdamaris@uruarurqup5ri9s28ki.tk'
                return $this->mensajes('success', 'Registro exitoso');
            } else {
                return $this->mensajes('error', 'No se pudo hacer el registro');
            }
        } else {
            return $this->mensajes('error', 'Registro con numero de cédula existente');
        }
    }

    public function edit($idUsuario, $cedula, $estado_id, $nombre, $usuario, $clave, $tipo) {
        $data = $this->getId($idUsuario);
        if ($data != null) {
            $resultado = $this->realizarIngreso("UPDATE usuarios SET cedula='$cedula', estado_id='$estado_id',nombre='$nombre', usuario='$usuario', clave='$clave', tipo='$tipo' where usuario_id='$idUsuario'");
            if ($resultado > 0) {
                $this->historial(1, 'usuarios', 'editar', $idUsuario, 'edición de un usuario en el sistema');
                return $this->mensajes('success', 'Usuario editado exitosamente');
            } else {
                return $this->mensajes('info', 'No hay cambios presentes');
            }
        } else {
            return $this->mensajes('error', 'Usuario con registro no existente');
        }
    }

}
