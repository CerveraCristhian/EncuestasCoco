<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$id_pregunta = $objDatos->id_pregunta;
$descripcion = $objDatos->descripcion;
$id_respuesta = $objDatos->id_respuesta;
$tipo_respuesta = $objDatos->tipo_respuesta;
$metas = Meta::Updaterespuesta($id_pregunta, $descripcion, $id_respuesta);
if ($metas) {

$datos["estado"] = 1;
$datos["respuesta"] = $metas;

print json_encode($datos);
} else {
print json_encode(array(
"estado" => 2,
"mensaje" => "Ha ocurrido un error"
));
}


?>
