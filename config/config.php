<?php
	
	$folderBase = 'plataforma/';
    $theme = 'acil';
	$root = $_SERVER['DOCUMENT_ROOT'].'/'.$folderBase;
	
	// INFORMACIÓN PARA TEST //
    #BASE DE DATOS
    $host = 'localhost';
    $dbname = 'ovit_soluciones';
    $userDB = 'root';
    $passDB = '';
    #

    #DATOS PARA PHPMAIL
    $mailHost = 'smtp.hostinger.com';
    $mailUser = 'ventas@maniobrasylogistica.com';
    $mailPass = 'Erxl5063701489*';
    $mailSender = array('email' => 'ventas@maniobrasylogistica.com', 'name' => 'Aleman Maniobras');
    #
    // INFORMACIÓN PARA TEST //

    /*// INFORMACIÓN PARA PRODUCTIVO //
    #BASE DE DATOS
    $host = 'localhost';
    $dbname = 'acilsegu_intranet';
    $userDB = 'acilsegu_acil';
    $passDB = 'AcilOnTime01';
    #

    #DATOS PARA PHPMAIL
    $mailHost = 'acil.mx';
    $mailUser = 'info@acil.mx';
    $mailPass = 'AcilSeguridad01@';
    $mailSender = array('email' => 'info@acil.mx', 'name' => 'Notificaciones Intranet ACIL');
    #
    // INFORMACIÓN PARA PRODUCTIVO //*/
	
?>