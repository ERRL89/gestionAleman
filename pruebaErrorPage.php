<?php
$menu = 0;
$datatables = 0;
$pageTitle = "error";
$messageError = "La constraseña no es valida";
$rootError = 'login.php';//ruta ya definida con la carpeta area, solo sirve cuando menu es 1.
include_once('config/config.php');
    require $root . "templates/$theme/header.php";// template header page
    require $root . "templates/$theme/errorPage.php";// template error page
    require $root . "templates/$theme/footer.php";// template footer page
?>