<?php
require '../../plugins/fpdf/fpdf.php';

$nombre_alumna = utf8_decode($_POST['nombre_alumna']);
$apellido_alumna =utf8_decode($_POST['apellido_alumna']);
$dni = $_POST['dni_alumno'];
$ciclo = trim($_POST['ciclo_primer_informe']);
//$ciclo = "SEC ";
$nombre_materia_primaria = $_POST['nombre_materia_primaria'];
$habilitacion_asistecia_tr2 = intval($_POST['habilitacion_asistecia_tr2']);
$habilitacion_asistecia_tr3 =intval($_POST['habilitacion_asistecia_tr3']);
//Primer Trimestre
$calificacion_n11_tr1 = explode(",", $_POST['calificacion_n11_tr1']);
$calificacion_n21_tr1 = explode(",", $_POST['calificacion_n21_tr1']);
$calificacion_n31_tr1 = explode(",", $_POST['calificacion_n31_tr1']);
$calificacion_n41_tr1 = explode(",", $_POST['calificacion_n41_tr1']);
// Segundo trimestre
$calificacion_n11_tr2 = explode(",", $_POST['calificacion_n11_tr2']);
$calificacion_n21_tr2 = explode(",", $_POST['calificacion_n21_tr2']);
$calificacion_n31_tr2 = explode(",", $_POST['calificacion_n31_tr2']);
$calificacion_n41_tr2 = explode(",", $_POST['calificacion_n41_tr2']);
// tercer Trimestre
$calificacion_n11_tr3 = explode(",", $_POST['calificacion_n11_tr3']);
$calificacion_n21_tr3 = explode(",", $_POST['calificacion_n21_tr3']);
$calificacion_n31_tr3 = explode(",", $_POST['calificacion_n31_tr3']);
$calificacion_n41_tr3 = explode(",", $_POST['calificacion_n41_tr3']);
//Calificacion Diciembre
$calificacion_dic = explode(",", $_POST['calificacion_dic']);
//Calificacion Febrero
$calificacion_feb = explode(",", $_POST['calificacion_feb']);
$calificacion_final = array();
$calificacion_definitiva = array();
$tr1 = 0;
$tr2 = 0;
$tr3 = 0;

$calificacion_cu1 = explode(",",$_POST['calificacion_cu1']);
$curso = $_POST['curso'];
//Concepto TR1
$observacion_tr1 = isset($_POST['observacion_tr1']) ? str_replace('null', ' ', $_POST['observacion_tr1']) : ' ';
$presen_con_tr1 =  $_POST['presen_con_tr1'];
$puntua_con_tr1 = $_POST['puntua_con_tr1'];
$habito_con_tr1 =  $_POST['habito_con_tr1'];
$compor_con_tr1 =  $_POST['compor_con_tr1'];
$adverten_obs_tr1 =  $_POST['adverten_obs_tr1'];
$trabaj_con_tr1 =  $_POST['trabaj_con_tr1'];
$partic_con_tr1 =  $_POST['partic_con_tr1'];
$compor_obs_tr1 =  $_POST['compor_obs_tr1'];
$vinculo_con_tr1 =  $_POST['vinculo_con_tr1'];
// informe pedagogico primaria 
$puntua_obs_tr1 =  $_POST['puntua_obs_tr1'];
$presen_obs_tr1 =  $_POST['presen_obs_tr1'];
// asistencia padres 
$asistp_1_tr1 = isset($_POST['asistp_1_tr1']) ? str_replace('null', ' ', $_POST['asistp_1_tr1']) : ' ';
$asistp_2_tr1 = isset($_POST['asistp_2_tr1']) ? str_replace('null', ' ', $_POST['asistp_2_tr1']) : ' ';


//Concepto TR2
$observacion_tr2 = isset($_POST['observacion_tr2']) ? str_replace('null', ' ', $_POST['observacion_tr2']) : ' ';
$presen_con_tr2 =  $_POST['presen_con_tr2'];
$puntua_con_tr2 = $_POST['puntua_con_tr2'];
$habito_con_tr2 =  $_POST['habito_con_tr2'];
$compor_con_tr2 =  $_POST['compor_con_tr2'];
$adverten_obs_tr2 =  $_POST['adverten_obs_tr2'];
$trabaj_con_tr2 =  $_POST['trabaj_con_tr2'];
$partic_con_tr2 =  $_POST['partic_con_tr2'];
$compor_obs_tr2 =  $_POST['compor_obs_tr2'];
$vinculo_con_tr2 =  $_POST['vinculo_con_tr2'];
// informe pedagogico primaria 
$puntua_obs_tr2 =  $_POST['puntua_obs_tr2'];
$presen_obs_tr2 =  $_POST['presen_obs_tr2'];
// asistencia padres 
$asistp_1_tr2 =  $_POST['asistp_1_tr2'] != null ?   $_POST['asistp_1_tr2']:'';
$asistp_2_tr2 =  $_POST['asistp_2_tr2'] != null ?   $_POST['asistp_2_tr2']:'';
//Concepto TR3
$observacion_tr3 = $_POST['observacion_tr3'] != null ?   $_POST['observacion_tr3']:'';
$presen_con_tr3 =  $_POST['presen_con_tr3'];
$puntua_con_tr3 = $_POST['puntua_con_tr3'];
$habito_con_tr3 =  $_POST['habito_con_tr3'];
$compor_con_tr3 =  $_POST['compor_con_tr3'];
$adverten_obs_tr3 =  $_POST['adverten_obs_tr3'];
$trabaj_con_tr3 =  $_POST['trabaj_con_tr3'];
$partic_con_tr3 =  $_POST['partic_con_tr3'];
$compor_obs_tr3 =  $_POST['compor_obs_tr3'];
$vinculo_con_tr3 =  $_POST['vinculo_con_tr3'];
// informe pedagogico primaria 
$puntua_obs_tr3 =  $_POST['puntua_obs_tr3'];
$presen_obs_tr3 =  $_POST['presen_obs_tr3'];
// asistencia padres 
$asistp_1_tr3 =  $_POST['asistp_1_tr3'] != null ?   $_POST['asistp_1_tr3']:'';
$asistp_2_tr3 =  $_POST['asistp_2_tr3'] != null ?  $_POST['asistp_2_tr3']:'';

