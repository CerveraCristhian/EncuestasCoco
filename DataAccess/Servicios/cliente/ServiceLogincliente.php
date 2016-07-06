<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$email = $objDatos->email;
$pass = $objDatos->pass;
$metas = Meta::LoginCliente($email, $pass);
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
