<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$id_encuesta = $objDatos->id_encuesta;
$tipo_pregunta = $objDatos->tipo_pregunta;
$descripcion = $objDatos->descripcion;
$id_pregunta = $objDatos->id_pregunta;
$metas = Meta::Updatepregunta($id_encuesta, $tipo_pregunta, $descripcion, $id_pregunta);
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
