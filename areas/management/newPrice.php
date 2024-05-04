<?php
    //SE INCLUYEN LAS LIBRERÍAS Y CLASES NECESARIAS
    include_once('../../config/config.php');
    include_once($root.'areas/functions.php');

    //INICIALIZACIÓN DE VARIABLES DE SESIÓN NECESARIAS
    session_start();
    evaluateSession($_SESSION['partnerAreaId'], 1); //Función que evalúa si existe una sesión activa
    $partnerId = $_SESSION['partnerId'];
    $partnerName = $_SESSION['partnerName'];
    $partnerAreaName = $_SESSION['partnerAreaName'];
    $partnerRoleName = $_SESSION['partnerRoleName'];
    $menuOptions = $_SESSION['partnerMenu'];
    $rootArea = $_SESSION['rootArea'];
    $partnerIdBranch = $_SESSION['partnerIdBranch'];
    $_SESSION['origen'] = basename($_SERVER['PHP_SELF']);

    //CONSTRUCCIÓN DE PÁGINA
    #VARIABLES DE PÁGINA
    $menu = true; 
    $pageTitle = "Listas de contratos (Productos) - ACIL México";
    $titleMain = "Cotizaciones > Crea Cotización";
    $levelAccess = 6;
    
    #INICIO PÁGINA
    include $root."templates/$theme/header.php";
    include $root."templates/$theme/title.php";
    include $root."templates/$theme/areas/managment/newPriceForm.php";
    include $root."templates/$theme/footer.php";
    #FIN PÁGINA
?>