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
public static function Insertrespuestas_contestadascliente($respuesta_contestadasclienterespuesta, $respuestas_contestadasclienteencuestaid)
{
$consulta = "INSERT INTO respuestas_contestadascliente(respuesta_contestadasclienterespuesta, respuestas_contestadasclienteencuestaid) values (?, ?)";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($respuesta_contestadasclienterespuesta, $respuestas_contestadasclienteencuestaid));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
public static function SelectAllrespuestas_contestadascliente()
{
$consulta = "SELECT * FROM respuestas_contestadascliente";
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
public static function Updaterespuestas_contestadascliente($respuesta_contestadasclienterespuesta, $respuestas_contestadasclienteencuestaid,$respuesta_contestadaclienteid)
{
$consulta = "UPDATE respuestas_contestadascliente SET respuesta_contestadasclienterespuesta=?, respuestas_contestadasclienteencuestaid=? where respuesta_contestadaclienteid= ?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($respuesta_contestadasclienterespuesta, $respuestas_contestadasclienteencuestaid,$respuesta_contestadaclienteid));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
public static function Deleterespuestas_contestadascliente($respuesta_contestadaclienteid)
{
$consulta = "DELETE FROM respuestas_contestadascliente where respuesta_contestadaclienteid= ?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($respuesta_contestadaclienteid));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
}
