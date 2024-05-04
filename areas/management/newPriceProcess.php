<?php
header('Content-Type: application/json');

include_once('../../config/config.php');
include_once($root.'config/dbConf.php');
$db=conexionPdo();

if(isset($_POST["pt"])){
    $pt=$_POST["pt"];
}
//Recibe tipo de servicio por medio de AJAX
if (isset($_POST["typeService"]) && !isset($_POST["service"])) {
    $typeService = $_POST["typeService"];
    
    $consultaStr = "SELECT servicio, costo, num_personas FROM servicios WHERE tipo_servicio=?";
    $consulta = $db->prepare($consultaStr);
    $consulta->execute([$typeService]);
    
    $servicios = []; 
    
    while ($dataConsulta = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $servicio = [
            "nombre" => $dataConsulta['servicio'],
            "costo" => $dataConsulta['costo'],
            "numPersonas" => $dataConsulta['num_personas']
        ];
        array_push($servicios, $servicio);
    } 
    
    echo json_encode($servicios);
}

//Recibe tipo de servicio y servicio por medio de AJAX pra extraer costo y numero de personas
if (isset($_POST["typeService"]) && isset($_POST["service"])) {
    $typeService = $_POST["typeService"];
    $service = $_POST["service"];
        
    $consultaStr = "SELECT costo, num_personas FROM servicios WHERE tipo_servicio=? AND servicio=?";
    $consulta = $db->prepare($consultaStr);
    $consulta->execute([$typeService, $service]);

    $detalles = [];
    $dataConsulta=$consulta->fetch(PDO::FETCH_ASSOC);

    $detalle = [
        "costo" => $dataConsulta['costo'],
        "numPersonas" => $dataConsulta['num_personas']
    ];

    array_push($detalles, $detalle);
   
    echo json_encode($detalle);
}

?>