$asistp_3 =  $_POST['asistp_3'];
//Asistencia
$pre_tr1 = $_POST['pre_tr1'] != null ?  $_POST['pre_tr1']:0 ;
$pre_tr2 = $_POST['pre_tr2'] != null ?  $_POST['pre_tr2']:0 ;
//$pre_tr2 = '0.0' ;// cambio termporal corregir
$pre_tr3 = $_POST['pre_tr3'] != null ?  $_POST['pre_tr3']:0 ;
$pre_tot = $_POST['pre_tot'] != null ?  $_POST['pre_tot']:0 ;
//$pre_tot = '0.0';
$jus_tr1 = $_POST['jus_tr1'] != null ?  $_POST['jus_tr1']:0 ;
$jus_tr2 = $_POST['jus_tr2'] != null ?  $_POST['jus_tr2']:0 ;
//$jus_tr2 = '0.0';
$jus_tr3 = $_POST['jus_tr3'] != null ?  $_POST['jus_tr3']:0 ;
$injus_tr1 = $_POST['injus_tr1'] != null ?  $_POST['injus_tr1']:0 ;
$injus_tr2 = $_POST['injus_tr2'] != null ?  $_POST['injus_tr2']:0 ;
//$injus_tr2 = '0.0';
$injus_tr3 = $_POST['injus_tr3'] != null ?  $_POST['injus_tr3']:0 ;
$lti_tr1 = $_POST['lti_tr1'] != null ?  $_POST['lti_tr1']:0 ;
$lti_tr2 = $_POST['lti_tr2'] != null ?  $_POST['lti_tr2']:0 ;
//$lti_tr2 = '0.0'; //cambio temporal corregir
$lti_tr3 = $_POST['lti_tr3'] != null ?  $_POST['lti_tr3']:0 ;
$lti = $_POST['lti'] != null ?  $_POST['lti']:0 ;
//$lti = '0.0'; // cambio temporal corregir

