<?php
session_start();
try {
	mkdir("../../DocumentosExpediente/".$_SESSION["idSucursal"], 0777);
} catch (Exception $e) {
	
}

$uploaddir = '../../DocumentosExpediente/'.$_SESSION["idSucursal"].'/';
$file = $_POST['value'];
$name = $_POST['name'];
$urlfile = $uploaddir . $name;
$urls = $_SESSION['URLFile'];
$urls = $urls.'**'. $uploaddir.$name;
$_SESSION['URLFile'] = $urls;
// obtener la extensión
$getMime = explode('.', $name);
$mime = end($getMime);

$data = explode(',', $file);

// Encode it correctly
$encodedData = str_replace(' ','+',$data[1]);
$decodedData = base64_decode($encodedData);

//Agregar fecha de subida a archivos sin fecha.
if (substr_count($name, '-')<2) {
	$name= $_SESSION["idSucursal"]. ".jpg";
	# code...
}
if(file_put_contents($uploaddir.$name, $decodedData)) {
	echo $name.":Subida exitosa";
}
else {
	// Show an error message should something go wrong.
	echo "Error";
}


?>
