<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$id_empresa = $objDatos->id_empresa;
$metas = Meta::Selectsucursalbyempresa($id_empresa);
if ($metas) {

$datos["estado"] = 1;
$datos["sucursal"] = $metas;

print json_encode($datos);
} else {
print json_encode(array(
"estado" => 2,
"mensaje" => "Ha ocurrido un error"
));
}


?>