if($_POST['inasistencias'] != null){
	if($_POST['inasistencias'] == .000){
		$inasistencias = 0;
	}else{
		$inasistencias = $_POST['inasistencias'];
	}
}else{
	$inasistencias = 0;
}
if($_POST['inasistencias_just'] != null){
	$inasistencias_just = $_POST['inasistencias_just'];
}else{
	$inasistencias_just = 0;
}
if($_POST['inasistencias_injust'] != null){
	$inasistencias_injust = $_POST['inasistencias_injust'];
}else{
	$inasistencias_injust = 0;
}
$division = $_POST['division'];
$anio = $_POST['anio_periodo'];
$nota =0;
$nota_dic = 0;
$nota_feb = 0;
if ($ciclo == "PRI") {
    for ($i = 0; $i < count($nombre_materia_primaria); $i++) {
       if (isset($calificacion_n11_tr3[$i]) || $calificacion_n11_tr3[$i] != null || $calificacion_n11_tr3[$i] != ''){
        $tr1 = floatval(trim($calificacion_n11_tr1[$i]));
        $tr2 = floatval(trim($calificacion_n11_tr2[$i]));
        $tr3 = floatval(trim($calificacion_n11_tr3[$i]));
        $nota = floatval(($tr1 + $tr2 + $tr3) / 3);
        array_push($calificacion_final,$nota);

        if($tr3 < 6 || $nota < 6){
            if ($calificacion_dic[$i] != null) {
                $nota_dic = floatval(trim($calificacion_dic[$i]));
                if ($nota_dic >= 6) {
                    array_push($calificacion_definitiva,$nota_dic);
                }else if ($calificacion_feb[$i] != null) {
                    $nota_feb = floatval(trim($calificacion_feb[$i]));
                    if ($nota_feb >= 6) {
                        array_push($calificacion_definitiva,$nota_feb);
                    }
                }else{
                    array_push($calificacion_definitiva,'');
                }
            }else{
                array_push($calificacion_definitiva,'');
            }
        }else {
            array_push($calificacion_definitiva,$nota);
        }
       }
    }
}
if ($ciclo == "SEC") {

    for ($i = 0; $i < count($nombre_materia_primaria); $i++) {
        $calificacion_n11_tr1[$i] =trim( $calificacion_n11_tr1[$i]);
        $calificacion_n11_tr2[$i] =trim( $calificacion_n11_tr2[$i]);
        $calificacion_n11_tr3[$i] =trim( $calificacion_n11_tr3[$i]);
        if (isset($calificacion_n11_tr3[$i]) || $calificacion_n11_tr3[$i] != null 
          || $calificacion_n11_tr3[$i] != ''){

            if($calificacion_n11_tr1[$i] == 'NC' || $calificacion_n11_tr2[$i] == 'NC' 
                || $calificacion_n11_tr3[$i] == 'NC'){

                if ($calificacion_n11_tr1[$i] == 'NC' and $calificacion_n11_tr2[$i] != 'NC' 
                    and $calificacion_n11_tr3[$i] != 'NC') {

                    $tr2 = (isset($calificacion_n21_tr2[$i]) and $calificacion_n21_tr2[$i] != null 
                    and $calificacion_n21_tr2[$i] != '' )? floatval(trim($calificacion_n21_tr2[$i])):floatval(trim($calificacion_n11_tr2[$i]));
                    
                    $tr3 = (isset($calificacion_n21_tr3[$i]) and $calificacion_n21_tr3[$i] != null 
                    and $calificacion_n21_tr3[$i] != '' )? floatval(trim($calificacion_n21_tr3[$i])):floatval(trim($calificacion_n11_tr3[$i]));

                    $nota = floatval(( $tr2 + $tr3) / 2);
                    array_push($calificacion_final,$nota);
                    array_push($calificacion_definitiva,$nota);
                } else if($calificacion_n11_tr1[$i] != 'NC' and $calificacion_n11_tr2[$i] == 'NC'
                        and $calificacion_n11_tr3[$i] == 'NC') {

                            $tr1 = (isset($calificacion_n21_tr1[$i]) and $calificacion_n21_tr1[$i] != null 
                            and $calificacion_n21_tr1[$i] != '' )? floatval(trim($calificacion_n21_tr1[$i])):floatval(trim($calificacion_n11_tr1[$i]));
                            array_push($calificacion_final,$tr1);
        
                            if ($tr1 >= 6) {
                                array_push($calificacion_definitiva,$tr1);
                            } else if ($calificacion_dic[$i] != null) {
                                $nota_dic = floatval(trim($calificacion_dic[$i]));
                                if ($nota_dic >= 6) {
                                    array_push($calificacion_definitiva,$nota_dic);
                                }else if ($calificacion_feb[$i] != null) {
                                    $nota_feb = floatval(trim($calificacion_feb[$i]));
                                    if ($nota_feb >= 6) {
                                        array_push($calificacion_definitiva,$nota_feb);
                                    }else{
                                        array_push($calificacion_definitiva,'');
                                    }
                                }else{
                                    array_push($calificacion_definitiva,'');
                                }
                            }else{
                                array_push($calificacion_definitiva,'');
                            }

                    array_push($calificacion_final,$calificacion_n11_tr1[$i]);
                    array_push($calificacion_definitiva,$calificacion_n11_tr1[$i]);
                } else if($calificacion_n11_tr1[$i] == 'NC' and $calificacion_n11_tr2[$i] == 'NC'
                         and $calificacion_n11_tr3[$i] != 'NC') {

                    $tr3 = (isset($calificacion_n21_tr3[$i]) and $calificacion_n21_tr3[$i] != null 
                    and $calificacion_n21_tr3[$i] != '' )? floatval(trim($calificacion_n21_tr3[$i])):floatval(trim($calificacion_n11_tr3[$i]));
                    array_push($calificacion_final,$tr3);

                    if ($tr3 >= 6) {
                        array_push($calificacion_definitiva,$tr3);
                    } else if ($calificacion_dic[$i] != null) {
                        $nota_dic = floatval(trim($calificacion_dic[$i]));
                        if ($nota_dic >= 6) {
                            array_push($calificacion_definitiva,$nota_dic);
                        }else if ($calificacion_feb[$i] != null) {
                            $nota_feb = floatval(trim($calificacion_feb[$i]));
                            if ($nota_feb >= 6) {
                                array_push($calificacion_definitiva,$nota_feb);
                            }else{
                                array_push($calificacion_definitiva,'');
                            }
                        }else{
                            array_push($calificacion_definitiva,'');
                        }
                    }else{
                        array_push($calificacion_definitiva,'');
                    }

                    
                }else if($calificacion_n11_tr1[$i] == 'NC' and $calificacion_n11_tr2[$i] != 'NC'
                        and $calificacion_n11_tr3[$i] == 'NC') {
                    $tr2 = (isset($calificacion_n21_tr2[$i]) and $calificacion_n21_tr2[$i] != null 
                    and $calificacion_n21_tr2[$i] != '' )? floatval(trim($calificacion_n21_tr2[$i])):floatval(trim($calificacion_n11_tr2[$i]));
                    array_push($calificacion_final,$tr2);
                    if ($tr2 >= 6) {
                        array_push($calificacion_definitiva,$tr2);
                    } else if ($calificacion_dic[$i] != null) {
                        $nota_dic = floatval(trim($calificacion_dic[$i]));
                        if ($nota_dic >= 6) {
                            array_push($calificacion_definitiva,$nota_dic);
                        }else if ($calificacion_feb[$i] != null) {
                            $nota_feb = floatval(trim($calificacion_feb[$i]));
                            if ($nota_feb >= 6) {
                                array_push($calificacion_definitiva,$nota_feb);
                            }else{
                                array_push($calificacion_definitiva,'');
                            }
                        }else{
                            array_push($calificacion_definitiva,'');
                        }
                    }else{
                        array_push($calificacion_definitiva,'');
                    }
                    
                }else if($calificacion_n11_tr1[$i] == 'NC' and $calificacion_n11_tr2[$i] == 'NC'
                        and $calificacion_n11_tr3[$i] == 'NC') {
                            if ($calificacion_dic[$i] != null) {
                                $nota_dic = floatval(trim($calificacion_dic[$i]));
                                if ($nota_dic >= 6) {
                                    array_push($calificacion_definitiva,$nota_dic);
                                }else if ($calificacion_feb[$i] != null) {
                                    $nota_feb = floatval(trim($calificacion_feb[$i]));
                                    if ($nota_feb >= 6) {
                                        array_push($calificacion_definitiva,$nota_feb);
                                    }else{
                                        array_push($calificacion_definitiva,'');
                                    }
                                }else{
                                    array_push($calificacion_definitiva,'');
                                }
                            }else{
                                array_push($calificacion_definitiva,'');
                            }
                            array_push($calificacion_final,$calificacion_n11_tr3[$i]);
                    
                }

            }else if($calificacion_n11_tr3[$i] == 'EX' || $calificacion_n11_tr3[$i] == 'MB' 
            || $calificacion_n11_tr3[$i] == 'B'){
                array_push($calificacion_final,$calificacion_n11_tr3[$i]);
                array_push($calificacion_definitiva,$calificacion_n11_tr3[$i]);
            }else{
                $tr1 = (isset($calificacion_n21_tr1[$i]) and $calificacion_n21_tr1[$i] != null 
                and $calificacion_n21_tr1[$i] != '') ? floatval(trim($calificacion_n21_tr1[$i])):floatval(trim($calificacion_n11_tr1[$i]));
                
                $tr2 = (isset($calificacion_n21_tr2[$i]) and $calificacion_n21_tr2[$i] != null 
                and $calificacion_n21_tr2[$i] != '' )? floatval(trim($calificacion_n21_tr2[$i])):floatval(trim($calificacion_n11_tr2[$i]));
                
                $tr3 = (isset($calificacion_n21_tr3[$i]) and $calificacion_n21_tr3[$i] != null 
                and $calificacion_n21_tr3[$i] != '' )? floatval(trim($calificacion_n21_tr3[$i])):floatval(trim($calificacion_n11_tr3[$i]));
                
                $nota = floatval(($tr1 + $tr2 + $tr3) / 3);
                array_push($calificacion_final,$nota);

                if($tr3 < 6 || $nota < 6){
                    if ($calificacion_dic[$i] != null) {
                        $nota_dic = floatval(trim($calificacion_dic[$i]));
                        if ($nota_dic >= 6) {
                            array_push($calificacion_definitiva,$nota_dic);
                        }else if ($calificacion_feb[$i] != null) {
                            $nota_feb = floatval(trim($calificacion_feb[$i]));
                            if ($nota_feb >= 6) {
                                array_push($calificacion_definitiva,$nota_feb);
                            }else{
                                array_push($calificacion_definitiva,'');
                            }
                        }else{
                            array_push($calificacion_definitiva,'');
                        }
                    }else{
                        array_push($calificacion_definitiva,'');
                    }
                }else {
                    array_push($calificacion_definitiva,$nota);
                }
            }        
        }
    }
}
//die(print_r($calificacion_dic));
//$calificacion_anual = explode(",", $calificacion_final);
//die(print_r($calificacion_anual));
class PDF extends FPDF
{

