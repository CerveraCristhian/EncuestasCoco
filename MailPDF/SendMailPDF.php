<?php
header('Content-type: application/json');
$objDatos = json_decode(file_get_contents("php://input"));
//print_r($objDatos);
$encuestas = $objDatos->encuesta;
$email_enviar = null;
require('fpdf/diag.php');
$pdf = new PDF_Diag();
$pdf->AddPage();
//Pie chart
$pdf->SetFont('Arial', 'BIU', 16);
$pdf->Cell(0, 5, 'Reporte de Encuesta Sucursal Leon', 0, 1);
$pdf->Ln(8);
$lista = array();
$num = 0;
foreach ($encuestas as $clave => $valor) {
  $aux = array();
  $aux = null;
  $idpre = $valor->id_pregunta;
  $titu = $valor->descripcion;
  $email_enviar = $valor->emailenvio;
  if(in_array($idpre, $lista)){

  }else{
    array_push($lista, $idpre);
    foreach ($encuestas as $key => $value) {
      if($idpre == $value->id_pregunta){
        $aux[$value->Respuesta] = $value->Count;
      }
    }
    addChart($pdf,$aux, $titu);
  }
}
//$datin = array('Men' => 10, 'Women' => 40, 'Children' => 50);
function addChart($pdf,$data, $titulo){
  $pdf->SetFont('Arial', 'BIU', 12);
  $pdf->Cell(0, 5, $titulo, 0, 1);
  $pdf->Ln(8);
  $pdf->SetFont('Arial', '', 10);
  $valX = $pdf->GetX();
  $valY = $pdf->GetY();
  $arrayColors = array();
  foreach($data as $clave=>$valor){
    $pdf->Cell(30, 5, '# Respuestas de '.$clave.':');
    $pdf->Ln();
    $pdf->Cell(15, 5, $valor, 0, 0, 'R');
    $pdf->Ln();
    $col1=array(mt_rand(0, 255),mt_rand(0, 255),mt_rand(0, 255));
    array_push($arrayColors,$col1);
  }
  $pdf->Ln(8);
  $pdf->SetXY(90, $valY);
  $pdf->PieChart(100, 35, $data, '%l (%p)', $arrayColors);
  $pdf->SetXY($valX, $valY + 40);
}
$pdf->Output("reporte.pdf",'F');
//$pdf->Output();
sendMail($email_enviar);
//sendMail("st.buendia@gmail.com");
//echo $email_enviar;

function sendMail($emailSend){
  /**
   * This example shows settings to use when sending via Google's Gmail servers.
   */
  //SMTP needs accurate times, and the PHP time zone MUST be set
  //This should be done in your php.ini, but this is how to do it if you don't have access to that
  //date_default_timezone_set('Etc/UTC');
  require 'PHPMailerLib/PHPMailerAutoload.php';
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
  $mail->addAddress($emailSend, 'Encargado');
  //Set the subject line
  $mail->Subject = 'PHPMailer GMail SMTP test';
  //Read an HTML message body from an external file, convert referenced images to embedded,
  //convert HTML into a basic plain-text alternative body
  $mail->msgHTML(file_get_contents('PHPMailerLib/contents.html'), dirname(__FILE__));
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

?>
