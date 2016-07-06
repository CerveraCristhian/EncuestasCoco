<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$nombre = $objDatos->nombre;
$id_empresa = $objDatos->id_empresa;
$metas = Meta::Updateempresa($nombre, $id_empresa);
if ($metas) {

$datos["estado"] = 1;
$datos["empresa"] = $metas;

print json_encode($datos);
} else {
print json_encode(array(
"estado" => 2,
"mensaje" => "Ha ocurrido un error"
));
}


?>
