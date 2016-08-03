<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
/**
* Representa el la estructura de las metas
* almacenadas en la base de datos
*/
define('DS',DIRECTORY_SEPARATOR);
require_once $_SERVER["DOCUMENT_ROOT"].'/'.'ServicesGenerator2/Encuestas/EncuestasCoco/DataAccess/Database.php';
class Meta
{

function __construct()
{
}
public static function Insertrecompensas($descripcion)
{
$id_sucursal = $_SESSION['idSucursal'];
$consulta = "INSERT INTO recompensas(descripcion,id_sucursal) values (?,?)";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($descripcion,$id_sucursal));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
public static function SelectAllrecompensas()
{
$id_sucursal = $_SESSION['idSucursal'];
$consulta = "SELECT * FROM recompensas where id_sucursal =?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_sucursal));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
public static function Updaterecompensas($descripcion,$id_recompensa)
{
$consulta = "UPDATE recompensas SET descripcion=? where id_recompensa= ?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($descripcion,$id_recompensa));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
public static function Deleterecompensas($id_recompensa)
{
$consulta = "DELETE FROM recompensas where id_recompensa= ?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_recompensa));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
}
