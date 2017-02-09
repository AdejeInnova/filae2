<?php
	require '../inc.config.php';
	
	$idEmpresa = $_POST['idEmpresa'];
	$lat = $_POST['lat'];
	$lon = $_POST['lon'];
	
	$sql = "UPDATE EMPRESAS SET lat='$lat',lon='$lon' WHERE empresa_id=$idEmpresa LIMIT 1";
	
	$conn = new mysqli($serverName, $userName, $passWord, $dbName);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	if ($conn->query($sql) === TRUE) {
		
	} else {
		
	}
	
	header('Location: verMapa.php?idEmpresa=' . $idEmpresa );
	die();
?>