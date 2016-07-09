<?php  
session_start();
header('Content-type: application/json');
require_once 'directoryservices.php';
$objDatos = json_decode(file_get_contents("php://input"));
$method = $objDatos->method;
switch ($method) {
    //Metodos de recompensas
    /**
    * selectrecompensas
    *
    * Parametros de entrada: Ninguno
    * Descripcion: Devuelve el total de las tuplas de la tabla recompensas
    * Devuelve : Lista de resultados de la consulta
    */
    case 'selectrecompensas':
    require $wsrecompensas;
    echo Serviciosrecompensas::selectrecompensas($objDatos);
    break;
    /**
    * insertrecompensas
    *
    * Parametros de entrada: $descripcion
    * Descripcion: Devuelve el total de las tuplas de la tabla recompensas
    * Devuelve : Devuelve estados de la consulta
    */
    case 'insertrecompensas':
    require $wsrecompensas;
    echo Serviciosrecompensas::insertrecompensas($objDatos);
    break;
    /**
    * deleterecompensas
    *
    * Parametros de entrada: $id_recompensa
    * Descripcion: Devuelve el total de las tuplas de la tabla recompensas
    * Devuelve : Devuelve estados de la consulta
    */
    case 'deleterecompensas':
    require $wsrecompensas;
    echo Serviciosrecompensas::deleterecompensas($objDatos);
    break;
    /**
    * updaterecompensas
    *
    * Parametros de entrada: $descripcion$id_recompensa
    * Descripcion: Actualiza la tabla recompensas
    * Devuelve : Devuelve estados de la consulta
    */
    case 'updaterecompensas':
    require $wsrecompensas;
    echo Serviciosrecompensas::updaterecompensas($objDatos);
    break;
    default:
    # code...
    break;
    }
    
    ?>
