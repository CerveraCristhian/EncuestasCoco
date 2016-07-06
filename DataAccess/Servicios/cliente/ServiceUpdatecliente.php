<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$email = $objDatos->email;
$pass = $objDatos->pass;
$nombre = $objDatos->nombre;
$apellido_paterno = $objDatos->apellido_paterno;
$apellido_materno = $objDatos->apellido_materno;
$fecha_nacimiento = $objDatos->fecha_nacimiento;
$sucursalid = $objDatos->sucursalid;
$monedero = $objDatos->monedero;
$id_cliente = $objDatos->id_cliente;
$metas = Meta::Updatecliente($email, $pass, $nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $sucursalid, $monedero, $id_cliente);
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
