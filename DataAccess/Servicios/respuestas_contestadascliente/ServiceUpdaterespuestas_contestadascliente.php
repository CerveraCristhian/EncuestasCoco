<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$respuesta_contestadasclienterespuesta = $objDatos->respuesta_contestadasclienterespuesta;
$respuestas_contestadasclienteencuestaid = $objDatos->respuestas_contestadasclienteencuestaid;
$respuesta_contestadaclienteid = $objDatos->respuesta_contestadaclienteid;
$metas = Meta2::Updaterespuestas_contestadascliente($respuesta_contestadasclienterespuesta, $respuestas_contestadasclienteencuestaid, $respuesta_contestadaclienteid);
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
