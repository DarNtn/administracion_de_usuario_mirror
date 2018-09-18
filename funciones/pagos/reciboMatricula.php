<?php

require_once('../../Plugins/TCPDF-master/tcpdf.php');
require_once('../../Plugins/TCPDF-master/config/tcpdf_config.php');
require_once('pagoModelo.php');
# Traer los datos de un usuario
$pagos = new Pago;
   
//		if(empty($_SESSION['tipo_usu'])){
//                    header('location:inicio_1.php');
//                }

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Innova');
$pdf->SetTitle('Innova Example 001');
$pdf->SetSubject('Innova Tutorial');
$pdf->SetKeywords('Innova, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
//$pdf->setFooterData(array(0,64,0), array(0,64,128));
$pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255) ); 

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 11, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
if(empty($_GET['alumno'])){
    die();
}
$pagosV=$pagos->getFacturas($_GET['alumno']);
if($pagosV==null){
    echo 'Estos valores fueron cancelado en otra factura, verifique datos';
    die();
}
$headertable='<br><br><table><tr style="height: 30px"><td colspan="2" style="height: 30px"></td><td colspan="19"><h4>'.$pagosV[0]['nombreR'].' '.$pagosV[0]['apellidoR'].'</h4></td></tr>
    <tr style="height: 25px"><td colspan="2" style="height: 25px"></td><td colspan="15"><h4>'.$pagosV[0]['direccion'].'</h4></td><td colspan="8"><h4>'.$pagosV[0]['telefono'].'</h4></td></tr>
        <tr style="height: 53px"><td colspan="2" style="height: 53px"></td><td colspan="15"><h4>'.$pagosV[0]['fecha_pago'].'</h4></td><td colspan="8"><h4>'.$pagosV[0]['cedula'].'</h4></td></tr></table>
<table><tbody>';
$bodytabla='';
$espacios=5;$espaciosMatricula=0;$espacioPension=0;$espacioOtros=0;
 $total=0;
   for ($i = 0; $i < sizeof($pagosV); $i++){
       if($pagosV[$i]['tipo_servicio_id']==1){
     $bodytabla=$bodytabla.'<tr style="height: 35px">
      <td colspan="2" style="text-align: center;height: 35px">1</td>
      <td colspan="13"><center>'.$pagosV[$i]['nombre'].' '.$pagosV[$i]['electivo'].'</center></td>
      <td colspan="2" style="text-align: rigth;">'.$pagosV[$i]['valor_servicio'].'</td>
      <td colspan="2" style="text-align: rigth;">'.$pagosV[$i]['valor_servicio'].'</td>
     </tr>';
			$total+=$pagosV[$i]['valor_servicio'];
                        $espaciosMatricula++;
       }
    }
    $mes=0;
    $cadenames='Pensión de: ';
    $valormeses=0;
    for ($j = 0; $j < sizeof($pagosV); $j++){
       if($pagosV[$j]['tipo_servicio_id']==2){
           if($mes>0){
              $cadenames=$cadenames.', '; 
           }
            $cadenames=$cadenames.$pagosV[$j]['mes'];
            $valormeses+=$pagosV[$j]['valor_servicio'];
            $mes++;
       }
    }
       if($mes>0){
     $bodytabla=$bodytabla.'<tr style="height: 35px">
      <td colspan="2" style="text-align: center;height: 35px">'.$mes.'</td>
      <td colspan="13"><center>'.$cadenames.'</center></td>
      <td colspan="2" style="text-align: rigth;">'.$valormeses/$mes.'</td>
      <td colspan="2" style="text-align: rigth;">'.$valormeses.'</td>
     </tr>';
			$total+=$valormeses;
            $espacioPension++;
       }
       
    $mesServicio=0;
    $cadenamesServicio='Servicio Complemantarios de: ';
    $valormesesServicio=0;
    for ($h = 0; $h < sizeof($pagosV); $h++){
       if($pagosV[$h]['tipo_servicio_id']==3){
           if($mesServicio>0){
              $cadenamesServicio=$cadenamesServicio.', '; 
           }
            $cadenamesServicio=$cadenamesServicio.$pagosV[$h]['mes'];
            $valormesesServicio+=$pagosV[$h]['valor_servicio'];
            $mesServicio++;
            
       }
    }
       if($mesServicio>0){
     $bodytabla=$bodytabla.'<tr style="height: 35px">
      <td colspan="2" style="text-align: center;height: 35px">'.$mesServicio.'</td>
      <td colspan="13"><center>'.$cadenamesServicio.'</center></td>
      <td colspan="2" style="text-align: rigth;">'.$valormesesServicio/$mesServicio.'</td>
      <td colspan="2" style="text-align: rigth;">'.$valormesesServicio.'</td>
     </tr>';
			$total+=$valormesesServicio;
                        $espacioPension++;
       }
