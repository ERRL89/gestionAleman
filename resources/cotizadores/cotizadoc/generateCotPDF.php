<?php

header("Cache-Control: no-cache, must-revalidate");
setlocale(LC_TIME, "spanish");
/////////////////// AJUSTES INICIALES ///////////////////

/////////////////// SE CARGAN LIBRERIAS PARA EL PDF ///////////////////
use setasign\Fpdi;

require_once('tcpdf/tcpdf.php');
require_once('fpdi/autoload.php');

///////////////// SE INSTANCIA LA CLASE DEL PDF /////////////////
//////// SE PUEDE AÑADIR ENCABEZADO Y PIE DE PAGINA AQUÍ ////////
class Pdf extends Fpdi\Tcpdf\Fpdi
{
    /**
     * "Remembers" the template id of the imported page
     */
    protected $tplId;

    /**
     * Draw an imported PDF logo on every page
     */
    function Header()
    {
        // emtpy method body
    }

    function Footer()
    {
        // emtpy method body
    }
}

///////////////// SE CREA OBJETO reciboPDF /////////////////
$reciboPDF = new pdf();

////////////// SE CARGA LA PLANTILLA CON LA QUE TRABAJAREMOS //////////////
//Hoja con 1 partida para cotizacion
if($filePDF==1){
    $pagecount = $reciboPDF->setSourceFile($root."resources/cotizadores/cotizadoc/hoja_1.pdf");
}

//Hoja con 2 partidas para cotizacion
if($filePDF==2){
    $pagecount = $reciboPDF->setSourceFile($root."resources/cotizadores/cotizadoc/hoja_2.pdf");
}

//Hoja con 3 partidas para cotizacion
if($filePDF==3){
    $pagecount = $reciboPDF->setSourceFile($root."resources/cotizadores/cotizadoc/hoja_3.pdf");
}

////////////// SE IMPORTA LA HOJA QUE SE USARÁ DE PLANTILLA //////////////
$tpl = $reciboPDF->importPage(1);

/////// DESIGNAMOS EL TAMAÑO DE LA PLANTILLA DESDE LA HOJA IMPORTADA ///////
$size = $reciboPDF->getTemplateSize($tpl);
/////// DESIGNAMOS EL TAMAÑO DE LA PLANTILLA DESDE LA HOJA IMPORTADA ///////

///////// AÑADIMOS UNA PÁGINA DESIGNANDO EL TAMAÑO DEL DOCUMENTO /////////
////////////// (LETTER = CARTA, 'P' = Portrait ~ vertical) //////////////
$reciboPDF->AddPage('P', 'A4');
///////// AÑADIMOS UNA PÁGINA DESIGNANDO EL TAMAÑO DEL DOCUMENTO /////////

////////////// CARGAMOS LA PLANTILLA EN NUESTRA NUEVA PÁGINA //////////////
$reciboPDF->useTemplate($tpl);
////////////// CARGAMOS LA PLANTILLA EN NUESTRA NUEVA PÁGINA //////////////

// FECHA
$reciboPDF->SetFont('helvetica', '', 12);
$reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
$reciboPDF->SetXY(167, 54.7); // Posición x, posición y
$reciboPDF->Cell(0, 10, $fecha, 0, 1, '');

// NOMBRE
$reciboPDF->SetFont('helvetica', '', 11);
$reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
$reciboPDF->SetXY(30.5, 66.5); // Posición x, posición y
$reciboPDF->Cell(0, 10, $nombre, 0, 1, '');

// TELEFONO
$reciboPDF->SetFont('helvetica', '', 11);
$reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
$reciboPDF->SetXY(30.5, 73.2); // Posición x, posición y
$reciboPDF->Cell(0, 10, $telefono, 0, 1, '');

// EMAIL
$reciboPDF->SetFont('helvetica', '', 11);
$reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
$reciboPDF->SetXY(25.8, 80); // Posición x, posición y
$reciboPDF->Cell(0, 10, $email, 0, 1, '');

