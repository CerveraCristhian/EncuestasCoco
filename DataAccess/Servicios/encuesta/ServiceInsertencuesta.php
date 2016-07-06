<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$id_sucursal = $objDatos->id_sucursal;
$estatus = $objDatos->estatus;
$fecha_activacion = $objDatos->fecha_activacion;
$porcentaje = $objDatos->porcentaje;
$fecha_finalizacion = $objDatos->fecha_finalizacion;
$metas = Meta::Insertencuesta($id_sucursal, $estatus, $fecha_activacion, $porcentaje, $fecha_finalizacion);
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
