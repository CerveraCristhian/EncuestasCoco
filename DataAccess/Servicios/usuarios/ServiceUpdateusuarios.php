<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
$usr_email = $objDatos->usr_email;
$usr_password = $objDatos->usr_password;
$usr_sucursal = $objDatos->usr_sucursal;
$usr_usuarioid = $objDatos->usr_usuarioid;
$metas = Meta::Updateusuarios($usr_email, $usr_password, $usr_sucursal, $usr_usuarioid);
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
