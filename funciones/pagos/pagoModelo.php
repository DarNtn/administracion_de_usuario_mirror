<?php

require_once '../conexion/php_conexion.php';
require_once '../salon/salonModelo.php';

class Pago extends php_conexion {

    public function get($bus, $opcion) {
        $respuesta = $this->realizarConsulta("
            SELECT o.orden_pago_id as id,a.alumno_id,a.nombres,a.apellidos,i.nombre as institucion,s.nombre,CONCAT(pe.anio_inicio,'-',pe.anio_fin) as electivo,
            DATE_FORMAT(o.fecha_pago,'%M') as mes,o.fecha_vencimiento_pago,s.valor_servicio,i.institucion_id,
            rp.nombres as nombreR,rp.apellidos as apellidoR,rp.direccion,rp.telefono,rp.cedula,s.tipo_servicio_id ,rp.representante_id,rp.email
            FROM orden_pagos o,lista_curso lc,alumnos a,salones sa,periodo_electivo pe,servicios s,instituciones i,asignar_representante ap,
            representantes rp
            Where ap.alumno_id=a.alumno_id and ap.representante_id=rp.representante_id and o.lista_curso_id=lc.lista_curso_id 
            and lc.alumno_id=a.alumno_id and lc.salon_id=sa.salon_id and sa.periodo_id=pe.periodo_id  and ap.principal=1
            and o.servicio_id=s.servicio_id and a.instituciones_id=i.institucion_id and o.fecha_vencimiento_pago<now() and o.estado_id=1
            and if('1'='$opcion',a.nombres like '%' and ap.principal=1,if('2'='$opcion',rp.nombres like '$bus%',if('3'='$opcion',rp.cedula='$bus',if('4'='$opcion',a.nombres like '$bus%' and ap.principal=1,null))))
            ORDER BY o.fecha_vencimiento_pago,nombre");
        return $respuesta;
    }

    public function getRepresentantes($bus, $opcion) {
        if ($opcion == '1') {
            $respuesta = $this->realizarConsulta("SELECT * FROM representantes where cedula='$bus';");
        } else if ($opcion == '2') {
            $respuesta = $this->realizarConsulta("SELECT * FROM representantes where nombres like '$bus%';");
        } else {
            $respuesta = $this->realizarConsulta("SELECT * FROM representantes where apellidos like '$bus%';");
        }
        return $respuesta;
    }

    public function getRepresentados($idR) {
        $respuesta = $this->realizarConsulta("SELECT * 
            FROM alumnos a,asignar_representante ar
            WHERE a.alumno_id=ar.alumno_id and ar.representante_id='$idR';");
        return $respuesta;
    }

    public function getOrdenesRepresentado($idE) {
        $respuesta = $this->realizarConsulta("SELECT o.orden_pago_id as id,a.nombres,a.apellidos,i.nombre as institucion,s.nombre,
                CONCAT(pe.anio_inicio,'-',pe.anio_fin) as electivo,DATE_FORMAT(o.fecha_pago,'%M') as mes,o.fecha_vencimiento_pago,
                s.valor_servicio,i.institucion_id,s.tipo_servicio_id
                FROM orden_pagos o,lista_curso lc,alumnos a,salones sa,periodo_electivo pe,servicios s,instituciones i
                Where o.lista_curso_id=lc.lista_curso_id and lc.alumno_id=a.alumno_id and lc.salon_id=sa.salon_id 
                and sa.periodo_id=pe.periodo_id and o.servicio_id=s.servicio_id and a.instituciones_id=i.institucion_id and pe.estado_id=1
                and o.estado_id=1 and a.alumno_id='$idE'
                ORDER BY fecha_pago,nombre");
        return $respuesta;
    }

    public function getFacturas($nFactura) {
        $dato = $this->realizarConsulta("SELECT o.orden_pago_id as id,a.nombres,a.apellidos,i.nombre as institucion,s.nombre,CONCAT(pe.anio_inicio,'-',pe.anio_fin) as electivo,
            DATE_FORMAT(o.fecha_pago,'%M') as mes,o.fecha_vencimiento_pago,s.valor_servicio,i.institucion_id,
            rp.nombres as nombreR,rp.apellidos as apellidoR,rp.direccion,rp.telefono,rp.cedula,f.fecha_pago,s.tipo_servicio_id,f.modo_pago_id
            FROM factura f,orden_pagos o,lista_curso lc,alumnos a,salones sa,periodo_electivo pe,servicios s,instituciones i,asignar_representante ap,
            representantes rp
            Where ap.alumno_id=a.alumno_id and ap.principal=1 and ap.representante_id=rp.representante_id and f.orden_pago_id=o.orden_pago_id and o.lista_curso_id=lc.lista_curso_id 
            and lc.alumno_id=a.alumno_id and lc.salon_id=sa.salon_id and sa.periodo_id=pe.periodo_id 
            and o.servicio_id=s.servicio_id and a.instituciones_id=i.institucion_id and f.n_factura='$nFactura'
            ORDER BY o.fecha_vencimiento_pago,nombre");
        return $dato;
    }

    public function cancelarOrden($id, $nFactura, $fpago) {
        $dato = $this->realizarConsulta("SELECT * FROM factura where orden_pago_id='$id'");
        if ($dato == null) {
            $result = $this->realizarIngresoId("INSERT INTO factura (n_factura,orden_pago_id,fecha_pago,modo_pago_id) VALUES ('$nFactura','$id',CURDATE(),'$fpago');");
            return $result;
        } else {
            return 0;
        }
    }

    public function estadoOrden($nOrden, $estado) {
        if ($estado == '1') {
            $this->realizarIngreso("UPDATE orden_pagos SET estado_id=2 where orden_pago_id='$nOrden'");
        }
        if ($estado == '3') {
            $this->realizarIngreso("UPDATE orden_pagos SET estado_id=3 where orden_pago_id='$nOrden'");
        }
    }

//    public function getPeriodo($anio_inicio, $anio_fin) {
//        $respuesta = $this->realizarConsulta("
//            SELECT periodo_id, anio_inicio, anio_fin, estado_id, fecha_inicio_periodo, fecha_fin_periodo
//            FROM periodo_electivo 
//            WHERE anio_inicio='$anio_inicio' and anio_fin='$anio_fin'");
//        return $respuesta;
//    }
//    public function getId($idPeriodo) {
//        $respuesta = $this->realizarConsulta("
//            SELECT periodo_id, anio_inicio, anio_fin, estado_id, fecha_inicio_periodo, fecha_fin_periodo
//            FROM periodo_electivo
//            WHERE periodo_id='$idPeriodo'");
//        return $respuesta;
//    }
//    public function set($anio_inicio, $anio_fin, $fecha_inicio, $fecha_fin, $estado) {
//        $data = $this->getPeriodo($anio_inicio, $anio_fin);
//        if ($data == null) {
//            $resultado = $this->realizarIngresoId("INSERT INTO periodo_electivo VALUES(null,'$anio_inicio','$anio_fin',' $estado','$fecha_inicio','$fecha_fin')");
//            if ($resultado > 0) {
//                $this->historial(1, 'periodo_electivo', 'insertar', $resultado, 'registro de un período en el sistema');
//                return $this->mensajes('success', 'Registro exitoso');
//            } else {
//                return $this->mensajes('error', 'No se pudo hacer el registro');
//            }
//        } else {
//            return $this->mensajes('error', 'Registro de período existente');
//        }
//    }
//    public function editEstadoPeriodo($id, $estado) {
//        if ($estado == 2) {
//            $this->realizarIngreso("UPDATE periodo_electivo SET estado_id=2 where periodo_id='$id'");
//            $salon = new Salon();
//            $datos = $salon->realizarConsulta("SELECT * FROM salones where periodo_id='$id' and estado_id=1");
//            for ($i = 0; $i < count($datos); $i++) {
//                $salon->editEstadoSalon($datos[$i]['salon_id'], 2);
//            }
//        } else {
//            $this->realizarIngreso("UPDATE periodo_electivo SET estado_id=1 where periodo_id='$id'");
//        }
//    }
//
//    public function edit($idPeriodo, $anio_inicio, $anio_fin, $fecha_inicio, $fecha_fin) {
//        $data = $this->getId($idPeriodo);
//        if ($data != null) {
//            $resultado = $this->realizarIngreso("UPDATE periodo_electivo SET anio_inicio='$anio_inicio', anio_fin='$anio_fin', fecha_inicio_periodo='$fecha_inicio', fecha_fin_periodo='$fecha_fin' where periodo_id='$idPeriodo'");
//            if ($resultado > 0) {
//                $this->historial(1, 'periodo_electivo', 'editar', $idPeriodo, 'edicion de un período electivo en el sistema');
//                return $this->mensajes('success', 'Período editado exitosamente');
//            } else {
//                return $this->mensajes('info', 'No hay cambios presentes');
//            }
//        } else {
//            return $this->mensajes('error', 'Período con registro no existente');
//        }
//    }
}
