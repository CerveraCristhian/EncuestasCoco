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
public static function Insertsucursal($id_empresa, $nombre, $direccion, $telefono, $contacto, $paquete, $email, $password)
{
$consulta = "INSERT INTO sucursal(id_empresa, nombre, direccion, telefono, contacto, paquete, email,password) values (?, ?, ?, ?, ?, ?, ?,?)";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_empresa, $nombre, $direccion, $telefono, $contacto, $paquete, $email,$password));

// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return $e;
}
}
public static function SelectAllsucursal()
{
$consulta = "SELECT a.*, b.nombre as nombreempresa FROM sucursal as a join empresa as b on (a.id_empresa = b.id_empresa)";
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
public static function Updatesucursal($id_empresa, $nombre, $direccion, $telefono, $contacto, $paquete, $email,$id_sucursal,$password)
{
$consulta = "UPDATE sucursal SET id_empresa=?, nombre=?, direccion=?, telefono=?, contacto=?, paquete=?, email=?, password =? where id_sucursal= ?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_empresa, $nombre, $direccion, $telefono, $contacto, $paquete, $email,$password,$id_sucursal));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
public static function Deletesucursal($id_sucursal)
{
$consulta = "DELETE FROM sucursal where id_sucursal= ?";
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

public static function Selectsucursalbyempresa($id_empresa)
{
$consulta = "SELECT * FROM sucursal where id_empresa =?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_empresa));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}

}
