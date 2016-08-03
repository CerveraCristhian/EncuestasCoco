<?php
header('Content-type: application/json');
require 'Servicios.php';

class Serviciosrecompensas{

function __construct()
{	
}
public static function selectrecompensas($objDatos){
	
$metas = Meta::SelectAllrecompensas();
if ($metas) {

$datos["estado"] = 1;
$datos["recompensas"] = $metas;

print json_encode($datos);
} else {
print json_encode(array(
"estado" => 2,
"mensaje" => "Ha ocurrido un error"
));
}


}
public static function insertrecompensas($objDatos){
$descripcion = $objDatos->descripcion;
$metas = Meta::Insertrecompensas($descripcion);
if ($metas) {

$datos["estado"] = 1;
$datos["recompensas"] = $metas;

print json_encode($datos);
} else {
print json_encode(array(
"estado" => 2,
"mensaje" => "Ha ocurrido un error"
));
}


}
public static function updaterecompensas($objDatos){
$id_recompensa = $objDatos->id_recompensa;
$descripcion = $objDatos->descripcion;
$metas = Meta::Updaterecompensas($descripcion, $id_recompensa);
if ($metas) {

$datos["estado"] = 1;
$datos["recompensas"] = $metas;

print json_encode($datos);
} else {
print json_encode(array(
"estado" => 2,
"mensaje" => "Ha ocurrido un error"
));
}


}
public static function deleterecompensas($objDatos){
$id_recompensa = $objDatos->id_recompensa;
$metas = Meta::Deleterecompensas($id_recompensa);
if ($metas) {

$datos["estado"] = 1;
$datos["recompensas"] = $metas;

print json_encode($datos);
} else {
print json_encode(array(
"estado" => 2,
"mensaje" => "Ha ocurrido un error"
));
}


}
}
