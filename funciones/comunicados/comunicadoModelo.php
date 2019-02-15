<?php

require_once '../conexion/php_conexion.php';

class Comunicado extends php_conexion {

    public function get() {
        $respuesta = $this->realizarConsulta("
            SELECT distinct(r.representante_id),r.email
            FROM asignar_representante ar,representantes r
            WHERE ar.representante_id=r.representante_id and ar.principal=1;");
        return $respuesta;
    }

    public function getPlantilla($idMensaje){
        $respuesta = $this->realizarConsulta("SELECT * FROM mensaje WHERE id_mensaje = '$idMensaje'");
        
        return $this->respuestaJson(array("mensaje" => $respuesta[0]));
    }
    
    public function getCursos(){
        $respuesta = $this->realizarConsulta("SELECT curso_id as id, nombre, paralelo FROM cursos WHERE estado_id=1");
        
        return $this->respuestaJson($respuesta);
    }
    
    public function getCursosProfesor($username){
        $idProf = $this->realizarConsulta("SELECT p.personal_id FROM personal p, usuario u WHERE p.usuario_id = u.usuario_id AND u.usuario = '$username'");
        $idProf = $idProf? $idProf[0]['personal_id'] : 0;
        
        $respuesta = $this->realizarConsulta("SELECT curso_id as id, nombre, paralelo FROM cursos WHERE dirigente='$idProf' AND estado_id=1");
        
        return $this->respuestaJson($respuesta);
    }
    
    public function enviarComunicado($cursosDest, $contenido, $asunto){
        
    }
}
