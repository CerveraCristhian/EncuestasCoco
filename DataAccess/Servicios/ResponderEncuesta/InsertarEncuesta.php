<?php
session_start();
$encuesta = array();

if (isset($_POST)) {
    echo '<pre>';
    print_r($_POST);
    require_once '../cliente/Servicios.php';
    $cliente = Meta::SelectClienteByEmail($_POST['mail']);
    if($cliente){
      print_r($cliente);
      insertEncuestas($cliente);
    }else {
      $clienteNuevo = Meta::Insertcliente($_POST['mail'], 'BeewardsPass', 'nombre', 'apellido', 'apellido', '1990/12/12');
      if($clienteNuevo){
        insertEncuestasNew($clienteNuevo);
      }
    }


} else {
    echo 'no post';
}
function insertEncuestas($cl){
  $today = getdate();
  $encuesta['id_cliente'] = $cl[0]['id_cliente'];
  $encuesta['id_ecuesta'] = $_POST['idencuesta'];
  $encuesta['id_mesero'] = $_POST['meseroid'];
  $encuesta['codigo'] = $_POST['codigo'];
  $encuesta['fecha'] = ''.date('Y/m/d').'';
  $encuesta['hora'] = $today['hours'].':'.$today['minutes'];
  $encuesta['estatus'] = '1';
  $encuesta['numero_orden'] = '12';
//$aux2 = json_encode($encuesta);
  require_once '../encuesta_contestada/Servicios.php';
  $metas = MetaEC::Insertencuesta_contestada($encuesta['id_cliente'], $encuesta['id_ecuesta'], $encuesta['id_mesero'],
  $encuesta['codigo'],   $encuesta['fecha'],   $encuesta['hora'],   $encuesta['estatus'],   $encuesta['numero_orden'], $_POST['message']);
  if ($metas) {
      print_r('id -> '.$metas[0]['idlast']);
      foreach ($_POST['plolo'] as $clienterespuesta) {
          require_once '../respuestas_contestadascliente/Servicios.php';
          $metas2 = Meta2::Insertrespuestas_contestadascliente($clienterespuesta, $metas[0]['idlast']);
          if ($metas2) {
              echo $metas2;
          } else {
              echo json_encode(array(
              'estado' => 2,
              'mensaje' => 'Ha ocurrido un error inserta respuestas',
              ));
          }
      }
  } else {
      echo 'no post inserta encuesta';
  }
}

function insertEncuestasNew($cl){
  $today = getdate();
  $encuesta['id_cliente'] = $cl[0]['idlast'];
  $encuesta['id_ecuesta'] = $_POST['idencuesta'];
  $encuesta['id_mesero'] = $_POST['meseroid'];
  $encuesta['codigo'] = $_POST['codigo'];
  $encuesta['fecha'] = ''.date('Y/m/d').'';
  $encuesta['hora'] = $today['hours'].':'.$today['minutes'];
  $encuesta['estatus'] = '1';
  $encuesta['numero_orden'] = '12';
//$aux2 = json_encode($encuesta);
  require_once '../encuesta_contestada/Servicios.php';
  $metas = MetaEC::Insertencuesta_contestada($encuesta['id_cliente'], $encuesta['id_ecuesta'], $encuesta['id_mesero'],
  $encuesta['codigo'],   $encuesta['fecha'],   $encuesta['hora'],   $encuesta['estatus'],   $encuesta['numero_orden'], $_POST['message']);
  if ($metas) {
      print_r('id -> '.$metas[0]['idlast']);
      foreach ($_POST['plolo'] as $clienterespuesta) {
          require_once '../respuestas_contestadascliente/Servicios.php';
          $metas2 = Meta2::Insertrespuestas_contestadascliente($clienterespuesta, $metas[0]['idlast']);
          if ($metas2) {
              echo $metas2;
          } else {
              echo json_encode(array(
              'estado' => 2,
              'mensaje' => 'Ha ocurrido un error inserta respuestas',
              ));
          }
      }
  } else {
      echo 'no post inserta encuesta';
  }
}
echo '</pre>';
