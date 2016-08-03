<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$id_cliente = $objDatos->id_cliente;
$id_ecuesta = $objDatos->id_ecuesta;
$id_mesero = $objDatos->id_mesero;
$codigo = $objDatos->codigo;
$fecha = $objDatos->fecha;
$hora = $objDatos->hora;
$estatus = $objDatos->estatus;
$numero_orden = $objDatos->numero_orden;
$id_encuesta_contestada = $objDatos->id_encuesta_contestada;
$metas = MetaEC::Updateencuesta_contestada($id_cliente, $id_ecuesta, $id_mesero, $codigo, $fecha, $hora, $estatus, $numero_orden, $id_encuesta_contestada);
if ($metas) {

$datos["estado"] = 1;
$datos["encuesta_contestada"] = $metas;

print json_encode($datos);
} else {
print json_encode(array(
"estado" => 2,
"mensaje" => "Ha ocurrido un error"
));
}


?>
