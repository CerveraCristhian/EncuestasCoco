<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$id_sucursal = $objDatos->id_sucursal;
$metas = MetaEncu::Reporte($id_sucursal);
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