//Si se reciben valores de 1 partida
if($filePDF==1){
    // Typer service 1
    $reciboPDF->SetFont('helvetica', '', 11);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(12.5, 128); // Posición x, posición y
    if($typeService1=="MANIOBRAS ENTARIMADAS" || $typeService1=="MANIOBRAS A GRANEL"){
        $reciboPDF->Cell(0, 10, $typeService1." - Num. personas: ".$numPersona1, 0, 1, '');
    }
    else{
        $reciboPDF->Cell(0, 10, $typeService1, 0, 1, '');
    }
    //PARTIDA DE COTIZACION 1
    // Service 1
    $reciboPDF->SetFont('helvetica', '', 11);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(12.5, 134); // Posición x, posición y
    $reciboPDF->Cell(0, 10, $service1, 0, 1, '');

    // Cantidad 1
    $reciboPDF->SetFont('helvetica', '', 13);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(143, 131); // Posición x, posición y
    $reciboPDF->Cell(0, 10, $cantidad1, 0, 1, '');

    // Costo 1
    $reciboPDF->SetFont('helvetica', '', 13);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(175, 131); // Posición x, posición y
    $reciboPDF->Cell(0, 10, "$".$costo1, 0, 1, '');

    // SUBTOTAL
    $reciboPDF->SetFont('helvetica', '', 11);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(177, 151.5); // Posición x, posición y
    $reciboPDF->Cell(0, 10, "$".$total, 0, 1, '');

    // IVA
    $iva=($total*16)/100;
    $reciboPDF->SetFont('helvetica', '', 11);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(177, 158.5); // Posición x, posición y
    $reciboPDF->Cell(0, 10, "$".$iva, 0, 1, '');

    // TOTAL FINAL
    $totalGlobal=$total+$iva;
    $reciboPDF->SetFont('helvetica', 'B', 14);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(175, 169.3); // Posición x, posición y
    $reciboPDF->Cell(0, 10, "$".$totalGlobal, 0, 1, '');
}

//Si se reciben valores de dos partidas
if($filePDF==2){
    //------------ IMPRIME PARTIDA 1 -----------------------------
    // Typer service 1
    $reciboPDF->SetFont('helvetica', '', 11);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(12.5, 118); // Posición x, posición y
    if($typeService1=="MANIOBRAS ENTARIMADAS" || $typeService1=="MANIOBRAS A GRANEL"){
        $reciboPDF->Cell(0, 10, $typeService1." - Num. personas: ".$numPersona1, 0, 1, '');
    }
    else{
        $reciboPDF->Cell(0, 10, $typeService1, 0, 1, '');
    }
    
    // Service 1
    $reciboPDF->SetFont('helvetica', '', 11);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(12.5, 124); // Posición x, posición y
    $reciboPDF->Cell(0, 10, $service1, 0, 1, '');

    // Cantidad 1
    $reciboPDF->SetFont('helvetica', '', 13);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(143, 121); // Posición x, posición y
    $reciboPDF->Cell(0, 10, $cantidad1, 0, 1, '');

    // Costo 1
    $reciboPDF->SetFont('helvetica', '', 13);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(175, 121); // Posición x, posición y
    $reciboPDF->Cell(0, 10, "$".$costo1, 0, 1, '');

    //------------ IMPRIME PARTIDA 2 -----------------------------
    // Typer service 2
    $reciboPDF->SetFont('helvetica', '', 11);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(12.5, 132.5); // Posición x, posición y
    if($typeService2=="MANIOBRAS ENTARIMADAS" || $typeService2=="MANIOBRAS A GRANEL"){
        $reciboPDF->Cell(0, 10, $typeService2." - Num. personas: ".$numPersona2, 0, 1, '');
    }
    else{
        $reciboPDF->Cell(0, 10, $typeService2, 0, 1, '');
    }
    
    // Service 2
    $reciboPDF->SetFont('helvetica', '', 11);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(12.5, 138.5); // Posición x, posición y
    $reciboPDF->Cell(0, 10, $service2, 0, 1, '');

    // Cantidad 2
    $reciboPDF->SetFont('helvetica', '', 13);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(143, 135.5); // Posición x, posición y
    $reciboPDF->Cell(0, 10, $cantidad2, 0, 1, '');

    // Costo 2
    $reciboPDF->SetFont('helvetica', '', 13);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(175, 135.5); // Posición x, posición y
    $reciboPDF->Cell(0, 10, "$".$costo2, 0, 1, '');

     // SUBTOTAL
     $reciboPDF->SetFont('helvetica', '', 11);
     $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
     $reciboPDF->SetXY(177, 155.5); // Posición x, posición y
     $reciboPDF->Cell(0, 10, "$".$total, 0, 1, '');
 
     // IVA
     $iva=($total*16)/100;
     $reciboPDF->SetFont('helvetica', '', 11);
     $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
     $reciboPDF->SetXY(177, 162.5); // Posición x, posición y
     $reciboPDF->Cell(0, 10, "$".$iva, 0, 1, '');
 
     // TOTAL FINAL
     $totalGlobal=$total+$iva;
     $reciboPDF->SetFont('helvetica', 'B', 14);
     $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
     $reciboPDF->SetXY(175, 173.5); // Posición x, posición y
     $reciboPDF->Cell(0, 10, "$".$totalGlobal, 0, 1, '');
}

