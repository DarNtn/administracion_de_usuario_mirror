<?php
ini_set('max_execution_time', 3000);
header('Content-Type: application/json');


require_once './correoconfig.php';
include_once('./conexion/php_conexion.php');

$json = file_get_contents('php://input'); //obtine el json de la pagina pagos vencidos
$obj = json_decode($json, TRUE); //convierte el json en un array
$idRepresentantes = array();
for ($i = 0; $i < count($obj); $i++) {
    $repetido = 0;

    for ($e = 0; $e < count($idRepresentantes); $e++) { //se realiza un nuevo array de hay sin repetir
        if ([$obj[$i][0], $obj[$i][1], $obj[$i][2]] == $idRepresentantes[$e]) {
            $repetido = 1;
        }
    }
    if ($repetido == 0) { //si no hay valores repetir los guarda en el array
        $idRepresentantes[] = [$obj[$i][0], $obj[$i][1], $obj[$i][2]];
    }
}
//mensajes("success", $obj[1]);
//
if (!empty($obj)) {//verifica si el json enviado no este vacio
    $exito = 0;
    $error = 0;
//    print_r(json_encode($idRepresentantes));
    $fCorreo = new Mail();
    for ($j = 0; $j < count($idRepresentantes); $j++) {
        
        $datosDeuda = busquedaPVencidos($idRepresentantes[$j][0],$idRepresentantes[$j][1]); //se realiza la busquedas de los pagos pendientes
        $lista = "";
        $totalDeuda = 0;
        for ($K = 0; $K < sizeof($datosDeuda); $K++) {//se crea una tabla con todos los pagos pendientes
            $lista = $lista . "<tr><td>" . $datosDeuda[$K]['nombre'] . "</td><td>" . $datosDeuda[$K]['valor_servicio'] .
                    "</td><td>" . $datosDeuda[$K]['fecha_vencimiento_pago'] . "</td><tr>";
            $totalDeuda = $totalDeuda + $datosDeuda[$K]['valor_servicio'];
        }
////Obtener fecha actual
        date_default_timezone_set('America/Guayaquil');
        $hoy = getdate();
        $d = $hoy['mday'];
        $m = $hoy['mon'];
        $y = $hoy['year'];

        $contenido = "Ecuador " . $d . "-" . $m . "-" . $y . "<br>"
                . "<i>Estimado Sr./Sra. " . $datosDeuda[0]['Rnombre'] . "</i><br>"
                . "<p>Mediante la presente carta queremos hacerle llegar el aviso de cobro de nuestros
                servicios que usted contrató con nosotros del estudiante ".$datosDeuda[0]['nombres']." y que aun estamos a la espera de recibir su pago.
                Le agradecemos realice el ingreso en nuestra oficina o se ponga lo antes posible en contacto
                con nuestro departamento de gestión económica.<br>
                <table style='border:1px solid #dff0d8;border-radius:5px;width:100%;text-align:center;'><tr style='background:#dff0d8'><th>Servicio</th><th>Valor</th><th>Fecha de Vencimiento</th></tr>
                " . $lista . "
                <tr style='background:#dff0d8'><th>Total</th><th>" . $totalDeuda . "</th></tr>
                </table><br>
                Un saludo afectuoso.<br>
                Atentamente<br>
                InnovaEscuela.</p>";
        
        
        
        $resultado = $fCorreo->correo($idRepresentantes[$j][2],$contenido);
        if ($resultado == 1) {
            $exito++;
            
        } else {
            $error++;
        }
        sleep(1);
    }
    echo mensajes('info','enviados: '.$exito.' no enviados: '.$error);
}