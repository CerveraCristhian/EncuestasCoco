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
public static function Insertpregunta($id_encuesta, $tipo_pregunta, $descripcion)
{
$consulta = "INSERT INTO pregunta(id_encuesta, tipo_pregunta, descripcion) values (?, ?, ?)";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_encuesta, $tipo_pregunta, $descripcion));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
public static function SelectAllpregunta($id_encuesta)
{
$consulta = "SELECT * FROM pregunta where id_encuesta =?";
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
public static function Updatepregunta($id_encuesta, $tipo_pregunta, $descripcion,$id_pregunta)
{
$consulta = "UPDATE pregunta SET id_encuesta=?, tipo_pregunta=?, descripcion=? where id_pregunta= ?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_encuesta, $tipo_pregunta, $descripcion,$id_pregunta));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return $e;
}
}
public static function Deletepregunta($id_pregunta)
{
$consulta = "DELETE FROM pregunta where id_pregunta= ?";
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

public static function SelectAllencuesta()
{
$consulta = "select b.*,b.descripcion as descripcionpregunta ,c.*, c.descripcion as descripcionrespuesta from encuesta as a join pregunta as b on a.id_encuesta = b.id_encuesta join respuesta as c on b.id_pregunta=c.id_pregunta where a.estatus = 1";
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
}
