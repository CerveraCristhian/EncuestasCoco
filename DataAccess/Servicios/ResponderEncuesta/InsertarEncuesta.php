<?php
session_start();
$encuesta = array();
require '../../../MailPDF/PHPMailerLib/PHPMailerAutoload.php';
$encuesta = null;
if (isset($_POST)) {
    echo '<pre>';
    //print_r($_POST);
    require_once '../cliente/Servicios.php';
    $cliente = Meta::SelectClienteByEmail($_POST['mail']);
    require_once '../encuesta/Servicios.php';
    $encuesta = MetaEncu::GetEncuestaByID($_POST['idencuesta']);
    //print_r($encuesta);
    if($cliente){
      //print_r($cliente);
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
      //print_r('id -> '.$metas[0]['idlast']);
      foreach ($_POST['plolo'] as $clienterespuesta) {
          require_once '../respuestas_contestadascliente/Servicios.php';
          $res = explode("$$",$clienterespuesta);
          if($res[1] == "2"){
            echo "se envia mail";
            $auxi = '
            <!DOCTYPE HTML>
            <html>
            <head>
              <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
              <title>Pregunta con mala calificacion</title>
            </head>
            <body>
            <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
              <h1>Hubo una pregunta contestada mal</h1>
              <p>Por favor cheque a la satisfaccion de sus comensales</p>
            </div>
            </body>
            </html>
            ';
            sendMail($auxi);
          }
          $metas2 = Meta2::Insertrespuestas_contestadascliente($res[0], $metas[0]['idlast']);
          if ($metas2) {
              //echo $metas2;
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
function sendMail($cuerpo){
  /**
   * This example shows settings to use when sending via Google's Gmail servers.
   */
  //SMTP needs accurate times, and the PHP time zone MUST be set
  //This should be done in your php.ini, but this is how to do it if you don't have access to that
  //date_default_timezone_set('Etc/UTC');

  //Create a new PHPMailer instance
  $mail = new PHPMailer;
  //Tell PHPMailer to use SMTP
  $mail->isSMTP();
  //Enable SMTP debugging
  // 0 = off (for production use)
  // 1 = client messages
  // 2 = client and server messages
  $mail->SMTPDebug = 0;
  //Ask for HTML-friendly debug output
  $mail->Debugoutput = 'html';
  //Set the hostname of the mail server
  $mail->Host = 'smtp.gmail.com';
  // use
  // $mail->Host = gethostbyname('smtp.gmail.com');
  // if your network does not support SMTP over IPv6
  //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
  $mail->Port = 587;
  //Set the encryption system to use - ssl (deprecated) or tls
  $mail->SMTPSecure = 'tls';
  //Whether to use SMTP authentication
  $mail->SMTPAuth = true;
  //Username to use for SMTP authentication - use full email address for gmail
  $mail->Username = "st.buendia@gmail.com";
  //Password to use for SMTP authentication
  $mail->Password = "topollono09";
  //Set who the message is to be sent from
  $mail->setFrom('st.buendia@gmail.com', 'First Last');
  //Set an alternative reply-to address
  $mail->addReplyTo('st.buendia@gmail.com', 'First Last');
  //Set who the message is to be sent to
  $mail->addAddress('st.buendia@gmail.com', 'Encargado');
  //Set the subject line
  $mail->Subject = 'PHPMailer GMail SMTP test';
  //Read an HTML message body from an external file, convert referenced images to embedded,
  //convert HTML into a basic plain-text alternative body
  //$mail->msgHTML(file_get_contents('PHPMailerLib/contents.html'), dirname(__FILE__));
  $mail->Body =$cuerpo;
  $mail->IsHTML(true);
  //Replace the plain text body with one created manually
  $mail->AltBody = 'This is a plain-text message body';
  //Attach an image file
  $mail->addAttachment('reporte.pdf');
  //send the message, check for errors
  if (!$mail->send()) {
    print json_encode(array(
    "estado" => 2,
    "mensaje" => "Ha ocurrido un error"
    ));
  } else {
    print json_encode(array(
    "estado" => 1,
    "mensaje" => "Se ha enviado el mail"
    ));
  }
}
