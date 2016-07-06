<?php

/**
* Representa el la estructura de las metas
* almacenadas en la base de datos
*/
require_once '../../Database.php';

class Meta
{

function __construct()
{
}
public static function Insertencuesta($id_sucursal, $estatus, $fecha_activacion, $porcentaje, $fecha_finalizacion)
{
$consulta = "INSERT INTO encuesta(id_sucursal, estatus, fecha_activacion, porcentaje, fecha_finalizacion) values (?, ?, ?, ?, ?)";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_sucursal, $estatus, $fecha_activacion, $porcentaje, $fecha_finalizacion));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
public static function SelectAllencuesta()
{
$consulta = "SELECT a.*,b.nombre as sucursal FROM encuesta as a join sucursal as b on (a.id_sucursal=b.id_sucursal)";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute();
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
public static function Updateencuesta($id_sucursal, $estatus, $fecha_activacion, $porcentaje, $fecha_finalizacion,$id_encuesta)
{
$consulta = "UPDATE encuesta SET id_sucursal=?, estatus=?, fecha_activacion=?, porcentaje=?, fecha_finalizacion=? where id_encuesta= ?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_sucursal, $estatus, $fecha_activacion, $porcentaje, $fecha_finalizacion,$id_encuesta));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
public static function Deleteencuesta($id_encuesta)
{
$consulta = "DELETE FROM encuesta where id_encuesta= ?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_encuesta));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
}