    var $widths;
    var $aligns;

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths=$w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns=$a;
    }

    function Row($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=5*$nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this->MultiCell($w,5,$data[$i],0,$a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w,$txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../../../images/sistema/logo_notas.jpg', 6, 8, 200);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        //$this->Cell(30,10,'Title',1,0,'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function LoadData($file)
    {
        // Leer las líneas del fichero
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }

    function Titulo($title)
    {
        $w = $this->GetStringWidth($title)+6;
        $this->SetX((210-$w)/2);
        $this->SetDrawColor(0,80,180);
        $this->SetFillColor(230,230,0);
        //$this->SetTextColor(220,50,50);
        // Ancho del borde (1 mm)
        //$this->SetLineWidth(1);
        // Título
        $this->Cell($w,9,utf8_decode($title),1,1,'C',true);
    }


}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);

if ($ciclo == "SEC") {
    $mat1 = "vacio";
    $a = 0;
    $pdf->Cell(0, 0,'" '.utf8_decode('Con la mirada atenta, compasivos y cercanos en el caminar.').' "', 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->Cell(0, 0, 'INFORME DE TRAYECTORIA ESCOLAR', 0, 1, 'C');
    $pdf->Ln(5);
    $pdf->Cell(0, 0, utf8_decode('Ciclo Lectivo ').$anio, 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->Cell(0, 0, 'Nombre y Apellido del alumno/a: ' . $nombre_alumna . ' ' . $apellido_alumna, 0, 1);
    $pdf->Ln(10);
    $pdf->Cell(0, 0, utf8_decode('Curso y división: ' ). $curso . utf8_decode('° ') . $division, 0, 1);
    $pdf->Ln(10);
    $pdf->SetFont('', '', 9);
    $pdf->SetX(10);
    $pdf->Cell(60, 8, 'ESPACIOS CURRICULARES', 1, 0,'C', 0);
    $pdf->Cell(30, 8, utf8_decode('1°T'), 1, 0,'C', 0);
    $pdf->Cell(30, 8, utf8_decode('2°T'), 1, 0,'C', 0);
    $pdf->Cell(30, 8, utf8_decode('3°T'), 1, 1,'C', 0);
    $pdf->Cell(60, 8, '', 1, 0,'C', 0);
    //Primer trimestre
    $pdf->Cell(10, 8, utf8_decode('Calif.'), 1, 0,'C', 0);
    $pdf->Cell(10, 8, utf8_decode('Rec.'), 1, 0,'C', 0);
    $pdf->Cell(10, 8, utf8_decode('Inas.'), 1, 0,'C', 0);
    //Segundo
    $pdf->Cell(10, 8, utf8_decode('Calif.'), 1, 0,'C', 0);
    $pdf->Cell(10, 8, utf8_decode('Rec.'), 1, 0,'C', 0);
    $pdf->Cell(10, 8, utf8_decode('Inas.'), 1, 0,'C', 0);
    //Tercero
    $pdf->Cell(10, 8, utf8_decode('Calif.'), 1, 0,'C', 0);
    $pdf->Cell(10, 8, utf8_decode('Rec.'), 1, 0,'C', 0);
    $pdf->Cell(10, 8, utf8_decode('Inas.'), 0, 0,'C', 0);
    
    $pdf->Cell(15, 8, utf8_decode('Cal.final'), 1, 0,'C', 0);
    $pdf->Cell(10, 8, utf8_decode('Dic.'), 1, 0,'C', 0);
    $pdf->Cell(10, 8, utf8_decode('Feb'), 1, 0,'C', 0);
    $pdf->Cell(10, 8, utf8_decode('C.D'), 1, 1,'C', 0);
    
    $pdf->SetFont('', '', 10);
    for ($i = 0; $i < count($nombre_materia_primaria); $i++) {
            $nombre_materia = $nombre_materia_primaria[$i];
            if (strlen($nombre_materia) > 40) {
                $nombre_materia = substr($nombre_materia, 0, 37) . '...';
            }
            $pdf->Cell(60, 8, utf8_decode($nombre_materia), 1, 0, 'L', 0);
            $pdf->SetX(-15);
            if($calificacion_definitiva[$i] === null || $calificacion_definitiva[$i] == ''){
                $pdf->Cell(10, 8, '-',1, 0,'C', 0);//C.D
            }else {
                if(is_string($calificacion_definitiva[$i])){
                    $pdf->Cell(10, 8, strtoupper($calificacion_definitiva[$i]) ,1, 0,'C', 0);//C.D
                }else{
                    $pdf->Cell(10, 8, number_format($calificacion_definitiva[$i],2) ,1, 0,'C', 0);//C.D
                }
            }
            $pdf->SetX(-25);
            if($calificacion_feb[$i] === null || $calificacion_feb[$i] == ''){
                $pdf->Cell(10, 8, '-',1, 0,'C', 0);//FEB
            }else{
                $pdf->Cell(10, 8, ' '.strtoupper($calificacion_feb[$i]),1, 0,'C', 0);//FEB
            }
            $pdf->SetX(-35);
            if($calificacion_dic[$i] === null || $calificacion_dic[$i] == ''){
                $pdf->Cell(10, 8, '-',1, 0,'C', 0);//DIC
            }else{
                $pdf->Cell(10, 8, ' '.strtoupper($calificacion_dic[$i]),1, 0,'C', 0);//DIC
            }
            $pdf->SetX(-50);
            if (isset($calificacion_n11_tr3[$i]) || $calificacion_n11_tr3[$i] != null || $calificacion_n11_tr3[$i] != ''){
                if(is_string($calificacion_final[$i])){
                    //$pdf->Cell(15, 8, strtoupper($calificacion_final[$i]) ,1, 0,'C', 0);//Calificacion Final
                    $pdf->Cell(15, 8, '-',1, 0,'C', 0);
                }else{
                    $pdf->Cell(15, 8, number_format($calificacion_final[$i],2) ,1, 0,'C', 0);//Calificacion Final
                    //$pdf->Cell(15, 8, '-',1, 0,'C', 0);
                }
                
            }else{
                $pdf->Cell(15, 8, '-',1, 0,'C', 0);
            }
            $pdf->SetX(-80);
            $pdf->Cell(10, 8, '' .strtoupper($calificacion_n11_tr3[$i]),1, 0,'C', 0);// Calif.
            $pdf->Cell(10, 8, '' .strtoupper($calificacion_n21_tr3[$i]),1, 0,'C', 0);//Rec
            $pdf->Cell(10, 8, '' .strtoupper($calificacion_n41_tr3[$i]),1, 0,'C', 0);//Asis
            $pdf->SetX(-110);
            $pdf->Cell(10, 8, '' .strtoupper($calificacion_n11_tr2[$i]),1, 0,'C', 0);
            $pdf->Cell(10, 8, '' .strtoupper($calificacion_n21_tr2[$i]),1, 0,'C', 0);
            $pdf->Cell(10, 8, '' .strtoupper($calificacion_n41_tr2[$i]),1, 0,'C', 0);
            $pdf->SetX(-140);
            $pdf->Cell(10, 8, ''.strtoupper($calificacion_n11_tr1[$i]),1, 0,'C', 0);
            $pdf->Cell(10, 8, ''.strtoupper($calificacion_n21_tr1[$i]),1, 0,'C', 0);
            $pdf->Cell(10, 8, ''.strtoupper($calificacion_n41_tr1[$i]),1, 0,'C', 0);
            
            $pdf->Ln(7);
    }         
    $pdf->Ln(10);
    $pdf->Cell(0, 0, 'Escala Cuantitativa: 1-2-3-4-5 (DESAPROBADO)  6-7-8-9-10 (APROBADO)', 0, 1);
    $pdf->Ln(10);
    $pdf->Cell(100, 8, utf8_decode('DESEMPEÑO SOCIAL'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('1°T'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('2°T'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('3°T'), 1, 1,'C', 0);
    $pdf->Cell(100, 8, utf8_decode('Comportamiento'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$compor_con_tr1,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$compor_con_tr2,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$compor_con_tr3,1, 1,'C', 0);
    $pdf->Cell(100, 8, utf8_decode('Presentación'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$presen_con_tr1,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$presen_con_tr2,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$presen_con_tr3,1, 1,'C', 0);
    $pdf->SetWidths(array(100,20,20,20));
    $pdf->Row(array(utf8_decode('Apercibimiento y acción reparadora por falta leve.'),$compor_obs_tr1,$compor_obs_tr2,$compor_obs_tr3));
    $pdf->Cell(100, 8, utf8_decode('Actividad de servicio comunitario por falta grave.'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$puntua_obs_tr1,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$puntua_obs_tr2,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$puntua_obs_tr3,1, 1,'C', 0);
    $pdf->SetWidths(array(100,20,20,20));
    $pdf->Row(array(utf8_decode('Días de suspensión por falta grave.'),$presen_obs_tr1,$presen_obs_tr2,$presen_obs_tr3));
    $pdf->Cell(100, 8, utf8_decode('Cambio de escuela por falta muy grave.'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$habito_con_tr1,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$habito_con_tr2,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$habito_con_tr3,1, 1,'C', 0);
    $pdf->Ln(10);
    $pdf->Cell(0, 0, 'Escala Cualitativa: Excelente (EX) - Muy bueno (MB) - Bueno (B) - Regular (R)', 0, 1);
    //Asistencia
    $pdf->Ln(15);
    $pdf->Cell(30, 8, 'ASISTENCIA', 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('1°T'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('2°T'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('3°T'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('Total'), 1, 1,'C', 0);
    $pdf->Cell(30, 8, 'Asistencia', 1, 0,'C', 0);
    $pdf->SetX(-170);//1°t
    $pdf->Cell(20, 8, '' . number_format($pre_tr1,1), 1, 0,'C', 0);
    $pdf->SetX(-150);//2°t
    $pdf->Cell(20, 8, '' . $retVal = ($habilitacion_asistecia_tr2) ? number_format($pre_tr2,1) : '0.0' , 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . number_format($pre_tr2,1), 1, 0,'C', 0);
    $pdf->SetX(-130);//3°t
    $pdf->Cell(20, 8, '' . $retVal = ($habilitacion_asistecia_tr3) ? number_format($pre_tr3,1) : '0.0' , 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . number_format($pre_tr3,1), 1, 0,'C', 0);
    $pdf->SetX(-110);//total
    $pdf->Cell(20, 8, '' . number_format($pre_tot,1), 1, 1,'C', 0);//total
    $pdf->Cell(30, 8, 'Inasist. Just.', 1, 0,'C', 0);
    $pdf->SetX(-170);//1°t
    $pdf->Cell(20, 8, '' . number_format($jus_tr1,1), 1, 0,'C', 0);
    $pdf->SetX(-150);//2°t
    $pdf->Cell(20, 8, '' . $retVal = ($habilitacion_asistecia_tr2) ? number_format($jus_tr2,1) : '0.0' , 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . number_format($jus_tr2,1), 1, 0,'C', 0);
    $pdf->SetX(-130);//3°t
    $pdf->Cell(20, 8, '' . $retVal = ($habilitacion_asistecia_tr3) ? number_format($jus_tr3,1) : '0.0' , 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . number_format($jus_tr3,1), 1, 0,'C', 0);
    $pdf->SetX(-110);
    $pdf->Cell(20, 8, '' . number_format($inasistencias_just,1), 1, 1,'C', 0);
    $pdf->Cell(30, 8, 'Inasist. Injust.', 1, 0,'C', 0);
    $pdf->SetX(-170);//1°t
    $pdf->Cell(20, 8, '' . number_format($injus_tr1,1), 1, 0,'C', 0);
    $pdf->SetX(-150);//2°t
    $pdf->Cell(20, 8, '' . $retVal = ($habilitacion_asistecia_tr2) ? number_format($injus_tr2,1) : '0.0' , 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . number_format($injus_tr2,1), 1, 0,'C', 0);
    $pdf->SetX(-130);//3°t
    $pdf->Cell(20, 8, '' . $retVal = ($habilitacion_asistecia_tr3) ? number_format($injus_tr3,1) : '0.0' , 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . number_format($injus_tr3,1), 1, 0,'C', 0);
    $pdf->SetX(-110);
    $pdf->Cell(20, 8, '' . number_format($inasistencias_injust,1), 1, 1,'C', 0);
    $pdf->Cell(30, 8, 'Llegadas tarde', 1, 0,'C', 0);
    $pdf->SetX(-170);//1°t
    $pdf->Cell(20, 8, '' . number_format($lti_tr1,1), 1, 0,'C', 0);
    $pdf->SetX(-150);//2°t
    $pdf->Cell(20, 8, '' . $retVal = ($habilitacion_asistecia_tr2) ? number_format($lti_tr2,1) : '0.0' , 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . number_format($lti_tr2,1), 1, 0,'C', 0);
    $pdf->SetX(-130);//3°t
    $pdf->Cell(20, 8, '' . $retVal = ($habilitacion_asistecia_tr3) ? number_format($lti_tr3,1) : '0.0' , 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . number_format($lti_tr3,1), 1, 0,'C', 0);
    $pdf->SetX(-110);
    $pdf->Cell(20, 8, '' . number_format($lti,1), 1, 1,'C', 0);
    $pdf->Ln(10);
    //Referido a Padres
    $pdf->SetFont('Times', '', 12);
    $pdf->Ln(10);
    $pdf->Cell(160, 8, utf8_decode('Referido a Familias'), 1, 1,'C', 0);
    $pdf->Cell(40, 8, utf8_decode(''), 1, 0,'C', 0);
    $pdf->Cell(40, 8, utf8_decode('1°T'), 1, 0,'C', 0);
    $pdf->Cell(40, 8, utf8_decode('2°T'), 1, 0,'C', 0);
    $pdf->Cell(40, 8, utf8_decode('3°T'), 1, 1,'C', 0);
    $pdf->SetWidths(array(40,40,40,40));
    $pdf->Row(array(utf8_decode('Reunión de padres'),utf8_decode($asistp_1_tr1),utf8_decode($asistp_1_tr2),utf8_decode($asistp_1_tr3)));
    $pdf->Row(array('',utf8_decode($asistp_2_tr1),utf8_decode($asistp_2_tr2),utf8_decode($asistp_2_tr3)));
    $pdf->Ln(10);
   
   $pdf->Cell(150, 8, utf8_decode('Observaciones'), 1, 1,'C', 0);
   $pdf->Cell(50, 8, utf8_decode('1°T'), 1, 0,'C', 0);
   $pdf->Cell(50, 8, utf8_decode('2°T'), 1, 0,'C', 0);
   $pdf->Cell(50, 8, utf8_decode('3°T'), 1, 1,'C', 0);
   $pdf->SetWidths(array(50,50,50));//1°T,2°T,3°T
   $pdf->Row(array(utf8_decode($observacion_tr1),utf8_decode($observacion_tr2),utf8_decode($observacion_tr3)));
   $pdf->SetFont('Times', '', 12);
   $pdf->Ln(70);
   $pdf->Cell(0, 0, 'CONSEJO DE NIVEL', 0, 1, 'C');       


} else if ($ciclo == "PRI") {
    $pdf->Cell(0, 0,'" '.utf8_decode('Con la mirada atenta, compasivos y cercanos en el caminar.').' "', 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->Cell(0, 0, 'INFORME DE TRAYECTORIA ESCOLAR', 0, 1, 'C');
    $pdf->Ln(5);
    $pdf->Cell(0, 0, utf8_decode('Ciclo Lectivo ').$anio, 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->Cell(0, 0, 'Apellido y nombre del alumno/a: ' . $apellido_alumna . ', ' . $nombre_alumna, 0, 1);
    $pdf->Ln(10);
    $pdf->Cell(0, 0, 'DNI: ' .$dni, 0, 1);
    $pdf->Ln(10);
    $pdf->Cell(0, 0, 'Grado: ' . utf8_decode($curso.'°'), 0, 1);
    $pdf->Ln(10);
    $pdf->Cell(0, 0, utf8_decode('División: ') . $division, 0, 1);
    $pdf->Ln(10);
    $pdf->SetFont('', '', 9);
    $pdf->SetX(10);
    $pdf->Cell(60, 8, 'ESPACIOS CURRICULARES', 1, 0,'C', 0);
    $pdf->Cell(20, 8,utf8_decode( 'Diag'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('1°T'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('2°T'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('3°T'), 1, 0,'C', 0);
    $pdf->Cell(15, 8, utf8_decode('Cal.final'), 1, 0,'C', 0);
    $pdf->Cell(10, 8, utf8_decode('Dic.'), 1, 0,'C', 0);
    $pdf->Cell(10, 8, utf8_decode('Feb'), 1, 0,'C', 0);
    $pdf->Cell(10, 8, utf8_decode('C.D'), 1, 1,'C', 0);
    $pdf->SetFont('', '', 10);
    for ($i = 0; $i < count($nombre_materia_primaria); $i++) {
        $nombre_materia = $nombre_materia_primaria[$i];
        if (strlen($nombre_materia) > 40) {
            $nombre_materia = substr($nombre_materia, 0, 37) . '...';
        }
        $pdf->Cell(60, 8, utf8_decode($nombre_materia), 1, 0, 'L', 0);
        $pdf->SetX(-25);
        if($calificacion_definitiva[$i] === null || $calificacion_definitiva[$i] == ''){
            $pdf->Cell(10, 8, '-',1, 0,'C', 0);//C.D
        }else{
            $pdf->Cell(10, 8, ' '.number_format($calificacion_definitiva[$i],2),1, 0,'C', 0);//C.D
        }
        $pdf->SetX(-35);
        if($calificacion_feb[$i] === null || $calificacion_feb[$i] == ' '){
            $pdf->Cell(10, 8, '-',1, 0,'C', 0);//feb
        }else{
            $pdf->Cell(10, 8, ' '.strtoupper($calificacion_feb[$i]),1, 0,'C', 0);//Feb
        }
        $pdf->SetX(-45);
        if($calificacion_dic[$i] === null || $calificacion_dic[$i] == ' '){
            $pdf->Cell(10, 8, '-',1, 0,'C', 0);//Dic
        }else{
            $pdf->Cell(10, 8, ' '.strtoupper($calificacion_dic[$i]),1, 0,'C', 0);//Dic
        }
        $pdf->SetX(-60);
        if ( $calificacion_n11_tr3[$i] != null || $calificacion_n11_tr3[$i] != ''){
            $pdf->Cell(15, 8, number_format($calificacion_final[$i],2) ,1, 0,'C', 0);//Calificacion Final
            //$pdf->Cell(15, 8, '-',1, 0,'C', 0);
        }else{
            $pdf->Cell(15, 8, '-',1, 0,'C', 0);
        }
        $pdf->SetX(-80);
        $pdf->Cell(20, 8, ''.strtoupper($calificacion_n11_tr3[$i]),1, 0,'C', 0);//nota
        $pdf->SetX(-100);
        $pdf->Cell(20, 8, ''.strtoupper($calificacion_n11_tr2[$i]),1, 0,'C', 0);
        $pdf->SetX(-120);
        $pdf->Cell(20, 8, ''.strtoupper($calificacion_n11_tr1[$i]),1, 0,'C', 0);
        $pdf->SetX(-140);
        $pdf->Cell(20, 8, '-',1, 0,'C', 0);//diagnostico
        $pdf->Ln(7);
        //}
    }
     
    $pdf->Ln(10);
    $pdf->Cell(0, 0, 'Escala Cuantitativa: 1-2-3-4-5 (DESAPROBADO)  6-7-8-9-10 (APROBADO)', 0, 1);
    $pdf->Ln(10);
    $pdf->Cell(100, 8, utf8_decode('DESEMPEÑO SOCIAL'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('1°T'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('2°T'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('3°T'), 1, 1,'C', 0);
    $pdf->Cell(100, 8, utf8_decode('Manifiesta interés y sostiene sus compromisos escolares.'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$presen_con_tr1,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$presen_con_tr2,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$presen_con_tr3,1, 1,'C', 0);
    $pdf->Cell(100, 8, utf8_decode('Participa con responsabilidad y compromiso en los proyectos.'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$puntua_con_tr1,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$puntua_con_tr2,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$puntua_con_tr3,1, 1,'C', 0);
    $pdf->SetWidths(array(100,20,20,20));
    $pdf->Row(array(utf8_decode('Manifiesta actitudes de colaboracion y fraternidad aceptando la diversidad'),$habito_con_tr1,$habito_con_tr2,$habito_con_tr3));
    $pdf->Cell(100, 8, utf8_decode('Ejercita el dialogo como medio para resolver conflictos.'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$compor_con_tr1,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$compor_con_tr2,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$compor_con_tr3,1, 1,'C', 0);
    $pdf->SetWidths(array(100,20,20,20));
    $pdf->Row(array(utf8_decode('Cuida de si mismo, de los otros, de sus pertenencias y de los recursos edilicios'),$trabaj_con_tr1,$trabaj_con_tr2,$trabaj_con_tr3));
    $pdf->Cell(100, 8, utf8_decode('Reconoce y respeta el valor de los símbolos patrios'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$partic_con_tr1,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$partic_con_tr2,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$partic_con_tr3,1, 1,'C', 0);
    $pdf->Cell(100, 8, utf8_decode('Respeta los acuerdos escolares de convivencia'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$compor_obs_tr1,1, 0,'C', 0);
    $pdf->Cell(20, 8, ''.$compor_obs_tr2,1, 0,'C', 0);
    $pdf->Cell(20, 8, $compor_obs_tr3,1, 1,'C', 0);
    $pdf->Ln(5);
    $pdf->Cell(0, 0, 'Escala Cualitativa: Excelente (EX) - Muy bueno (MB) - Bueno (B) - Regular (R)', 0, 1);
    //Informe pedagogico
    $pdf->SetFont('Times', '', 12);
    $pdf->Ln(40);
    $pdf->Cell(195, 8, utf8_decode('INFORME PEDAGÓGICO'), 1, 1,'C', 0);
    $pdf->Cell(65, 8, utf8_decode('1°T'), 1, 0,'C', 0);
    $pdf->Cell(65, 8, utf8_decode('2°T'), 1, 0,'C', 0);
    $pdf->Cell(65, 8, utf8_decode('3°T'), 1, 1,'C', 0);
    $pdf->SetWidths(array(65,65,65));//1°T,2°T,3°T
    $pdf->Row(array(utf8_decode($puntua_obs_tr1),utf8_decode($puntua_obs_tr2),utf8_decode($puntua_obs_tr3)));
    //Asistencia
    $pdf->Ln(5);
    $pdf->Cell(30, 8, 'ASISTENCIA.', 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('1°T'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('2°T'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('3°T'), 1, 0,'C', 0);
    $pdf->Cell(20, 8, utf8_decode('Total'), 1, 1,'C', 0);
    $pdf->Cell(30, 8, 'Asistencia', 1, 0,'C', 0);
    $pdf->SetX(-170);//1°t
    $pdf->Cell(20, 8, '' . number_format($pre_tr1,1), 1, 0,'C', 0);
    $pdf->SetX(-150);//2°t
    $pdf->Cell(20, 8, '' . $retVal = ($habilitacion_asistecia_tr2) ? number_format($pre_tr2,1) : '0.0' , 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . number_format($pre_tr2,1), 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . '0.0', 1, 0,'C', 0);
    $pdf->SetX(-130);//3°t
    $pdf->Cell(20, 8, '' . $retVal = ($habilitacion_asistecia_tr3) ? number_format($pre_tr3,1) : '0.0' , 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . number_format($pre_tr3,1), 1, 0,'C', 0);
    $pdf->SetX(-110);//total
    $pdf->Cell(20, 8, '' . number_format($pre_tot,1), 1, 1,'C', 0);//total
    $pdf->Cell(30, 8, 'Inasist. Just.', 1, 0,'C', 0);
    $pdf->SetX(-170);//1°t
    $pdf->Cell(20, 8, '' . number_format($jus_tr1,1), 1, 0,'C', 0);
    $pdf->SetX(-150);//2°t
    $pdf->Cell(20, 8, '' . $retVal = ($habilitacion_asistecia_tr2) ? number_format($jus_tr2,1) : '0.0' , 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . number_format($jus_tr2,1), 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . '0.0', 1, 0,'C', 0);
    $pdf->SetX(-130);//3°t
    //$pdf->Cell(20, 8, '' . number_format($jus_tr3,1), 1, 0,'C', 0);
    $pdf->Cell(20, 8, '' . $retVal = ($habilitacion_asistecia_tr3) ? number_format($jus_tr3,1) : '0.0' , 1, 0,'C', 0);
    $pdf->SetX(-110);
    $pdf->Cell(20, 8, '' . number_format($inasistencias_just,1), 1, 1,'C', 0);
    $pdf->Cell(30, 8, 'Inasist. Injust.', 1, 0,'C', 0);
    $pdf->SetX(-170);//1°t
    $pdf->Cell(20, 8, '' . number_format($injus_tr1,1), 1, 0,'C', 0);
    $pdf->SetX(-150);//2°t
    $pdf->Cell(20, 8, '' . $retVal = ($habilitacion_asistecia_tr2) ? number_format($injus_tr2,1) : '0.0' , 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . number_format($injus_tr2,1), 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . '0.0', 1, 0,'C', 0);
    $pdf->SetX(-130);//3°t
    $pdf->Cell(20, 8, '' . $retVal = ($habilitacion_asistecia_tr3) ? number_format($injus_tr3,1) : '0.0' , 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . number_format($injus_tr3,1), 1, 0,'C', 0);
    $pdf->SetX(-110);
    $pdf->Cell(20, 8, '' . number_format($inasistencias_injust,1), 1, 1,'C', 0);
    $pdf->Cell(30, 8, 'Llegadas tarde', 1, 0,'C', 0);
    $pdf->SetX(-170);//1°t
    $pdf->Cell(20, 8, '' . number_format($lti_tr1,1), 1, 0,'C', 0);
    $pdf->SetX(-150);//2°t
    $pdf->Cell(20, 8, '' . $retVal = ($habilitacion_asistecia_tr2) ? number_format($lti_tr2,1) : '0.0' , 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . number_format($lti_tr2,1), 1, 0,'C', 0);
    $pdf->SetX(-130);//3°t
    $pdf->Cell(20, 8, '' . $retVal = ($habilitacion_asistecia_tr3) ? number_format($lti_tr3,1) : '0.0' , 1, 0,'C', 0);
    //$pdf->Cell(20, 8, '' . number_format($lti_tr3,1), 1, 0,'C', 0);
    $pdf->SetX(-110);
    $pdf->Cell(20, 8, '' . number_format($lti,1), 1, 1,'C', 0);
     //Referido a Padres
     $pdf->SetFont('Times', '', 12);
     $pdf->Ln(5);
     $pdf->Cell(160, 8, utf8_decode('Referido a Familias'), 1, 1,'C', 0);
     $pdf->Cell(40, 8, utf8_decode(''), 1, 0,'C', 0);
     $pdf->Cell(40, 8, utf8_decode('1°T'), 1, 0,'C', 0);
     $pdf->Cell(40, 8, utf8_decode('2°T'), 1, 0,'C', 0);
     $pdf->Cell(40, 8, utf8_decode('3°T'), 1, 1,'C', 0);
     $pdf->SetWidths(array(40,40,40,40));
     $pdf->Row(array(utf8_decode('Reunión de padres'),utf8_decode($asistp_1_tr1),utf8_decode($asistp_1_tr2),utf8_decode($asistp_1_tr3)));
     $pdf->Row(array('',utf8_decode($asistp_2_tr1),utf8_decode($asistp_2_tr2),utf8_decode($asistp_2_tr3)));

     $pdf->Ln(5);
    
    $pdf->Cell(150, 8, utf8_decode('Observaciones'), 1, 1,'C', 0);
    $pdf->Cell(50, 8, utf8_decode('1°T'), 1, 0,'C', 0);
    $pdf->Cell(50, 8, utf8_decode('2°T'), 1, 0,'C', 0);
    $pdf->Cell(50, 8, utf8_decode('3°T'), 1, 1,'C', 0);
    $pdf->SetWidths(array(50,50,50));//1°T,2°T,3°T
    $pdf->Row(array(utf8_decode($observacion_tr1),utf8_decode($observacion_tr2),utf8_decode($observacion_tr3)));

    $pdf->SetFont('Times', '', 12);
    $pdf->Ln(25);
    //$pdf->SetY(-25);
    //$pdf->Image('../../../images/sistema/firma.jpg', 6, 8, 50);
    $pdf->Cell(0, 0, 'CONSEJO DE NIVEL', 0, 1, 'C');       

}
$pdf->Output();