<?php

	////////////////////////////////////////////////////////////////////////////////////
	//                                                                                //
	// EN ESTA SECCIÓN SE INCLUIRÁN TODAS LAS FUNCIONES GENERALES QUE SON USADAS      //
	// POR LAS DISTINTAS ÁREAS QUE COMPONEN EL SISTEMA DE LA INTRANET.                //
	// 																	              //
	// PUEDES AÑADIR TANTAS FUNCIONES NECESITES, SIEMPRE Y CUANDO CUMPLAN LA REGLA    //
	// PRINCIPAL, LA CUAL ES QUE MÁS DE UN ÁREA NECESITE DE ESTAS FUNCIONES,          //
	// EN CASO CONTRARIO, DEBES COLOCARLA EN SU ARCHIVO "functions.php" LOCAL         //
	//                                                                                //
	////////////////////////////////////////////////////////////////////////////////////

    ///////////////// FUNCIÓN PARA VERIFICAR LA SESIÓN DEL USUARIO /////////////////
    function evaluateSession($partnerAreaId, $authorizedArea)
    {
        $folderBase = $GLOBALS['folderBase'];
        if($partnerAreaId == '')
        {
            header("location: /{$folderBase}login.php");
            die();
        }
        else if($partnerAreaId != $authorizedArea)
        {
            header("location: /{$folderBase}validateLogin.php");
            die();
        }
    }
    ///////////////// FUNCIÓN PARA VERIFICAR LA SESIÓN DEL USUARIO /////////////////

	///////////////// FUNCIÓN PARA CONVERTIR FECHA EN TEXTO /////////////////
    function dateToLabel($date, $mode = '') 
    {
        $fecha = substr($date, 0, 10);
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

        switch($mode)
        {
        	case 'minimal':
        	{
        		$label = $numeroDia."/".$nombreMes."/".$anio;
        		break;
        	}
        	case 'period':
        	{
        		$label = $nombreMes." ".$anio;
        		break;
        	}
        	case 'classic':
        	{
        		$label = $numeroDia." de ".$nombreMes." del ".$anio;
        		break;
        	}
        	case 'full':
        	{
        		$label = $nombredia." ".$numeroDia." de ".$nombreMes." del ".$anio;
        		break;
        	}
        	default:
        	{
        		$label = $numeroDia." de ".$nombreMes." del ".$anio;
        		break;
        	}
        }
        return $label;
    }
    ///////////////// FUNCIÓN PARA CONVERTIR FECHA EN TEXTO /////////////////

	///////////////// FUNCIÓN PARA ENVIAR EMAIL  /////////////////////

	#USO DE NAMESPACES NECESARIOS PARA USAR PHPMAILER
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	#

	#ESTRUCTURA DE COMO SE DEBEN DE MANDAR LOS ARGUMENTOS
	# $recipients => array(array()^n); -- Ejemplo ---> array(array('email' => 'ejemplo@acil.mx', 'name' => 'nombre_ejemplo'))

	# $sender => array(array()^n); -- (ESTE ARGUMENTO YA ESTA CONFIGURADO EN EL ARCHIVO CONF.PHP)

	# $mailSubject => string;

	# $mailPath => string;

	# $mailData => array(array()^n) -- Ejemplo ---> array(array('var_name' => 'cerrador', 'var_val' => $cerrador)) 
	# *Los var_name deben ser los nombres de las variables que necesita tu plantilla de correo*

	# $mailHost => string; -- (ESTE ARGUMENTO YA ESTA CONFIGURADO EN EL ARCHIVO CONF.PHP) 

	# $mailUser => string; -- (ESTE ARGUMENTO YA ESTA CONFIGURADO EN EL ARCHIVO CONF.PHP)

	# $mailPass => string; -- (ESTE ARGUMENTO YA ESTA CONFIGURADO EN EL ARCHIVO CONF.PHP)

	# $attachments => array(); -- Ejemplo ---> array('foto_ejemplo1.jpg', '../icons/foto_ejemplo2.png') -- (PARAMETRO OPCIONAL)

	function sendEmail($recipients, $sender, $mailSubject ,$mailPath, $mailData, $host, $user, $password, $attachments = array()){
		
		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try 
		{
			//Server settings
			$mail->isSMTP(); //Send using SMTP
			$mail->Host       = $host; //Set the SMTP server to send through
			$mail->SMTPAuth   = true; //Enable SMTP authentication
			$mail->Username   = $user; //SMTP username
			$mail->Password   = $password; //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
			$mail->Port       = 465;    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
			$mail->CharSet    = "UTF-8";
            $mail->SMTPDebug  = 0; // Desactivar debug para no mostrar detalles

            // Desactivamos la validación de correo electrónico 
            // para evitar problemas al usar direcciones no válidas
            $mail->SMTPValidateEmail = false;                  

			//Recipients (Destinatarios y remitente)
			#Remitente
			$mail->setFrom($sender['email'], $sender['name']);
			#

            // APOYO EN LO QUE SE REVISAN FUNCIONES
            $mail->addAddress('mayolo.s@acil.mx','Mayolo Suaste');

			#Destinatarios
			foreach($recipients as $recipient)
            {
                // EXTRAEMOS EL CORREO ELECTRÓNICO
				$mail->addAddress($recipient['email'], $recipient['name']);
                // EXTRAEMOS EL CORREO ELECTRÓNICO

                // VALIDAMOS EL CORREO Y SI NO ES VÁLIDO, LO SUSTITUIMOS
                if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
                {
                    $mail->addAddress('cilo@acil.mx', $recipient['name']);
                }
                // VALIDAMOS EL CORREO Y SI NO ES VÁLIDO, LO SUSTITUIMOS
			}
			#

			//Attachments (Archivos adjuntos)
			#Archivos
			if(count($attachments) > 0){
				foreach ($attachments as $attachment) {
					$mail->addAttachment($attachment);
				}
			}
			#

			//Content (Contenido)
			#Se instancian variables necesarias para el correo
			foreach($mailData as $data){
				${$data['var_name']} = $data['var_val']; 
			}
			#

			#Se añade cuerpo de correo
			require($mailPath);
			#

			//Content
			$mail->isHTML(true);  //Set email format to HTML
			$mail->Subject = $mailSubject;
			$mail->Body    = $message;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			
		} catch (Exception $e) {
			throw new Exception("Ocurrió un error al enviar correo: " . $e->getMessage());
		}

	}

	///////////////// FUNCIÓN PARA ENVIAR EMAIL  /////////////////////

	///////////////// FUNCIÓN PARA ENVIAR FACTURAS  /////////////////////
	function generateInvoice($id_payment,$tracking = true)
    {
        $db = $GLOBALS['db'];
        $root = $GLOBALS['root'];

        try
        {
            ////////// CARGAMOS LAS VARIABLES INICIALES //////////
            include $root."resources/api_folios_digitales/instancias.php";
            ////////// CARGAMOS LAS VARIABLES INICIALES //////////

            // INICIA CARGA DE HERRAMIENTA DE API
            include ($root.'resources/api_folios_digitales/config.php');
            // TERMINA CARGA DE HERRAMIENTA DE API

            ////////// INICIALIZACIÓN DE API //////////
            $client = new SoapClient($url, [ "trace" => 1 ] );
            //$wsdlFunctions = $client->__getFunctions();
            //var_dump($wsdlFunctions);
            ////////// INICIALIZACIÓN DE API //////////


            ////////// SE COMENZARÁ LA OBTENCIÓN DE DATOS DESDE LA BD //////////
            #CONSULTAMOS DATOS QUE NECESITAMOS DE LA FACTURA
            $stringQuery = "
            SELECT
            id_cobro,
            numero_cobro,
            cantidad,
            fecha,
            id_contrato,
            id_cliente,
            numero_cliente, 
            numero_contrato,
            nombre_comercial,
            sucursal,
            equipo,
            modalidad,
            rfc,
            razon_social,
            codigo_postal,
            correo_fiscal,
            regimen_fiscal,
            uso_cfdi,
            forma_pago,
            facturacion
            FROM cobros 
            JOIN contratos ON cobros.contrato = contratos.id_contrato 
            JOIN clientes ON contratos.cliente = clientes.id_cliente 
            WHERE cobros.id_cobro = ?";

            $queryInvoiceGeneralData= $db->prepare($stringQuery);
            $queryInvoiceGeneralData->execute([$id_payment]);
            $generalDataInvoice = $queryInvoiceGeneralData->fetch(PDO::FETCH_ASSOC);

            $id_cobro = $generalDataInvoice["id_cobro"];
            $numero_cobro = $generalDataInvoice["numero_cobro"];
            $cantidad = $generalDataInvoice["cantidad"];
            $fecha = $generalDataInvoice["fecha"];
            $id_contrato = $generalDataInvoice["id_contrato"];
            $id_cliente = $generalDataInvoice["id_cliente"];
            $numero_cliente = $generalDataInvoice["numero_cliente"];
            $numero_contrato = $generalDataInvoice["numero_contrato"];
            $nombre_comercial = $generalDataInvoice["nombre_comercial"];
            $sucursal = $generalDataInvoice["sucursal"];
            $equipo = $generalDataInvoice["equipo"];
            $modalidad = $generalDataInvoice["modalidad"];
            $rfc = $generalDataInvoice["rfc"];
            $razon_social = $generalDataInvoice["razon_social"];
            $codigo_postal = $generalDataInvoice["codigo_postal"];
            $correo_fiscal = $generalDataInvoice["correo_fiscal"];
            $regimen_fiscal = $generalDataInvoice["regimen_fiscal"];
            $uso_cfdi = $generalDataInvoice["uso_cfdi"];
            $forma_pago = $generalDataInvoice["forma_pago"];
            $facturacion = $generalDataInvoice["facturacion"];

            //var_dump($generalDataInvoice);

            // CONVERSIÓN DE LA CANTIDAD CORRESPONDIENTE AL COBRO A LOS FORMATOS NECESARIOS P/FACTURAR
            $cobro_s_iva = $cantidad / 1.16;
            $cobro_s_iva = round($cobro_s_iva, 2); // PROBAR PARA FUNCIÓN DE DECIMALES RECORTADOS
            $impuesto_cobro = $cobro_s_iva * 0.16;
            $impuesto_cobro = round($impuesto_cobro, 2); // PROBAR PARA FUNCIÓN DE DECIMALES RECORTADOS
            $total_cobro = $cobro_s_iva + $impuesto_cobro;
            // CONVERSIÓN DE LA CANTIDAD CORRESPONDIENTE AL COBRO A LOS FORMATOS NECESARIOS P/FACTURAR

            // LEYENDA DE PAGO
            #CONSULTAMOS LA MODALIDAD PARA OBTENER LAS MENSUALIDADES
            $stringQueryModality = "SELECT * FROM modalidades_contrato WHERE id_modalidad = ?";

            $queryModality= $db->prepare($stringQueryModality);
            $queryModality->execute([$modalidad]);
            $DataModality = $queryModality->fetch(PDO::FETCH_ASSOC);

            $id_modalidad = $DataModality["id_modalidad"];
            $nombre = $DataModality["nombre"];
            $mensualidades = $DataModality["mensualidades"];

            $mes_pago = strtoupper(dateToLabel($fecha,'period')); 
            $leyenda_pago = $leyenda_pago = "MENSUALIDAD ".$numero_cobro."/".$mensualidades." MES ". "$mes_pago";
            // LEYENDA DE PAGO

            switch($modalidad)
            {
                case 1:
                case 2:
                {
                    $clave_producto = "46171619";
                    break;
                }
                case 3:
                {
                    #CONSULTAMOS LA ASIGNACIÓN DEL CONTRATO PARA VER EL TIPO DE CONTRATO
                    $stringQueryTypes = "
                    SELECT * FROM 
                    asignaciones_tipo_contrato 
                    JOIN tipos_contrato ON asignaciones_tipo_contrato.tipo_contrato = tipos_contrato.id_tipo
                    WHERE contrato = ?";

                    $queryTypes= $db->prepare($stringQueryTypes);
                    $queryTypes->execute([$id_contrato]);
                    $DataTypes = $queryTypes->fetch(PDO::FETCH_ASSOC);

                    $id_asignacion = $DataTypes["id_asignacion"];
                    $contrato = $DataTypes["contrato"];
                    $tipo_contrato = $DataTypes["tipo_contrato"];
                    $id_tipo = $DataTypes["id_tipo"];
                    $nombre = $DataTypes["nombre"];
                    $clase = $DataTypes["clase"];

                    switch($tipo_contrato)
                    {
                        case 10:
                        {
                            $leyenda_servicio = "SERVICIOS DE SEGURIDAD EN MODALIDAD LEASING QUE INCLUYE:\n\n*MONITOREO DE ALARMA:\n-MONITOREO 24/7 DE ALARMA / NOTIFICACIONES DESDE CENTRAL DE ALARMA / AVISO DE APERTURA Y CIERRE.";

                            $equipo = $leyenda_servicio;
                            $clave_producto = "92121701";

                            break;
                        }
                        case 12:
                        {
                            $leyenda_servicio = "SERVICIOS DE SEGURIDAD EN MODALIDAD LEASING QUE INCLUYE:\n\n*MONITOREO DE CAMARAS EN OPERACION :\n-MONITOREO DE CAMARAS PARA UN BUEN SEGUIMIENTO DE PROCESOS CORPORATIVOS/EMPRESARIALES.";
                            
                            $equipo = $leyenda_servicio;
                            $clave_producto = "92121701";

                            break;
                        }
                        case 13:
                        {
                            $leyenda_servicio = "SERVICIOS DE SEGURIDAD EN MODALIDAD LEASING QUE INCLUYE:\n\n*ACIL CONTIGO:\n-APP DE GESTION DE EMERGENCIAS.";
                            $equipo = $leyenda_servicio;
                            $clave_producto = "92121701";

                            break;
                        }
                        case 14:
                        {
                            $leyenda_servicio = "SERVICIOS DE SEGURIDAD EN MODALIDAD LEASING QUE INCLUYE:\n\n*MONITOREO DE PERSONAL:\n-APP DE SUPERVISION DE PERSONAL DE SEGURIDAD. \n-QR APLICADAS A LAS ZONAS SOLICITADAS.";

                            $equipo = $leyenda_servicio;
                            $clave_producto = "92121701";
                            break;
                        }
                    }
                    break;
                }
            }

            $concepto = "$nombre_comercial\n$leyenda_pago\n\n$equipo";

            /*////////// ARMADO DE ARRAY DE PRUEBA //////////*/

            if($testMode)
            {
            	/////////////// DATOS DEL EMISOR ///////////////
	            $FactAtrAdquirente = ""; // (OPCIONAL)
	            $Nombre_Emisor = "Compuhipermegared";
	            $RegimenFiscal = "601"; // PERSONA MORAL (601)
	            /////////////// DATOS DEL EMISOR ///////////////
            }
            else
            {
            	/////////////// DATOS DEL EMISOR ///////////////
	            $FactAtrAdquirente = ""; // (OPCIONAL)
	            $Nombre_Emisor = "ACIL MEXICO"; // Compuhipermegared
	            $RegimenFiscal = "601"; // PERSONA MORAL (601)
	            /////////////// DATOS DEL EMISOR ///////////////
            }

            /////////////// DATOS DEL RECEPTOR ///////////////
            $DomicilioFiscalReceptor = "$codigo_postal";
            $Nombre_Receptor = $razon_social;
            $NumRegIDTrib = ""; // (OPCIONAL)
            $RegimenFiscalReceptor = "$regimen_fiscal"; // Persona fisica (612)
            $ResidenciaFiscal = "";
            $Rfc = $rfc;
            $UsoCFDI = "$uso_cfdi"; // Gastos en gral (G03)
            /////////////// DATOS DEL RECEPTOR ///////////////

            if($facturacion == 0 || $testMode == true || $Rfc == "XAXX010101000")
            {
                /////////////// DATOS DEL RECEPTOR ///////////////
                $DomicilioFiscalReceptor = "06470";
                $Nombre_Receptor = "$nombre_comercial";
                $NumRegIDTrib = ""; // (OPCIONAL)
                $RegimenFiscalReceptor = "616"; // Persona fisica (612)
                $ResidenciaFiscal = "";
                $Rfc = "XAXX010101000";
                $UsoCFDI = "S01"; // Gastos en gral (G03)
                /////////////// DATOS DEL RECEPTOR ///////////////
            }

            /////////////// ARREGLO CORRESPONDIENTE A LOS CONCEPTOS ///////////////
            $lista_conceptos = [];
            $Cantidad_Concepto = 1;
            $ClaveProdServ = $clave_producto;
            $ClaveUnidad = "XNA";
            $Descripcion = "$concepto";
            $Descuento = ""; // (OPCIONAL)
            $Importe_Concepto = $cobro_s_iva;
            $NoIdentificacion = ""; // (OPCIONAL)
            $ObjetoImp = "02";
            $Unidad = "Servicio";
            $ValorUnitario = $cobro_s_iva;

            // SECCIÓN DE TRASLADOS //
            $Base_Traslado = $cobro_s_iva;
            $Importe_Traslado = $impuesto_cobro;
            $Impuesto_Traslado = "002";
            $TasaOCuota_Traslado = "0.160000";
            $TipoFactor_Traslado = "Tasa";
            // SECCIÓN DE TRASLADOS //

            // SECCIÓN DE RETENCIONES //
            $Base_Retencion = "";
            $Importe_Retencion = "";
            $Impuesto_Retencion = "";
            $TasaOCuota_Retencion = "";
            $TipoFactor_Retencion = "";
            // SECCIÓN DE RETENCIONES //

            // SECCIÓN DE TRASLADOS LOCALES //
            $ImpLocalTraslado = "";
            $Importe_TLocal = "";
            $TasaRetencion_TLocal = "";
            // SECCIÓN DE TRASLADOS LOCALES //

            /*if($Rfc == "XAXX010101000" && $Nombre_Receptor == "PUBLICO EN GENERAL")
            {
                /////////////// DATOS DEL RECEPTOR ///////////////
                $DomicilioFiscalReceptor = "06470";
                $Nombre_Receptor = "PUBLICO EN GENERAL";
                $NumRegIDTrib = ""; // (OPCIONAL)
                $RegimenFiscalReceptor = "616"; // Persona fisica (612)
                $ResidenciaFiscal = "";
                $Rfc = "XAXX010101000";
                $UsoCFDI = "S01"; // Gastos en gral (G03)
                $ClaveProdServ = "01010101";
                $ClaveUnidad = "ACT";
                $Unidad = "";
                $Descripcion = "Venta";
                /////////////// DATOS DEL RECEPTOR ///////////////
            }*/

            $traslados = array('Base' => $Base_Traslado, 'Importe' => $Importe_Traslado, 'Impuesto' => "$Impuesto_Traslado", 'TasaOCuota' => $TasaOCuota_Traslado, 'TipoFactor' => "$TipoFactor_Traslado");
            $Impuestos = array('Traslados'=>array($traslados));


            // EXTRAEMOS EL FOLIO QUE VAMOS A USAR PARA LA FACTURA
            $id_folio = 5;
            switch($sucursal)
            {
                case 1:
                {
                    if($modalidad != 3)
                    {
                        $id_folio = 5;
                    }
                    else
                    {
                        $id_folio = 6;
                    }
                    break;
                }
                case 2:
                {
                    if($modalidad != 3)
                    {
                        $id_folio = 7;
                    }
                    else
                    {
                        $id_folio = 8;
                    }
                    break;
                }
                case 3:
                {
                    if($modalidad != 3)
                    {
                        $id_folio = 9;
                    }
                    else
                    {
                        $id_folio = 10;
                    }
                    break;
                }
                default:
                {
                    if($modalidad != 3)
                    {
                        $id_folio = 5;
                    }
                    else
                    {
                        $id_folio = 6;
                    }
                    break;
                }
            }

            $stringNumberInvoice = "SELECT * FROM folios WHERE id_folio = ?";

            $queryNumberInvoice= $db->prepare($stringNumberInvoice);
            $queryNumberInvoice->execute([$id_folio]);
            $DataNumberInvoice = $queryNumberInvoice->fetch(PDO::FETCH_ASSOC);

            $id_folio = $DataNumberInvoice["id_folio"];
            $serie = $DataNumberInvoice["clave"];
            $ultimo_numero = $DataNumberInvoice["numero"];

            $folio = $ultimo_numero + 1;
            $folio_txt = $serie.$folio;
            // EXTRAEMOS EL FOLIO QUE VAMOS A USAR PARA LA FACTURA

            // ACTUALIZACIÓN DE FOLIO PARA UN PRÓXIMO PAGO
            $queryUpdateNumbeInvoice = $db->prepare("UPDATE folios SET numero = ? WHERE id_folio = ?");
            $queryUpdateNumbeInvoice->execute([$folio,$id_folio]);
            // ACTUALIZACIÓN DE FOLIO PARA UN PRÓXIMO PAGO

            /////////////// ARREGLO CORRESPONDIENTE AL COMPROBANTE CFDI ///////////////
            $ClaveCFDI = "FAC";
            $CondicionesDePago = ""; // (OPCIONAL)
            $Exportacion = "01";
            $Fecha = ""; // (OPCIONAL)
            $Folio = $folio_txt;
            $FormaDePago = "99"; // (OPCIONAL)
            $LugarExpedicion = "06470";
            $MetodoDePago = "PPD";
            $Moneda = "MXN";
            $Referencia = "001";
            $SubTotal = $cobro_s_iva; // (subtotal sin IVA)
            $TipoCambio = ""; // (OPCIONAL)
            $Total = $total_cobro;
            $Confirmacion = ""; // (OPCIONAL)
            $Descuento = ""; // (OPCIONAL)
            $NoIdentificacion = "7046";

            // INFORMACIÓN PARA CFDI RELACIONADO (NOTA DE CREDITO) //
            $TipoRelacion = "";
            // INFORMACIÓN PARA CFDI RELACIONADO (NOTA DE CREDITO) //

            // CFDI RELACIONADO //
            $UUID = "";
            // CFDI RELACIONADO //

            /////////////// ARREGLO CORRESPONDIENTE AL COMPROBANTE CFDI ///////////////

            /*////////// ARMADO DE ARRAY DE PRUEBA //////////*/

            $f_concepto = array(
                'Cantidad' => $Cantidad_Concepto,
                'ClaveProdServ' => "$ClaveProdServ",
                'ClaveUnidad' => "$ClaveUnidad",
                'Descripcion' => "$Descripcion",
                'Importe' => $Importe_Concepto,
                'NoIdentificacion' => $NoIdentificacion,
                'Impuestos' => $Impuestos,
                'ObjetoImp' => "$ObjetoImp",
                'Unidad' => "$Unidad",
                'ValorUnitario' => $ValorUnitario
            );
            array_push($lista_conceptos, $f_concepto);
            /////////////// ARREGLO CORRESPONDIENTE A LOS CONCEPTOS ///////////////

            ////////// ARMADO DE SOLICITUD DE GENERACIÓN DE CFDI //////////
            $credenciales = array('Usuario'=>"$usuario_api",'Cuenta'=>"$cuenta_api",'Password'=>"$password_api");
            $emisor = array('Nombre'=>"$Nombre_Emisor",'RegimenFiscal'=>"$RegimenFiscal");
            $InformacionGlobal = array('Año'=>"$Anio",'Meses'=>"$Meses",'Periodicidad'=>"$Periodicidad");
            $Receptor = array('DomicilioFiscalReceptor'=>"$DomicilioFiscalReceptor",'Nombre'=>"$Nombre_Receptor",'RegimenFiscalReceptor'=>"$RegimenFiscalReceptor", 'Rfc'=>"$Rfc", 'UsoCFDI'=>"$UsoCFDI");
            ////////// ARMADO DE SOLICITUD DE GENERACIÓN DE CFDI //////////

            //echo "$concepto";

            $parametros = array(
            'credenciales'=>$credenciales,
            'cfdi'=>array(
                'Emisor'=>$emisor,
                'Receptor'=>$Receptor,
                'Conceptos'=>$lista_conceptos,
                'ClaveCFDI'=>"$ClaveCFDI",
                'Exportacion'=>"$Exportacion",
                'Folio'=>"$Folio",
                'FormaPago'=>"$FormaDePago",
                'LugarExpedicion'=>"$LugarExpedicion",
                'MetodoPago'=>"$MetodoDePago",
                'Moneda'=>"$Moneda",
                'Referencia'=>"$Referencia",
                'SubTotal'=>"$SubTotal",
                'Total'=>"$Total"
            ));

            // COMANDO PARA GENERAR EL CFDI POR MEDIO DE LA API

            $response = $client->GenerarCFDI40($parametros);
            $result = $response->GenerarCFDI40Result;
            if($result->ErrorDetallado != NULL)
            {
                $error_detallado = $result->ErrorDetallado;
                $error_general = $result->ErrorGeneral;
                echo $error_detallado." -- ".$error_general."<hr>";
                
                // INSERCIÓN DE DATOS DE FACTURA
                $stringQueryInsertErrorLog = "INSERT INTO logs_factura_fallida(numero_contrato,cobro,error,detalle) VALUES (?,?,?,?)";
                $QueryInsertErrorLog = $db->prepare($stringQueryInsertErrorLog);
                $QueryInsertErrorLog->execute([$numero_contrato, $id_cobro, $error_detallado, $error_general]);
                // INSERCIÓN DE DATOS DE FACTURA  

                // ACTUALIZACIÓN DEL ESTATUS DE FACTURACIÓN EN EL COBRO
                $queryUpdateInvoiceStatus = $db->prepare("UPDATE cobros SET facturado = ? WHERE id_cobro = ?");
                $queryUpdateInvoiceStatus->execute([2,$id_payment]);
                // ACTUALIZACIÓN DEL ESTATUS DE FACTURACIÓN EN EL COBRO
            }
            else
            {
                $XML_final = $result->XML; // OBTENEMOS EL XML DE LA FACTURA YA TIMBRADA
                // COMANDO PARA GENERAR EL CFDI POR MEDIO DE LA API

                // CÓDIGO PARA DECODIFICAR EL XML Y PODER EXTRAER LA UUID
                $xmlParser = xml_parser_create();
                xml_parse_into_struct($xmlParser, $XML_final, $values, $index);
                xml_parser_free($xmlParser);
                // CÓDIGO PARA DECODIFICAR EL XML Y PODER EXTRAER LA UUID

                $email = $correo_fiscal;
                
                // DESVIO DE CORREO, SOLO PARA PRUEBAS
                //$email = "mayolo_123@hotmail.com";
                // DESVIO DE CORREO, SOLO PARA PRUEBAS

                // Se coloca correo para rastrear las facturas nuevas
                if($tracking)
                {
                    $email = $email.", mayolo.s@acil.mx";
                }
                // Se coloca correo para rastrear las facturas nuevas

                // SE RECORRE EL ARREGLO RESULTANTE EN BUSCA DE LA UUID
                foreach ($values as $valor) 
                {
                    if($valor["tag"] == "TFD:TIMBREFISCALDIGITAL")
                    {
                        $atributos_timbre = $valor["attributes"];
                        $uuid_factura = $atributos_timbre["UUID"];
                        //echo "UUID DE LA FACTURA: $uuid_factura";

                        $parametros = array('credenciales'=>array('Usuario'=>"$usuario_api",'Cuenta'=>"$cuenta_api",'Password'=>"$password_api"),'uuid'=>"$uuid_factura", 'email'=>"$email",'titulo'=>"Factura de servicios", 'mensaje'=>"");
                        $response = $client->EnviarCFDI40($parametros);

                        // INSERCIÓN DE DATOS DE FACTURA
                        $stringQueryInsertInvoice = "INSERT INTO facturas(
                            folio_factura, 
                            numero_contrato, 
                            cobro, 
                            asunto, 
                            monto, 
                            uuid) VALUES (?,?,?,?,?,?)";
                        $QueryQueryInsertInvoice = $db->prepare($stringQueryInsertInvoice);
                        $QueryQueryInsertInvoice->execute([$Folio,$numero_contrato, $id_cobro, $leyenda_pago, $Total, $uuid_factura]);
                        // INSERCIÓN DE DATOS DE FACTURA
                        break;
                    }
                }
                // SE RECORRE EL ARREGLO RESULTANTE EN BUSCA DE LA UUID

                // ACTUALIZACIÓN DEL ESTATUS DE FACTURACIÓN EN EL COBRO
                $queryUpdateInvoiceStatus = $db->prepare("UPDATE cobros SET facturado = ? WHERE id_cobro = ?");
                $queryUpdateInvoiceStatus->execute([1,$id_payment]);
                // ACTUALIZACIÓN DEL ESTATUS DE FACTURACIÓN EN EL COBRO
            }

        }
        catch(Exception $e )
        {
            echo $e->getMessage();
        }
    }
    ///////////////// FUNCIÓN PARA ENVIAR FACTURAS  /////////////////////


    ///////////////// FUNCIÓN PARA EXTRAER EL EMAIL DE LOS COLABORADORES (SEGÚN SU AREA)  /////////////////////
    function getMembersArea($area)
    {
        /*
            DE MOMENTO BUSCA TODOS LOS ELEMENTOS 
            QUE TENGAN EL PUESTO REQUERIDO 
            SIN IMPORTAR LA SUCURSAL
        */
        $db = $GLOBALS['db'];

        $queryString = "
        SELECT nombre,email 
        FROM colaboradores JOIN usuarios ON colaboradores.usuario = usuarios.id_usuario
        WHERE puesto = ? AND colaboradores.estatus = 1";
        $queryMembersData = $db->prepare($queryString);
        $queryMembersData->execute([$area]);
        
        $recipients = array();
        while($dataMembers = $queryMembersData->fetch(PDO::FETCH_ASSOC))
        {
            $nombre_colaborador = $dataMembers['nombre'];
            $email_colaborador = $dataMembers['email'];

            $dataUserMail = array("email" => "{$email_colaborador}", "name" => "{$nombre_colaborador}");
            array_push($recipients, $dataUserMail);
        }

        return $recipients;
    }
    ///////////////// FUNCIÓN PARA EXTRAER EL EMAIL DE LOS COLABORADORES (SEGÚN SU AREA)  /////////////////////
?>