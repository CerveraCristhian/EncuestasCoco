<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$id_sucursal = $objDatos->id_sucursal;
$nombre = $objDatos->nombre;
$id_mesero = $objDatos->id_mesero;
$metas = Meta::Updatemesero($id_sucursal, $nombre, $id_mesero);
if ($metas) {

$datos["estado"] = 1;
$datos["mesero"] = $metas;

print json_encode($datos);
} else {
print json_encode(array(
"estado" => 2,
"mensaje" => "Ha ocurrido un error"
));
}


?>
