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
           // if ($tipo==3? TRUE:($this->valideRangoDate($id_actividad, $fecha_inicio, $fecha_fin) == FALSE)) {
                $this->realizarUpdate("Update actividades set fecha_inicio='".$fecha_inicio."',fecha_fin='".$fecha_fin."',descripcion=concat('".$descripcion."',' ',MONTHNAME('".$fecha_inicio."')),color='$color',tipo_actividad='$tipo',id_user_reg=$idUser where id_actividad=$id_actividad");
                return $this->mensajes('success', "Actualización exitosa!");
            //} else {
            //    return $this->mensajes('error', 'El calendario ya tiene una actividad registrada en este rango de fecha!');
           // }
        } else {
            return $this->mensajes('error', 'Este registro no existe');
        }
    }

    public function AddActividad($fecha_inicio, $fecha_fin,$descripcion,$color,$tipo, $idUser) {
       // if ($tipo==3? TRUE:($this->valideRangoDate(0, $fecha_inicio, $fecha_fin) == FALSE)) {
            $result=$this->realizarIngresoIndex("insert into actividades (fecha_inicio,fecha_fin,descripcion,color,id_estado,tipo_actividad,id_user_reg) values('$fecha_inicio','$fecha_fin',concat('".$descripcion."',' ',MONTHNAME('$fecha_inicio')),'$color',1,'$tipo',$idUser)");
        //    return $this->mensajes('success', "Guardado con exito exitosa!");
            if($result>0){
                return $this->mensajes('success', "Guardado con exito exitosa!");
            }else{
                return $this->mensajes('error', "Error al guadar!");
            }
        //} else {
        //    return $this->mensajes('error', 'El calendario ya tiene una actividad registrada en este rango de fecha!');
        //}
    }

    public function getAllEventsActividad($fecha_inicio, $fecha_fin) {
        $sentencia = "SELECT * FROM actividades where id_estado = 1 and ((fecha_inicio BETWEEN '$fecha_inicio' AND '$fecha_fin')or(fecha_fin BETWEEN '$fecha_inicio' AND '$fecha_fin')) ;";
        $result = $this->realizarConsulta($sentencia);
        return $result;
    }

    public function valideRangoDate($id_aguaje, $fecha_inicio, $fecha_fin) {
        $fInicio = strtotime($fecha_inicio);
        $fFin = strtotime($fecha_fin);
        $result = FALSE;
        if ($id_aguaje > 0) {
            $datoVacacion = $this->getAllEventsAguajeEdit($id_aguaje, $fecha_inicio, $fecha_fin);
        } else {
            $datoVacacion = $this->getAllEventsAguaje($fecha_inicio, $fecha_fin);
        }
        for ($i = 0; $i < count($datoVacacion); $i++) {
            $fInicioEmp = strtotime($datoVacacion[$i]['fecha_inicio']);
            $fFinEmp = strtotime($datoVacacion[$i]['fecha_fin']);
            if (($fInicio >= $fInicioEmp && $fInicio <= $fFinEmp || $fFin <= $fFinEmp && $fFin >= $fInicioEmp) || $fInicio <= $fInicioEmp && $fFin >= $fFinEmp) {
                $result = TRUE;
            }
        }
        return $result;
    }

}
