<?php
    /////////////////// AJUSTES INICIALES ///////////////////
    header("Cache-Control: no-cache, must-revalidate");
    setlocale(LC_TIME,"spanish");
    include_once('../../config/config.php');
    
    /////////////////// AJUSTES INICIALES ///////////////////
    
    /////////////////// SE CARGAN LIBRERIAS PARA EL PDF ///////////////////
    use setasign\Fpdi;
    require_once($root.'resources/tcpdf/tcpdf.php');
    require_once($root.'resources/fpdi/autoload.php');
    /////////////////// SE CARGAN LIBRERIAS PARA EL PDF ///////////////////
    
    /////////////////// VARIABLES INICIALES ///////////////////
    $fecha_actual = date('Y-m-d');
    $dia_actual = date('d');
    $anio_actual = date('Y');
    /////////////////// VARIABLES INICIALES ///////////////////

    ///////////////// FUNCIÓN PARA CONVERTIR FECHA EN TEXTO /////////////////
    function fechaCastellano ($fecha) 
    {
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $numeroDia." de ".$nombreMes." de ".$anio;
    }

    function fechaMes ($fecha) 
    {
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $nombreMes;
    }
    ///////////////// FUNCIÓN PARA CONVERTIR FECHA EN TEXTO /////////////////

    //////////////////// OPERACIONES ////////////////////////
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $sucursal = isset($_GET['branch']) ? $_GET['branch'] : '';
        $renta_mensual = isset($_GET['amount']) ? $_GET['amount'] : '';
    } else {
    }
    //echo $sucursal;

    $total_rentas = $renta_mensual*36;
    $proporcional_renta= $renta_mensual*21;
    
    $mantenimientos= $renta_mensual * 11.5;
    $refacciones= $renta_mensual * 7.5;
    $visitas= 3000;
    
    $total_venta = $proporcional_renta+$mantenimientos+$refacciones+$visitas;
    $diferencia = $total_venta - $total_rentas;
    
    $diff_porcentual = (($total_venta * 100) / $total_rentas) - 100;
    $diff_porcentual = round($diff_porcentual, 2);
    
    $diff_anual = $diff_porcentual / 3;
    $diff_anual = round($diff_anual, 2);

    $total_venta=round($total_venta, 2);
    $total_rentas=round($total_rentas, 2);

    $suma_diferencia = $proporcional_renta + $mantenimientos + $refacciones + $visitas;

    $diferencia_total= $total_venta - $total_rentas;
    $diferencia_venta=$total_rentas*0.0996;
    $diferencia_anual= $total_rentas*0.0332;


    $suma_diferencia=number_format($suma_diferencia, 2, '.', ',');
    $diferencia=number_format($diferencia, 2, '.', ',');
    $renta_mensual=number_format($renta_mensual, 2, '.', ',');
    $proporcional_renta=number_format($proporcional_renta, 2, '.', ',');
    $total_venta=number_format($total_venta, 2, '.', ',');
    $total_rentas=number_format($total_rentas, 2, '.', ',');

    $refacciones=number_format($refacciones, 2, '.', ',');
    $mantenimientos=number_format($mantenimientos, 2, '.', ',');
    $visitas=number_format($visitas, 2, '.', ',');



    //////////////////// OPERACIONES ////////////////////////

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
    ///////////////// SE INSTANCIA LA CLASE DEL PDF /////////////////
    //////// SE PUEDE AÑADIR ENCABEZADO Y PIE DE PAGINA AQUÍ ////////

    ///////////////// SE CREA OBJETO PDF /////////////////
    $pdf = new pdf();
    ///////////////// SE CREA OBJETO PDF /////////////////

    ////////////// SE CARGA LA PLANTILLA CON LA QUE TRABAJAREMOS //////////////

    if($sucursal == '1')
    {
        $sucursal = 1;
    }elseif($sucursal == '2'){
        $sucursal = 2;
    }else{
        $sucursal = 3;
    }
    $plantilla = $root."docs/templatesFpdi/hoja_".$sucursal.".pdf";

    $pagecount = $pdf->setSourceFile($plantilla);
    ////////////// SE CARGA LA PLANTILLA CON LA QUE TRABAJAREMOS //////////////
    
    ////////////// SE IMPORTA LA HOJA QUE SE USARÁ DE PLANTILLA //////////////
    $tpl = $pdf->importPage(1);
    ////////////// SE IMPORTA LA HOJA QUE SE USARÁ DE PLANTILLA //////////////

    /////// DESIGNAMOS EL TAMAÑO DE LA PLANTILLA DESDE LA HOJA IMPORTADA ///////
    $size = $pdf->getTemplateSize($tpl);
    /////// DESIGNAMOS EL TAMAÑO DE LA PLANTILLA DESDE LA HOJA IMPORTADA ///////
    
    ///////// AÑADIMOS UNA PÁGINA DESIGNANDO EL TAMAÑO DEL DOCUMENTO /////////
    ////////////// (LETTER = CARTA, 'P' = Portrait ~ vertical) //////////////
    $pdf->AddPage('P', 'LETTER');
    ///////// AÑADIMOS UNA PÁGINA DESIGNANDO EL TAMAÑO DEL DOCUMENTO /////////

    ////////////// CARGAMOS LA PLANTILLA EN NUESTRA NUEVA PÁGINA //////////////
    $pdf->useTemplate($tpl);
    ////////////// CARGAMOS LA PLANTILLA EN NUESTRA NUEVA PÁGINA //////////////

    // POSICIÓN DE PRIMERAS COORDENADAS (LAS COORDENADAS SE AJUSTAN A LOS MILIMETROS DE LA HOJA)
    //Limite de hoja 0-216 (ancho) primer valor 0 representa borde
    $pdf->SetY(43);
    $pdf->SetX(15);
    // SE ELIGE LA FUENTE
    $pdf->SetFont('helvetica','',10.5);
    // WRITEHTMLCELL permite crear una celda en la que podemos insertar código HTML y de esta forma hacer un texto más dinámico
    //$pdf->writeHTMLCell(W, H, 'X', 'Y', $html, border, line, fill, reseth, 'align', autopadding);
    
    /*$html = "MARGEN INICIAL (1.5cm) 4.3cm de alto";
    $pdf->writeHTMLCell(186, 5, '', '', $html, 1, 0, 0, TRUE, 'J', TRUE);*/
    
    // REAJUSTE DE COORDENADAS (DESPLAZAMIENTO ENTRE LA HOJA)
    // SE PUEDE CAMBIAR LA FUENTE, Y TAMAÑO VOLVIENDO A USAR EL COMANDO SETFONT
    $pdf->SetTextColor(0,0,0);

    ////// SECCIÓN TÍTULO //////
    $pdf->SetY(24);
    $pdf->SetX(120);
    $pdf->SetFont('helvetica','B',28);
    $pdf->Cell(80, 6, "COMPARATIVO", 0, 0, 'C');
    ////// SECCIÓN TÍTULO //////

    ////// SECCIÓN SUBTITULO (LEASING) //////
    $pdf->SetTextColor(202,93,35);
    $pdf->SetY(60);
    $pdf->SetX(100);
    // 6.5 ABAJO Y 2.5 IZQUIERDA
    $pdf->SetFont('helvetica','B',22);
    $pdf->Cell(40, 10, "LEASING", 0, 0, 'C');
    ////// SECCIÓN SUBTITULO (LEASING) //////

    ////// SECCIÓN SUBTITULO (VENTA) //////
    $pdf->SetY(60);
    $pdf->SetX(160);
    // 6.5 ABAJO Y 2.5 IZQUIERDA
    $pdf->SetFont('helvetica','B',22);
    $pdf->Cell(40, 10, "VENTA", 0, 0, 'C');
    ////// SECCIÓN SUBTITULO (VENTA) //////

    $pdf->SetTextColor(0,0,0);

    /////////////////////////////////
    ////// SECCIÓN MENSUALIDAD //////
    /////////////////////////////////

        ////// SECCIÓN MENSUALIDAD //////
        $pdf->SetY(80);
        $pdf->SetX(20);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(60, 10, "Mensualidad", 0, 0, 'C');
        ////// SECCIÓN MENSUALIDAD //////

        ////// SECCIÓN MENSUALIDAD (LEASING) //////
        $pdf->SetY(80);
        $pdf->SetX(100);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(40, 10, "$".$renta_mensual, 0, 0, 'C');
        ////// SECCIÓN MENSUALIDAD (LEASING) //////

        ////// SECCIÓN MENSUALIDAD (VENTA) //////
        $pdf->SetY(80);
        $pdf->SetX(160);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(40, 10, "N/A", 0, 0, 'C');
        ////// SECCIÓN MENSUALIDAD (VENTA) //////

    /////////////////////////////////
    ////// SECCIÓN MENSUALIDAD //////
    /////////////////////////////////

    //////////////////////////////////////////
    ////// SECCIÓN EQUIPO E INSTALACION //////
    //////////////////////////////////////////

        ////// SECCIÓN EQUIPO E INSTALACION //////
        $pdf->SetY(100);
        $pdf->SetX(20);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(60, 10, "Equipo e instalación", 0, 0, 'C');
        ////// SECCIÓN EQUIPO E INSTALACION //////

        ////// SECCIÓN EQUIPO E INSTALACION (LEASING) //////
        $pdf->SetY(100);
        $pdf->SetX(100);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(40, 10, "$".$total_rentas, 0, 0, 'C');
        ////// SECCIÓN EQUIPO E INSTALACION (LEASING) //////

        ////// SECCIÓN EQUIPO E INSTALACION (VENTA) //////
        $pdf->SetY(100);
        $pdf->SetX(160);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(40, 10, "$".$proporcional_renta, 0, 0, 'C');
        ////// SECCIÓN EQUIPO E INSTALACION (VENTA) //////

    //////////////////////////////////////////
    ////// SECCIÓN EQUIPO E INSTALACION //////
    //////////////////////////////////////////


    //////////////////////////////////////////
    ////// SECCIÓN MANTENIMIENTO (5) /////////
    //////////////////////////////////////////

        ////// SECCIÓN MANTENIMIENTO (5) //////
        $pdf->SetY(120);
        $pdf->SetX(20);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(60, 10, "Mantenimiento (5)", 0, 0, 'C');
        ////// SECCIÓN MANTENIMIENTO (5) //////

        ////// SECCIÓN MANTENIMIENTO (5) (LEASING) //////
        $pdf->SetY(120);
        $pdf->SetX(100);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(40, 10, "SIN COSTO", 0, 0, 'C');
        ////// SECCIÓN MANTENIMIENTO (5) (LEASING) //////

        ////// SECCIÓN MANTENIMIENTO (5) (VENTA) //////
        $pdf->SetY(120);
        $pdf->SetX(160);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(40, 10, "$".$mantenimientos, 0, 0, 'C');
        ////// SECCIÓN MANTENIMIENTO (5) (VENTA) //////

    //////////////////////////////////////////
    ////// SECCIÓN MANTENIMIENTO (5) /////////
    //////////////////////////////////////////


    //////////////////////////////////////////
    ////// SECCIÓN REFACCIONES ///////////////
    //////////////////////////////////////////

        ////// SECCIÓN REFACCIONES //////
        $pdf->SetY(140);
        $pdf->SetX(20);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(60, 10, "Refacciones", 0, 0, 'C');
        ////// SECCIÓN REFACCIONES //////

        ////// SECCIÓN REFACCIONES (LEASING) //////
        $pdf->SetY(140);
        $pdf->SetX(100);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(40, 10, "SIN COSTO", 0, 0, 'C');
        ////// SECCIÓN REFACCIONES (LEASING) //////

        ////// SECCIÓN REFACCIONES (VENTA) //////
        $pdf->SetY(140);
        $pdf->SetX(160);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(40, 10, "$".$refacciones, 0, 0, 'C');
        ////// SECCIÓN REFACCIONES (VENTA) //////

    //////////////////////////////////////////
    ////// SECCIÓN REFACCIONES ///////////////
    //////////////////////////////////////////


    /////////////////////////////////////////////////
    ////// SECCIÓN VISITAS DE SOPORTE ///////////////
    /////////////////////////////////////////////////

        ////// SECCIÓN VISITAS DE SOPORTE //////
        $pdf->SetY(160);
        $pdf->SetX(20);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(60, 10, "Visitas de soporte", 0, 0, 'C');
        ////// SECCIÓN VISITAS DE SOPORTE //////

        ////// SECCIÓN VISITAS DE SOPORTE (LEASING) //////
        $pdf->SetY(160);
        $pdf->SetX(100);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(40, 10, "SIN COSTO", 0, 0, 'C');
        ////// SECCIÓN VISITAS DE SOPORTE (LEASING) //////

        ////// SECCIÓN VISITAS DE SOPORTE (VENTA) //////
        $pdf->SetY(160);
        $pdf->SetX(160);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(40, 10, "$".$visitas, 0, 0, 'C');
        ////// SECCIÓN VISITAS DE SOPORTE (VENTA) //////

    /////////////////////////////////////////////////
    ////// SECCIÓN VISITAS DE SOPORTE ///////////////
    /////////////////////////////////////////////////


    /////////////////////////////////////////////////
    ////// SECCIÓN TOTAL ////////////////////////////
    /////////////////////////////////////////////////

        ////// SECCIÓN TOTAL //////
        $pdf->SetY(180);
        $pdf->SetX(20);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(60, 10, "Total", 0, 0, 'C');
        ////// SECCIÓN TOTAL //////

        $pdf->SetTextColor(202,93,35);
        ////// SECCIÓN TOTAL (LEASING) //////
        $pdf->SetY(180);
        $pdf->SetX(100);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','B',16);
        $pdf->Cell(40, 10, "$".$total_rentas, 0, 0, 'C');
        ////// SECCIÓN TOTAL (LEASING) //////

        ////// SECCIÓN TOTAL (VENTA) //////
        $pdf->SetY(180);
        $pdf->SetX(160);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','B',16);
        $pdf->Cell(40, 10, "$".$suma_diferencia, 0, 0, 'C');
        ////// SECCIÓN TOTAL (VENTA) //////

    /////////////////////////////////////////////////
    ////// SECCIÓN TOTAL ////////////////////////////
    /////////////////////////////////////////////////


    /////////////////////////////////////////////////
    ////// SECCIÓN DIFERENCIA ///////////////////////
    /////////////////////////////////////////////////

        ////// TEXTO //////
        $pdf->SetTextColor(0,0,0);
        $pdf->SetY(210);
        $pdf->SetX(20);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(60, 8, "Diferencia", 0, 0, 'C');
        ////// TEXTO //////

        ////// CANTIDAD //////
        $pdf->SetTextColor(202,93,35);
        $pdf->SetY(210);
        $pdf->SetX(100);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','B',16);
        $pdf->Cell(40, 8, "$".$diferencia, 0, 0, 'C');
        ////// CANTIDAD //////

    /////////////////////////////////////////////////
    ////// SECCIÓN DIFERENCIA ///////////////////////
    /////////////////////////////////////////////////

    /////////////////////////////////////////////////
    ////// SECCIÓN DIFERENCIA PORCENTUAL ////////////
    /////////////////////////////////////////////////

        ////// TEXTO //////
        $pdf->SetTextColor(0,0,0);
        $pdf->SetY(220);
        $pdf->SetX(20);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(60, 8, "Diferencia %", 0, 0, 'C');
        ////// TEXTO //////

        ////// CANTIDAD //////
        $pdf->SetY(220);
        $pdf->SetX(100);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(40, 8, $diff_porcentual."%", 0, 0, 'C');
        ////// CANTIDAD //////

    /////////////////////////////////////////////////
    ////// SECCIÓN DIFERENCIA PORCENTUAL ////////////
    /////////////////////////////////////////////////

    /////////////////////////////////////////////////
    ////// SECCIÓN DIFERENCIA ANUAL ////////////
    /////////////////////////////////////////////////

        ////// TEXTO //////
        $pdf->SetY(230);
        $pdf->SetX(20);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(60, 8, "Diferencia anual", 0, 0, 'C');
        ////// TEXTO //////

        ////// CANTIDAD //////
        $pdf->SetY(230);
        $pdf->SetX(100);
        // 6.5 ABAJO Y 2.5 IZQUIERDA
        $pdf->SetFont('helvetica','',16);
        $pdf->Cell(40, 8, $diff_anual."%", 0, 0, 'C');
        ////// CANTIDAD //////

    /////////////////////////////////////////////////
    ////// SECCIÓN DIFERENCIA ANUAL ////////////
    /////////////////////////////////////////////////

    ////// ADVERTENCIA //////
    $pdf->SetY(240);
    $pdf->SetX(100);
    // 6.5 ABAJO Y 2.5 IZQUIERDA
    $pdf->SetFont('helvetica','I',10);
    $pdf->Cell(100, 8, "*Comparativo proyectado a 36 meses", 0, 0, 'R');
    ////// ADVERTENCIA //////
    
    
    // ENVIA EL PDF A DESPLEGARSE EN PANTALLA
    // SE PUEDE PONER EL NOMBRE DEL ARCHIVO PARA GUARDADO
    $pdf->Output("comparativo.pdf", 'I');
    


?>