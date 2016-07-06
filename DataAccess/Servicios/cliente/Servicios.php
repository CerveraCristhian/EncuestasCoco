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
public static function Insertcliente($email, $pass, $nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $sucursalid, $monedero)
{
$consulta = "INSERT INTO cliente(email, pass, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, sucursalid, monedero) values (?, ?, ?, ?, ?, ?, ?, ?)";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($email, $pass, $nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $sucursalid, $monedero));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}


public static function LoginCliente($email, $pass)
{
$consulta = "select * from cliente where email = ? and pass = ?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($email, $pass));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}

public static function SelectAllcliente()
{
$consulta = "SELECT * FROM cliente";
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
public static function Updatecliente($email, $pass, $nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $sucursalid, $monedero,$id_cliente)
{
$consulta = "UPDATE cliente SET email=?, pass=?, nombre=?, apellido_paterno=?, apellido_materno=?, fecha_nacimiento=?, sucursalid=?, monedero=? where id_cliente= ?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($email, $pass, $nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $sucursalid, $monedero,$id_cliente));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
public static function Deletecliente($id_cliente)
{
$consulta = "DELETE FROM cliente where id_cliente= ?";
try {
// Preparar sentencia
$comando = Database::getInstance()->getDb()->prepare($consulta);
// Ejecutar sentencia preparada
$comando->execute(array($id_cliente));
// Capturar primera fila del resultado
return $comando->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
// Aquí puedes clasificar el error dependiendo de la excepción
// para presentarlo en la respuesta Json
return -1;
}
}
}
