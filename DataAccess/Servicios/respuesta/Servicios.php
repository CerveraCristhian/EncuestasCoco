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
public static function Insertrespuesta($id_pregunta, $descripcion,$tipo_respuesta)
{
$consulta = "INSERT INTO respuesta(id_pregunta, descripcion,tipo_respuesta) values (?, ?,?)";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_pregunta, $descripcion,$tipo_respuesta));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
public static function SelectAllrespuesta($id_pregunta)
{
$consulta = "SELECT * FROM respuesta where id_pregunta = ?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_pregunta));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
public static function Updaterespuesta($id_pregunta, $descripcion,$tipo_respuesta,$id_respuesta)
{
$consulta = "UPDATE respuesta SET id_pregunta=?, descripcion=?,tipo_respuesta=? where id_respuesta= ?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_pregunta, $descripcion,$tipo_respuesta,$id_respuesta));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
public static function Deleterespuesta($id_respuesta)
{
$consulta = "DELETE FROM respuesta where id_respuesta= ?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_respuesta));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
}
