<?php
    include_once('../../config/config.php');
    include_once($root.'config/dbConf.php');

    //Variables para seleccion de tipo de formato de acuerdo al numero de partidas activas
    $partida1=0;
    $partida2=0;
    $partida3=0;

    //Variable de control de tipo de archivo a cargar de acuerdo al numero de partidas generadas en cotizador
    $filePDF=0;
    $verifyCot=0;

    //Ver cotizacion
    if(isset($_POST["verifyCot"])){ $verifyCot=$_POST["verifyCot"]; }

    //Recibe fecha
    if(isset($_POST["fecha"])){ $fecha=$_POST["fecha"]; }

    //Recibe información del cliente
    if(isset($_POST["nombre"]))  { $nombre=$_POST["nombre"];     }
    if(isset($_POST["telefono"])){ $telefono=$_POST["telefono"]; }
    if(isset($_POST["email"]))   { $email=$_POST["email"];       }

    //Recibe el numero de personas por partida
    if(isset($_POST["numPersona1"]))  { $numPersona1=$_POST["numPersona1"];     }
    if(isset($_POST["numPersona2"]))  { $numPersona2=$_POST["numPersona2"];     }
    if(isset($_POST["numPersona3"]))  { $numPersona3=$_POST["numPersona3"];     }

    //Recibe información de la primera partida de la cotización
    if(isset($_POST["typeService1"]) && isset($_POST["service1"]) && isset($_POST["cantidad1"]) && isset($_POST["costo1"]) && isset($_POST["total"])){
        $typeService1= $_POST["typeService1"];
        $service1=     $_POST["service1"];
        $cantidad1=    $_POST["cantidad1"];
        $costo1=       $_POST["costo1"];
        $total=        $_POST["total"];
        $partida1=1;
    }

    //Recibe información de la segunda partida de la cotización
    if(isset($_POST["typeService2"]) && isset($_POST["service2"]) && isset($_POST["cantidad2"]) && isset($_POST["costo2"])){
        $typeService2= $_POST["typeService2"];
        $service2=     $_POST["service2"];
        $cantidad2=    $_POST["cantidad2"];
        $costo2=       $_POST["costo2"];
        $partida2=1;
    }

    //Recibe información de la tercera partida de la cotización
    if(isset($_POST["typeService3"]) && isset($_POST["service3"]) && isset($_POST["cantidad3"]) && isset($_POST["costo3"])){
        $typeService3= $_POST["typeService3"];
        $service3=     $_POST["service3"];
        $cantidad3=    $_POST["cantidad3"];
        $costo3=       $_POST["costo3"];
        $partida3=1;
    }

    //GENERA ARCHIVO EN PDF DE COTIZACION 1 PARTIDA
    if($partida1==1 && $partida2==0 && $partida3==0){
        $filePDF=1;
    }  
    
    //GENERA ARCHIVO EN PDF DE COTIZACION 2 PARTIDA
    if($partida1==1 && $partida2==1 && $partida3==0){
        $filePDF=2;
    }  

    //GENERA ARCHIVO EN PDF DE COTIZACION 3 PARTIDA
    if($partida1==1 && $partida2==1 && $partida3==1){
        $filePDF=3;
    }

    //Genera cotizacion en formato PDF
    require($root.'resources/cotizadores/cotizadoc/generateCotPDF.php');

    //ENVIAR COMPROBANTE POR CORREO ELECTRONICO
    //require($root.'sendMailTDC.php');

    //MUESTRA MENSAJE DE ENVIO CORRECTO SOLO SI SE ENVIA POR GET PROCESS FORM
    if($verifyCot==0){
        $messageSuccess = "Cotización enviada correctamente";
        include_once($root."templates/acil/successPage.php"); 
    }
    
?>