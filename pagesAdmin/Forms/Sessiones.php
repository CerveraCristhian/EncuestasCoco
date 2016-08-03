<?php 
session_start();
$_SESSION['idSucursal'] = 2;
$_SESSION['Usuarioid'] =1;
header("Location: encuesta.php");
die();

 ?>