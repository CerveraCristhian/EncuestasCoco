<?php
$encuesta = array();
$today = getdate();
if (isset($_POST)) {
  $aux= json_encode($_POST);
  /*
  echo "<pre>";
  	print_r($aux);
  echo "</pre>";
  */
  $encuesta["id_cliente"] = "1";
  $encuesta["id_ecuesta"] = "1";
  $encuesta["id_mesero"] = "1;";
  $encuesta["codigo"] = "Ajua",
  $encuesta["fecha"] = "".date("Y/m/d")."";
  $encuesta["hora"] = $today["hours"].":".$today["minutes"];
  $encuesta["estatus"] = "1";
  $encuesta["numero_orden"] = "12";
} else {
  echo "<pre>";
    echo "no post";
  echo "</pre>";
}

?>