//Si se reciben valores de tres partidas
if($filePDF==3){
    //------------ IMPRIME PARTIDA 1 -----------------------------
        // Type service 1
        $reciboPDF->SetFont('helvetica', '', 11);
        $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
        $reciboPDF->SetXY(12.5, 118); // Posición x, posición y
        if($typeService1=="MANIOBRAS ENTARIMADAS" || $typeService1=="MANIOBRAS A GRANEL"){
            $reciboPDF->Cell(0, 10, $typeService1." - Num. personas: ".$numPersona1, 0, 1, '');
        }
        else{
            $reciboPDF->Cell(0, 10, $typeService1, 0, 1, '');
        }
        
        // Service 1
        $reciboPDF->SetFont('helvetica', '', 11);
        $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
        $reciboPDF->SetXY(12.5, 124); // Posición x, posición y
        $reciboPDF->Cell(0, 10, $service1, 0, 1, '');

        // Cantidad 1
        $reciboPDF->SetFont('helvetica', '', 13);
        $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
        $reciboPDF->SetXY(143, 121); // Posición x, posición y
        $reciboPDF->Cell(0, 10, $cantidad1, 0, 1, '');

        // Costo 1
        $reciboPDF->SetFont('helvetica', '', 13);
        $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
        $reciboPDF->SetXY(175, 121); // Posición x, posición y
        $reciboPDF->Cell(0, 10, "$".$costo1, 0, 1, '');

    //------------ IMPRIME PARTIDA 2 -----------------------------
        // Type service 2
        $reciboPDF->SetFont('helvetica', '', 11);
        $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
        $reciboPDF->SetXY(12.5, 132.5); // Posición x, posición y
        if($typeService2=="MANIOBRAS ENTARIMADAS" || $typeService2=="MANIOBRAS A GRANEL"){
            $reciboPDF->Cell(0, 10, $typeService2." - Num. personas: ".$numPersona2, 0, 1, '');
        }
        else{
            $reciboPDF->Cell(0, 10, $typeService2, 0, 1, '');
        }
        
        // Service 2
        $reciboPDF->SetFont('helvetica', '', 11);
        $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
        $reciboPDF->SetXY(12.5, 138.5); // Posición x, posición y
        $reciboPDF->Cell(0, 10, $service2, 0, 1, '');

        // Cantidad 2
        $reciboPDF->SetFont('helvetica', '', 13);
        $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
        $reciboPDF->SetXY(143, 135.5); // Posición x, posición y
        $reciboPDF->Cell(0, 10, $cantidad2, 0, 1, '');

        // Costo 2
        $reciboPDF->SetFont('helvetica', '', 13);
        $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
        $reciboPDF->SetXY(175, 135.5); // Posición x, posición y
        $reciboPDF->Cell(0, 10, "$".$costo2, 0, 1, '');

    //------------ IMPRIME PARTIDA 3 -----------------------------
    // Type service 3
    $reciboPDF->SetFont('helvetica', '', 11);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(12.5, 148); // Posición x, posición y
    if($typeService3=="MANIOBRAS ENTARIMADAS" || $typeService3=="MANIOBRAS A GRANEL"){
        $reciboPDF->Cell(0, 10, $typeService3." - Num. personas: ".$numPersona3, 0, 1, '');
    }
    else{
        $reciboPDF->Cell(0, 10, $typeService3, 0, 1, '');
    }
    
    // Service 3
    $reciboPDF->SetFont('helvetica', '', 11);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(12.5, 153); // Posición x, posición y
    $reciboPDF->Cell(0, 10, $service3, 0, 1, '');

    // Cantidad 3
    $reciboPDF->SetFont('helvetica', '', 13);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(143, 151); // Posición x, posición y
    $reciboPDF->Cell(0, 10, $cantidad3, 0, 1, '');

    // Costo 3
    $reciboPDF->SetFont('helvetica', '', 13);
    $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
    $reciboPDF->SetXY(175, 151); // Posición x, posición y
    $reciboPDF->Cell(0, 10, "$".$costo3, 0, 1, '');

     // SUBTOTAL
     $reciboPDF->SetFont('helvetica', '', 11);
     $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
     $reciboPDF->SetXY(177, 172.5); // Posición x, posición y
     $reciboPDF->Cell(0, 10, "$".$total, 0, 1, '');
 
     // IVA
     $iva=($total*16)/100;
     $reciboPDF->SetFont('helvetica', '', 11);
     $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
     $reciboPDF->SetXY(177, 179.5); // Posición x, posición y
     $reciboPDF->Cell(0, 10, "$".$iva, 0, 1, '');
 
     // TOTAL FINAL
     $totalGlobal=$total+$iva;
     $reciboPDF->SetFont('helvetica', 'B', 14);
     $reciboPDF->SetTextColor(0, 0, 0); // Color blanco para el texto
     $reciboPDF->SetXY(175, 190.5); // Posición x, posición y
     $reciboPDF->Cell(0, 10, "$".$totalGlobal, 0, 1, '');
}

//GENERA ARCHIVO PDF
$reciboPDF->Output($root."docs/cotizaciones/".$fecha."-".$nombre.".pdf", 'F');

//Solo muestra el link cuando se envia por VER COTIZACION
if($verifyCot==1){
    echo "<a href='../../docs/cotizaciones/".$fecha.'-'.$nombre.".pdf' target='_blank'>VER COTIZACIÓN</a>";   
}

?>


