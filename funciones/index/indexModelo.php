<?php
require_once '../conexion/php_conexion.php';

class Index extends php_conexion {

    public function get() {
        $respuesta = $this->realizarConsulta("
            SELECT c.curso_id as id,c.nombre as salon,c.jornada as horario,c.cant_alumnos as numero,
                   c.paralelo as para,c.estado_id as estado,n.nombre as nivel, c.nivel_id as nivelI 
            FROM cursos c, nivel_educacion n 
            WHERE c.nivel_id=n.nivel_id");
        return $respuesta;
    }
    
    public function iniciarSession($user, $password) {
        // eMconsole_log( $user );
        if (!empty($user) && !empty($password)) {
            $dato = $this->realizarConsulta("SELECT * FROM usuario WHERE usuario='$user' and clave='$password'");
            if ($dato != null) {
                $estado = $dato[0]['estado_id'];
                $estado = $this->realizarConsulta("SELECT nombre FROM estados WHERE estado_id = '$estado'");
                if ( $estado[0]['nombre'] == 'Activo') {
                    if ($dato[0]['clave'] == $password) {
                        $_SESSION['username'] = $dato[0]['usuario'];
                        $_SESSION['user'] = $dato[0]['usuario_id'];
                        $_SESSION['tipo_usu'] = $dato[0]['tipo'];
                        $this->mensajes("success", "inicio.php");
                    } else {
                        $this->mensajes("error", "Usuario o clave incorrecta");
                    }
                } else {
                    $this->mensajes("error", "Usuario desactivado");
                }
            } else {
                $this->mensajes("error", "Usuario o clave incorrecta");
            }
        } else {
           $this->mensajes("error", "Campos vacios");
        }
    }
}
