<?php

/**
 * Representa el la estructura de las metas
 * almacenadas en la base de datos.
 */
require_once '../../Database.php';

class Meta
{
    public function __construct()
    {
    }
    public static function Insertsucursal($id_empresa, $nombre, $direccion, $telefono, $contacto, $paquete, $email, $password)
    {
        $consulta = 'INSERT INTO sucursal(id_empresa, nombre, direccion, telefono, contacto, paquete, email,password) values (?, ?, ?, ?, ?, ?, ?,?)';
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id_empresa, $nombre, $direccion, $telefono, $contacto, $paquete, $email, $password));

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
        $consulta = 'SELECT a.*, b.nombre as nombreempresa FROM sucursal as a join empresa as b on (a.id_empresa = b.id_empresa)';
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
    public static function Updatesucursal($id_empresa, $nombre, $direccion, $telefono, $contacto, $paquete, $email, $id_sucursal, $password)
    {
        $consulta = 'UPDATE sucursal SET id_empresa=?, nombre=?, direccion=?, telefono=?, contacto=?, paquete=?, email=?, password =? where id_sucursal= ?';
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id_empresa, $nombre, $direccion, $telefono, $contacto, $paquete, $email, $password, $id_sucursal));
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
        $consulta = 'DELETE FROM sucursal where id_sucursal= ?';
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
        $consulta = 'SELECT * FROM sucursal where id_empresa =?';
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

    public static function VerifyUser($user,$pass){
       $consulta = 'SELECT * FROM sucursal where email =?';
       try {
           // Preparar sentencia
           $comando = Database::getInstance()->getDb()->prepare($consulta);
           // Ejecutar sentencia preparada
           $comando->execute(array($user));
           // Capturar primera fila del resultado
           $data = $comando->fetchAll(PDO::FETCH_ASSOC);
           //print_r( $data);
           if(empty($data)){
             return 0;
           }else{
             if(($data[0]['password'] != $pass )) {
                 return 0;
             }
             if($data[0]['password'] == $pass) {
                 session_start();
          			 $_SESSION['idSucursal'] = $data[0]["id_sucursal"];
                 $_SESSION['id_empresa'] = $data[0]["id_empresa"];
                 $_SESSION['nombre'] = $data[0]["nombre"];
                 $_SESSION['direccion'] = $data[0]["direccion"];
                 $_SESSION['telefono'] = $data[0]["telefono"];
                 $_SESSION['contacto'] = $data[0]["contacto"];
                 $_SESSION['paquete'] = $data[0]["paquete"];
                 $_SESSION['email'] = $data[0]["email"];
                 $_SESSION['password'] = $data[0]["password"];
                 return 1;
             }
           }

       } catch (PDOException $e) {
           // Aquí puedes clasificar el error dependiendo de la excepción
           // para presentarlo en la respuesta Json
           return -1;
       }
   }

   public static function getUser($user,$pass){
     $consulta = 'SELECT * FROM sucursal where email =?';
     try {
         // Preparar sentencia
         $comando = Database::getInstance()->getDb()->prepare($consulta);
         // Ejecutar sentencia preparada
         $comando->execute(array($user));
         // Capturar primera fila del resultado
         return $comando->fetchAll(PDO::FETCH_ASSOC);
     } catch (PDOException $e) {
         // Aquí puedes clasificar el error dependiendo de la excepción
         // para presentarlo en la respuesta Json
         return -1;
     }
   }
}
