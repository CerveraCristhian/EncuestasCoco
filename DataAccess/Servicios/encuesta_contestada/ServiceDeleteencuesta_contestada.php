<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$id_encuesta_contestada = $objDatos->id_encuesta_contestada;
$metas = MetaEC::Deleteencuesta_contestada($id_encuesta_contestada);
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
