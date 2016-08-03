<?php
session_start();
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$nombre = $objDatos->nombre;
$id_sucursal = $_SESSION['idSucursal'];
$metas = Meta::Insertmesero($id_sucursal, $nombre);
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
