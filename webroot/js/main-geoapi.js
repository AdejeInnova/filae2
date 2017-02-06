var app = angular.module('app', ['GeoAPI']);

app.controller('myCtrl', function($scope, $timeout, GeoAPI){

	$scope.comunidades = [];
	$scope.provincias = [];
	$scope.municipios = [];
	$scope.poblaciones = [];
	$scope.nucleos= [];
	$scope.cps = [];
	$scope.calles = [];

	// Configurar GeoAPI
	GeoAPI.setConfig("key", "84ebd10c6201ad1935e0ff67794587927a69f0cf613e7675c7856772bdf17f14");
	GeoAPI.setConfig("type", "JSON");
	GeoAPI.setConfig("sandbox", 0);

	// Cargar las comunidades
	GeoAPI.comunidades({
		//
	}).then(function(data){
		$scope.comunidades = data.data;
		$scope.comunidad = $scope.comunidades[4]; //Canarias
	});

	// Handlers para cambios en los datos (cargamos mas datos
	// a medida que se van seleccionando opciones de los combos)

	$scope.$watch('comunidad', function(v) {
		if(!v) return;
		GeoAPI.provincias({
			"CCOM": v.CCOM
		}).then(function(data){

			$scope.municipio = $scope.municipios[-1];
			$scope.poblacion = $scope.poblaciones[-1];
			$scope.nucleo = $scope.nucleos[-1];
			$scope.cp = $scope.cps[-1];
			$scope.calle = $scope.calles[-1];

			$scope.municipios = [];
			$scope.poblaciones = [];
			$scope.nucleos= [];
			$scope.cps = [];
			$scope.calles = [];



			$scope.provincias = data.data;

			if ($scope.comunidad.CCOM == "05"){
				$scope.provincia = $scope.provincias[1]; //Santa Cruz de Tenerife
			}
		});

	});

	$scope.$watch('provincia', function(v) {
		if(!v) return;
		GeoAPI.municipios({
			"CPRO": v.CPRO
		}).then(function(data){
			$scope.municipios = data.data;
			if ($scope.provincia.CPRO == "38"){
				$scope.municipio = $scope.municipios[0]; //Adeje
			}
		});
	});

	$scope.$watch('municipio', function(v) {
		if(!v) return;

		GeoAPI.poblaciones({
			"CPRO": v.CPRO,
			"CMUM": v.CMUM
		}).then(function(data){
			$scope.poblaciones = data.data;

		});
	});

	$scope.$watch('poblacion', function(v) {
		if(!v) return;

		GeoAPI.nucleos({
			"CPRO": v.CPRO,
			"CMUM": v.CMUM,
			"NENTSI50": v.NENTSI50
		}).then(function(data){
			$scope.nucleos = data.data;

		});
	});

	$scope.$watch('nucleo', function(v) {
		if(!v) return;

		GeoAPI.cps({
			"CPRO": v.CPRO,
			"CMUM": v.CMUM,
			"CUN": v.CUN
		}).then(function(data){
			$scope.cps = data.data;
		});
	});

	$scope.$watch('cp', function(v) {
		if(!v) return;

		GeoAPI.calles({
			"CPRO": v.CPRO,
			"CMUM": v.CMUM,
			"CUN": v.CUN,
			"CPOS": v.CPOS
		}).then(function(data){
			$scope.calles = data.data;
		});
	});

	$scope.buscar_calles = function(){
		GeoAPI.qcalles({
			"QUERY": $scope.qcalles
		}).then(function(data){
			$scope.res_qcalles = data.data;
			console.log($scope.res_qcalles);
		});
	};

	// Handler para mostrar la ultima peticion y los ultimos datos recibidos

	$scope.$watch(GeoAPI.getLastQuery, function(v){
		if(v.url == ""){
			return;
		}

		var peticion = $('#peticion');
		var params = [];
		angular.forEach(v.params, function(v, k){
			params.push(encodeURI(k) + "=" + encodeURI(v));
		});
		var proto = window.location.protocol ? window.location.protocol : "http:";
		peticion.text("'" + proto + v.url + '?'+ params.join("&") + "'");

		//Highlight
		peticion.each(function(i, block){
			hljs.highlightBlock(block);
		});
	});

	$scope.$watch(GeoAPI.getLastResult, function(v){
		if(v.status == 0){
			return;
		}

		var respuesta = $('#respuesta');
		var datos = JSON.stringify(v.data, null, 8);
		respuesta.text(datos);

		//Highlight
		respuesta.each(function(i, block){
			hljs.highlightBlock(block);
		});
	});

});
