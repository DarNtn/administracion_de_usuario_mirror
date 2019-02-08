<?php

require_once '../conexion/conexion.php';

class Actividad extends conexion {

    public function getIdActividad($id_actividad) {
        $result = $this->realizarConsulta("SELECT * FROM actividades where id_actividad=$id_actividad;");
        return $result;
    }

    public function getEventosActividad() {
        $result = $this->realizarConsulta("SELECT * FROM actividades where id_estado = 1;");
        return $result;
    }

    public function EditActividad($id_actividad, $fecha_inicio, $fecha_fin,$descripcion,$color,$tipo, $idUser) {
        $datoID = $this->getIdActividad($id_actividad);
        if ($datoID != NULL) {
            $this->realizarUpdate("Update actividades set fecha_inicio='".$fecha_inicio."',fecha_fin='".$fecha_fin."',descripcion='".$descripcion."',color='$color',tipo_actividad='$tipo',id_user_reg=$idUser where id_actividad=$id_actividad");
            return $this->mensajes('success', "Actualización exitosa!");            
        } else {
            return $this->mensajes('error', 'Este registro no existe');
        }
    }

    public function AddActividad($fecha_inicio, $fecha_fin,$descripcion,$color,$tipo, $idUser) {
        $result=$this->realizarIngresoIndex("insert into actividades (fecha_inicio,fecha_fin,descripcion,color,id_estado,tipo_actividad,id_user_reg) values('$fecha_inicio','$fecha_fin','$descripcion','$color',1,'$tipo',$idUser)");
        if($result>0){
            return $this->mensajes('success', "Guardado con exito exitosa!");
        }else{
            return $this->mensajes('error', "Error al guadar!");
        }
    }

    public function EliminarActividad($id_actividad, $idUser) {
        $this->realizarUpdate("Update actividades set id_estado='2',id_user_reg=$idUser where id_actividad=$id_actividad");
        return $this->mensajes('success', "Se eliminado la actividad correctamente!");
    }

}
