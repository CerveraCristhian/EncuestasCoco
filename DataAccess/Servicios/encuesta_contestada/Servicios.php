<?php

/**
* Representa el la estructura de las metas
* almacenadas en la base de datos
*/
require_once '../../Database.php';

class MetaEC
{

function __construct()
{
}
public static function Insertencuesta_contestada($id_cliente, $id_ecuesta, $id_mesero, $codigo, $fecha, $hora, $estatus, $numero_orden, $mensaje)
{
$consulta = "INSERT INTO encuesta_contestada(id_cliente, id_ecuesta, id_mesero, codigo, fecha, hora, estatus, numero_orden, mensaje) values (?, ?, ?, ?, ?, ?, ?, ?,?)";
$consulta2 = 'Select @@identity as idlast';
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_cliente, $id_ecuesta, $id_mesero, $codigo, $fecha, $hora, $estatus, $numero_orden, $mensaje));
// Capturar primera fila del resultado
//$last_id = Database::getInstance()->getDb()->lastInsertId();
$comando = Database::getInstance()->getDb()->prepare($consulta2);
$comando -> execute();
return $comando->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
public static function SelectAllencuesta_contestada()
{
$consulta = "SELECT * FROM encuesta_contestada";
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
public static function Updateencuesta_contestada($id_cliente, $id_ecuesta, $id_mesero, $codigo, $fecha, $hora, $estatus, $numero_orden,$id_encuesta_contestada)
{
$consulta = "UPDATE encuesta_contestada SET id_cliente=?, id_ecuesta=?, id_mesero=?, codigo=?, fecha=?, hora=?, estatus=?, numero_orden=? where id_encuesta_contestada= ?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_cliente, $id_ecuesta, $id_mesero, $codigo, $fecha, $hora, $estatus, $numero_orden,$id_encuesta_contestada));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
public static function Deleteencuesta_contestada($id_encuesta_contestada)
{
$consulta = "DELETE FROM encuesta_contestada where id_encuesta_contestada= ?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_encuesta_contestada));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
}
