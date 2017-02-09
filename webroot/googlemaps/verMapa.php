<?php
	require '../inc.config.php';
	
	$idEmpresa = $_GET['idEmpresa'];
	$sql = "SELECT * FROM EMPRESAS WHERE empresa_id=" . $idEmpresa . " LIMIT 1";
	$conn = new mysqli($serverName, $userName, $passWord, $dbName);
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {	
		while($row = $result->fetch_assoc()) {
			$lat = $row['lat'];
			$lon = $row['lon'];
			$nombreEmpresa = $row['name'];
		}
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
	  
	  #disabledMap{
		position: fixed;
		z-index: 10;
		width: 100%;
		height: 100%;  
		background: #292929;
		opacity: .5;
	  }
	  
	  #toolsMap{
		z-index: 20;
		position: fixed;
		top: 20px;
		right: 10px;   
	  }

	.btn {
	  background: #3498db;
	  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
	  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
	  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
	  background-image: -o-linear-gradient(top, #3498db, #2980b9);
	  background-image: linear-gradient(to bottom, #3498db, #2980b9);
	  -webkit-border-radius: 28;
	  -moz-border-radius: 28;
	  border-radius: 28px;
	  font-family: Arial;
	  color: #ffffff;
	  font-size: 20px;
	  padding: 10px 20px 10px 20px;
	  text-decoration: none;
	}
	
	.btn:hover {
	  background: #3cb0fd;
	  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
	  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
	  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
	  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
	  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
	  text-decoration: none;
	}
	  
    </style>
  </head>
  <body>
		<?
		if($lat!='' && $lon!=''){
		?>  
			<div id="toolsMap"><a class="btn" href="reposicionarMapa.php?idEmpresa=<? echo $idEmpresa; ?>">Reposicionar</a></div>
        <?
		}else{
		?>
   			<div id="disabledMap"></div>
            <div id="toolsMap"><a class="btn" href="reposicionarMapa.php?idEmpresa=<? echo $idEmpresa; ?>">Geolocalizar</a></div>       
        <?
		}
		?>
    
    <div id="map"></div>
    
    <script>
	
		<?
		if($lat!='' && $lon!=''){
		?>

		function initMap() {
		  var myLatLng = {lat: <? echo $lat; ?>, lng: <? echo $lon; ?>};
		
		  var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 16,
			center: myLatLng
		  });
		
		  var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			title: '<? echo $nombreEmpresa; ?>'
		  });
		}		
		 
		<?
		}else{
		?>

			var map;
			function initMap() {
			  map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: 28.122060, lng: -16.733821},
				zoom: 14
			  });
			}
			
		<?
		}
		?>
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<? echo $apiKeyGoogleMaps; ?>&callback=initMap" async defer></script>
  </body>
</html>