<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$id_cliente = $objDatos->id_cliente;
$metas = Meta::Deletecliente($id_cliente);
if ($metas) {

$datos["estado"] = 1;
$datos["cliente"] = $metas;

print json_encode($datos);
} else {
print json_encode(array(
"estado" => 2,
"mensaje" => "Ha ocurrido un error"
));
}


?>
