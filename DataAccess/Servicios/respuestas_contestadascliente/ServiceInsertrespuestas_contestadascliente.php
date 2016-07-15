<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$respuesta_contestadasclienterespuesta = $objDatos->respuesta_contestadasclienterespuesta;
$respuestas_contestadasclienteencuestaid = $objDatos->respuestas_contestadasclienteencuestaid;
$metas = Meta2::Insertrespuestas_contestadascliente($respuesta_contestadasclienterespuesta, $respuestas_contestadasclienteencuestaid);
if ($metas) {

$datos["estado"] = 1;
$datos["respuestas_contestadascliente"] = $metas;

print json_encode($datos);
} else {
print json_encode(array(
"estado" => 2,
"mensaje" => "Ha ocurrido un error"
));
}


?>
