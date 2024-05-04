<?php
    //IMPORTACIÓN DE RECURSOS
    include_once('../../config/config.php');
    include_once('../../config/dbConf.php');
    include_once($root.'areas/functions.php');
    $db = conexionPdo();

    //INICIALIZACIÓN DE VARIABLES DE SESIÓN NECESARIAS
    session_start();
    evaluateSession($_SESSION['partnerAreaId'], 1);
    $partnerId = $_SESSION['partnerId'];
    $partnerName = $_SESSION['partnerName'];
    $partnerAreaName = $_SESSION['partnerAreaName'];
    $partnerRoleName = $_SESSION['partnerRoleName'];
    $menuOptions = $_SESSION['partnerMenu'];
    $rootArea = $_SESSION['rootArea'];
    $partnerIdBranch = $_SESSION['partnerIdBranch'];
    $_SESSION['origen'] = basename($_SERVER['PHP_SELF']);

    //CONSULTA PARA EXTRAER DATOS ADICIONALES
    $queryPartner = $db->prepare(
        "SELECT colaboradores.ruta_foto, sucursales.nombre_sucursal
        FROM colaboradores
        JOIN sucursales ON colaboradores.sucursal = sucursales.id_sucursal  
        WHERE id_colaborador = ?"
    );
    $queryPartner->execute([$partnerId]);
    
    //ASIGNACIÓN DE VARIABLES ADICIONALES
    $dataPartner = $queryPartner->fetch(PDO::FETCH_ASSOC);
    $partnerPhotoName = $dataPartner['ruta_foto'];
    $partnerBranch = $dataPartner['nombre_sucursal'];

    //CONSTRUCCIÓN PÁGINA
    #VARIABLES PARA PÁGINA
    $menu = true; 
    $pageTitle = "Inicio - Aleman Maniobras y Logísticas Integrales"; 
    $titleMain = "Dashboard";
    
    #INICIO PÁGINA
    include $root."templates/$theme/header.php";
    include $root."templates/$theme/title.php";
    include $root."templates/$theme/dashboard.php";
    include $root."templates/$theme/footer.php";
    #FIN PÁGINA

    
?>