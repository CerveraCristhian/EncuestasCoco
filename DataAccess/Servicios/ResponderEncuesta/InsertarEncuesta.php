<?php
$encuesta = array();
$today = getdate();
if (isset($_POST)) {
    echo '<pre>';
    print_r($_POST);
    $encuesta['id_cliente'] = '1';
    $encuesta['id_ecuesta'] = $_POST['idencuesta'];
    $encuesta['id_mesero'] = '1';
    $encuesta['codigo'] = 'Ajua';
    $encuesta['fecha'] = ''.date('Y/m/d').'';
    $encuesta['hora'] = $today['hours'].':'.$today['minutes'];
    $encuesta['estatus'] = '1';
    $encuesta['numero_orden'] = '12';
  //$aux2 = json_encode($encuesta);
    require_once '../encuesta_contestada/Servicios.php';
    $metas = Meta::Insertencuesta_contestada($encuesta['id_cliente'], $encuesta['id_ecuesta'], $encuesta['id_mesero'],
    $encuesta['codigo'],   $encuesta['fecha'],   $encuesta['hora'],   $encuesta['estatus'],   $encuesta['numero_orden']);
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
} else {
    echo 'no post';
}
echo '</pre>';
