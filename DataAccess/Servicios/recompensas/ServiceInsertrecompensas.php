<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$descripcion = $objDatos->descripcion;
$metas = Meta::Insertrecompensas($descripcion);
if ($metas) {

$datos["estado"] = 1;
$datos["recompensas"] = $metas;

print json_encode($datos);
} else {
print json_encode(array(
"estado" => 2,
"mensaje" => "Ha ocurrido un error"
));
}


?>
