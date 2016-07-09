<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$descripcion = $objDatos->descripcion;
$id_recompensa = $objDatos->id_recompensa;
$metas = Meta::Updaterecompensas($descripcion, $id_recompensa);
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