//    for ($i = 0; $i < sizeof($pagosV); $i++){
//       if($pagosV[$i]['tipo_servicio_id']!=1 && $pagosV[$i]['tipo_servicio_id']!=2 && $pagosV[$i]['tipo_servicio_id']!=3){
//     $bodytabla=$bodytabla.'<tr style="height: 35px">
//      <td colspan="2" style="height: 35px;text-align: center;">1</td>
//      <td colspan="13"><center>'.$pagosV[$i]['nombre'].' '.$pagosV[$i]['electivo'].'</center></td>
//      <td colspan="2" style="text-align: rigth;">'.$pagosV[$i]['valor_servicio'].'</td>
//      <td colspan="2" style="text-align: rigth;">'.$pagosV[$i]['valor_servicio'].'</td>
//     </tr>';
//			$total+=$pagosV[$i]['valor_servicio'];
//                        $espacioOtros++;
//       }
//    }
    $contadorEspacios=$espaciosMatricula+$espacioPension+$espacioOtros;
    for ($contadorEspacios;$contadorEspacios < $espacios;$contadorEspacios++){
     $bodytabla=$bodytabla.'<tr style="height: 35px">
      <td colspan="2" style="height: 35px"></td>
      <td colspan="13"></td>
      <td colspan="2"></td>
      <td colspan="2"></td>
     </tr>';
    }
    $foodertable='</tbody></table>';
    
require_once("convertNumberToLetter.php");
$obj=new convertNumberToLetter;
$result=$obj->to_word($total);
$efectivo='';$dElectronico='';$tarjeta='';$otros='';
if($pagosV[0]['modo_pago_id']==1){
    $efectivo='x';
}else
if($pagosV[0]['modo_pago_id']==4){
    $dElectronico='x';
}else
if($pagosV[0]['modo_pago_id']==2){
    $tarjeta='x';
}else{
    $otros='x';
}
$subtable = '<table><tr style="height: 20px"><td></td><td style="text-align: rigth;line-height:28px;">'.$efectivo.'</td><td></td></tr><tr><td></td><td style="text-align: rigth">'.$dElectronico.'</td><td></td></tr><tr><td></td><td style="text-align: rigth">'.$tarjeta.'</td><td></td></tr><tr><td></td><td style="text-align: rigth">'.$otros.'</td><td></td></tr></table>';
$footer='<table><tr><td colspan="16"></td></tr><tr><td rowspan="4" colspan="4">'.$subtable.'</td><td rowspan="4" colspan="10" style="text-align: top;">'.$result.'</td><td></td><td style="text-align: rigth;">'.$total.'</td></tr>'
        . '<tr><td></td><td style="text-align: rigth;">0</td></tr><tr><td></td><td style="text-align: rigth;line-height:25px;">0</td></tr><tr><td></td><td style="text-align: rigth;line-height:25px;">'.$total.'</td></tr></table>';
// Set some content to print
$html = $headertable.$bodytabla.$foodertable.$footer;

// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------
$pdf->IncludeJS('print(true);');
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
