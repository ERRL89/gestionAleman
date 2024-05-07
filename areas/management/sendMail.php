<?php
    //CREA ARRAY PARA RECIPIENTS
    $recipients = array();   
    $nombreUsuario1 = "Francisco Javier Manjarrez González";
    $emailUsuario1 =  "manjarrezgonzalez42@gmail.com";
   
    $dataUserMail1 = array("email" => "{$emailUsuario1}", "name" => "{$nombreUsuario1}");
    array_push($recipients, $dataUserMail1);
    #ENVIO DE CORREO
    //$recipients = array(array("email" => "{$emailDestino}", "name" => "{$nombreDestino}"));
    $mailSubject = "Cotización - ".$nombre;
    $mailPath = $root.'templates/acil/email/mail.php';
    $mailData = array(
        array("var_name" => "nombre", "var_val" => "{$nombre}")
    );
   
    $routeCot=$root."docs/cotizaciones/".$fecha."-".$nombre.".pdf";
    
    $attachments=array($routeCot);

    ##SE EJECUTA FUNCIÓN
    sendEmail($recipients, $mailSender, $mailSubject, $mailPath, $mailData, $mailHost, $mailUser, $mailPass, $attachments); 
?>