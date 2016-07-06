<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$id_pregunta = $objDatos->id_pregunta;
$metas = Meta::Deletepregunta($id_pregunta);
if ($metas) {

$datos["estado"] = 1;
$datos["pregunta"] = $metas;

print json_encode($datos);
} else {
print json_encode(array(
"estado" => 2,
"mensaje" => "Ha ocurrido un error"
));
}


?>
