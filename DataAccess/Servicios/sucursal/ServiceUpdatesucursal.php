<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$id_empresa = $objDatos->id_empresa;
$nombre = $objDatos->nombre;
$direccion = $objDatos->direccion;
$telefono = $objDatos->telefono;
$contacto = $objDatos->contacto;
$paquete = $objDatos->paquete;
$email = $objDatos->email;
$password = md5($objDatos->password);
$id_sucursal = $objDatos->id_sucursal;
$metas = Meta::Updatesucursal($id_empresa, $nombre, $direccion, $telefono, $contacto, $paquete, $email, $id_sucursal,$password);
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
