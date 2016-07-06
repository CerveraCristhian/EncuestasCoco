<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$usr_email = $objDatos->usr_email;
$usr_password = $objDatos->usr_password;
$usr_sucursal = $objDatos->usr_sucursal;
$metas = Meta::Insertusuarios($usr_email, $usr_password, $usr_sucursal);
if ($metas) {

$datos["estado"] = 1;
$datos["usuarios"] = $metas;

print json_encode($datos);
} else {
print json_encode(array(
"estado" => 2,
"mensaje" => "Ha ocurrido un error"
));
}


?>
