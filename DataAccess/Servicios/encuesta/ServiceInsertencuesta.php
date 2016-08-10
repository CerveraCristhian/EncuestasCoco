<?php
session_start();
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$id_sucursal = $_SESSION['idSucursal'];
$estatus = $objDatos->estatus;
$fecha_activacion = $objDatos->fecha_activacion;
$porcentaje = $objDatos->porcentaje;
$fecha_finalizacion = $objDatos->fecha_finalizacion;
$id_recompensa = $objDatos->id_recompensa;
$emailenvio = $objDatos->emailenvio;
$bienvenida = $objDatos->bienvenida;
$despedida = $objDatos->despedida;
$disculpa = $objDatos->disculpa;
$topemaximo = $objDatos->topemaximo;
$metas = MetaEncu::Insertencuesta($id_sucursal, $estatus, $fecha_activacion, $porcentaje, $fecha_finalizacion,$id_recompensa,$emailenvio, $bienvenida,$despedida,$disculpa,$topemaximo);
if ($metas) {

$datos["estado"] = 1;
$datos["encuesta"] = $metas;

print json_encode($datos);
} else {
print json_encode(array(
"estado" => 2,
"mensaje" => "Ha ocurrido un error"
));
}


?>
