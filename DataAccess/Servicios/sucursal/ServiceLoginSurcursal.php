<?php
header('Content-type: application/json');
require 'Servicios.php';
$objDatos = json_decode(file_get_contents("php://input"));
//print_r($objDatos);
$json_response = array();
if (isset($objDatos->email) && isset($objDatos->password)) {
	$isVendedor = Meta::VerifyUser($objDatos->email,$objDatos->password);
	if($isVendedor == 1){
		$result = Meta::getUser($objDatos->email,$objDatos->password);
		// Llenar los resultados para json
		$json_response['response'] = '1';
    $json_response['usuario'] = $result;
		//push the values in the array
		echo json_encode($json_response);
	}else{
		$json_response['response'] = '0';
		$json_response["error_msg"] = "Usuario o Password incorrecto. Por favor intenta de nuevo!";
		echo json_encode($json_response);
	}
}else{
	$json_response['response'] = '0';
	$json_response["error_msg"] = "Required parameters user or password is missing!";
	echo json_encode($json_response);
}

 ?>
