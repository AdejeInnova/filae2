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
	  
	#markPositionCruz{
		position: fixed;
		top: 50%;
		left: 50%;
		margin-top: -50px;
		margin-left: -50px;
		width: 100px;
		height: 200px;
		z-index: 20;	
	}
	
	
    </style>
  </head>
  <body>

    <div id="markPositionCruz">
        <img src="../img/markposition.png">
    </div>
  	 
    <div id="toolsMap">
      <form action="reposicionarMapaGuardar.php" method="POST" id="reposicionar">
    	<input type="hidden" id="lat" name="lat">
        <input type="hidden" id="lon" name="lon">
        <input type="hidden" id="idEmpresa" name="idEmpresa" value="<? echo $idEmpresa; ?>" >
    	<a class="btn" href="javascript:;" onclick="document.getElementById('reposicionar').submit(); return false;" >Guardar</a>
      </form>
    </div>
    
    <div id="map"></div>
    
    <script>
// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see the error "The Geolocation service
// failed.", it means you probably did not give permission for the browser to
// locate you.

<? if($lat!='' && $lon!=''){ ?>
	  document.getElementById("lat").value = <? echo $lat; ?>;
  	  document.getElementById("lon").value = <? echo $lon; ?>;
<? } else { ?>
	  document.getElementById("lat").value = '28.117087';
  	  document.getElementById("lon").value = '-16.738014';
<? } ?>

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    <? if($lat!='' && $lon!=''){ ?>
		center: {lat: <? echo $lat; ?>, lng: <? echo $lon; ?>},
	<? }else{ ?>
		center: {lat: 28.117087, lng: -16.738014},
	<? } ?>
    zoom: 18
  });
  
   <? if($lat!='' && $lon!=''){ ?>
   
   <? }else{ ?>
  
	  var infoWindow = new google.maps.InfoWindow({map: map});
	
	  // Try HTML5 geolocation.
	  if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
		  var pos = {
			lat: position.coords.latitude,
			lng: position.coords.longitude
		  };
	
		  infoWindow.setPosition(pos);
		  infoWindow.setContent('Geolocaliz. correcta.');
		  map.setCenter(pos);
		  document.getElementById("lat").value = pos.lat;
		  document.getElementById("lon").value = pos.lng;
		}, function() {
		  handleLocationError(true, infoWindow, map.getCenter());
		});
	  } else {
		// Browser doesn't support Geolocation
		handleLocationError(false, infoWindow, map.getCenter());
	  }
	  
   <? } ?>
  //var centro = map.getCenter();
  
  //alert(centro);
  
  //document.getElementById("lat").value = centro.lat();
  //document.getElementById("lon").value = centro.lng();

  map.addListener('drag', function() {
    var pos = map.getCenter();
	document.getElementById("lat").value = pos.lat();
  	document.getElementById("lon").value = pos.lng();	
  });

  map.addListener('dragend', function() {
    var pos = map.getCenter();
	document.getElementById("lat").value = pos.lat();
  	document.getElementById("lon").value = pos.lng();	
  });
  
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
                        'Error: La geolocalizac. no funciona.' :
                        'Error: Este navegador no soporta geolocalizac.');
}



    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<? echo $apiKeyGoogleMaps; ?>&signed_in=true&callback=initMap"
        async defer>
    </script>
  </body>
</html>