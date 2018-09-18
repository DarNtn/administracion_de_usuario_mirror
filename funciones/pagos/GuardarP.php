<?php
require_once('pagoModelo.php');
# Traer los datos de un usuario
$pagos = new Pago;
header('Content-Type: application/json');
//echo 'contacto';
$json = file_get_contents('php://input');
$obj = json_decode($json, TRUE);
//$metodo=$obj['metodo'];
$fPago=$obj['fpago'];
$facturasTotales=count($obj['parametros']);//numero de facuras que deben exitir
$nFactura=array();
    for($e=0;$e<$facturasTotales;$e++){
        $nFactura[]=$obj['parametros'][$e]['Nfact'];
    }
$facturasRecibidas=count(array_filter($nFactura));//numero de facturas que hay
if($facturasRecibidas==0 or $facturasRecibidas!=$facturasTotales){
    echo $pagos->mensajes("error",$facturasRecibidas.' / '.$facturasTotales);
}else{
    for($i=0;$i<$facturasTotales;$i++){
//   $nFactura[]=$obj['parametros'][$i]['Nfact'];
   $conceptosTotales=count($obj['parametros'][$i]['Concepto']);
        for($j=0;$j<$conceptosTotales;$j++){
            $idItem=$obj['parametros'][$i]['Concepto'][$j][$j];
            $estadofactura=$pagos->cancelarOrden($idItem,$nFactura[$i],$fPago);
            if($estadofactura!=0){
                $pagos->estadoOrden($idItem,'1');
            }
         }
    }
    $redireccionFactura=array_values(array_unique($nFactura));
    die($pagos->respuestaJson($redireccionFactura));
}