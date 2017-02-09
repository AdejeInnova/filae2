var app = angular.module('app', ['GeoAPI']);

app.controller('myCtrl', function($scope, $timeout, GeoAPI, $filter){

	//Guarda el valor de la búsqueda que se haga en el formulario search
	$scope.busqueda = {};

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
		if(!v){
			$scope.clean('comunidad');
			return;
		}
		if($.isEmptyObject(v)){
			return;
		}
		GeoAPI.provincias({
			"CCOM": v.CCOM
		}).then(function(data){
			$scope.provincias = data.data;
			if ($scope.comunidad.CCOM == "05"){
				$scope.provincia = $scope.provincias[1]; //Santa Cruz de Tenerife
			}
		});
	});

	$scope.$watch('provincia', function(v) {
		if(!v){
			$scope.clean('provincia');
			return;
		}
		if($.isEmptyObject(v)){
			$scope.provincias = [];
			return;
		}
		GeoAPI.municipios({
			"CPRO": v.CPRO
		}).then(function(data){
			$scope.munics = data.data;
			if ($scope.provincia.CPRO == "38"){
				$scope.munic = $scope.munics[0]; //Adeje

			}
		});
	});

	$scope.$watch('munic', function(v) {
		if(!v){
			$scope.clean('munic');

			return;
		}
		if($.isEmptyObject(v)){
			$scope.munics = [];
			return;
		}
		GeoAPI.poblaciones({
			"CPRO": v.CPRO,
			"CMUM": v.CMUM
		}).then(function(data){
			$scope.poblaciones = data.data;

		});
	});

	$scope.$watch('poblacion', function(v) {
		if(!v){
			$scope.clean('poblacion');
			return;
		}
		if($.isEmptyObject(v)){
			$scope.poblaciones = [];
			return;
		}

		GeoAPI.nucleos({
			"CPRO": v.CPRO,
			"CMUM": v.CMUM,
			"NENTSI50": v.NENTSI50
		}).then(function(data){
			$scope.nucleos = data.data;
			if(!$.isEmptyObject($scope.busqueda)){
				//Filtro en nucleos en función de la variable búsqueda
				$scope.nucleo = $filter('filter')($scope.nucleos, { CUN: $scope.busqueda.CUN })[0];
			}
		});
	});

	$scope.$watch('nucleo', function(v) {
		if(!v){
			$scope.clean('nucleo');
			return;
		}
		if($.isEmptyObject(v)){
			$scope.nucleos = [];
			return;
		}

		GeoAPI.cps({
			"CPRO": v.CPRO,
			"CMUM": v.CMUM,
			"CUN": v.CUN
		}).then(function(data){
			$scope.cps = data.data;
			if(!$.isEmptyObject($scope.busqueda)){
				//Filtro en cps en función de la variable búsqueda
				$scope.cp = $filter('filter')($scope.cps, { CPOS: $scope.busqueda.CPOS })[0];
			}
		});
	});

	$scope.$watch('cp', function(v) {
		if(!v){
			$scope.clean('cp');
			return;
		}
		if($.isEmptyObject(v)){
			$scope.cps = [];
			return;
		}

		GeoAPI.calles({
			"CPRO": v.CPRO,
			"CMUM": v.CMUM,
			"CUN": v.CUN,
			"CPOS": v.CPOS
		}).then(function(data){
			$scope.calles = data.data;
			if(!$.isEmptyObject($scope.busqueda)){
				//Filtro en nucleos en función de la variable búsqueda
				$scope.calle = $filter('filter')($scope.calles, { CVIA: $scope.busqueda.CVIA })[0];
				//Reseteo busqueda
				$scope.busqueda = {};
			}
		});
	});

	$scope.buscar_calles = function(){
		//Reinicio los resultados de la búsqueda
		$scope.res_qcalles = [];

		GeoAPI.qcalles({
			"QUERY": $scope.qcalles
		}).then(function(data){
			$scope.res_qcalles = data.data;
		});
	};

	//Function para filtrar segun valores seleccionados
	$scope.criteriaMatch = function() {
		return function( c ) {
			if ((!$scope.comunidad) || (!$scope.provincia) || (!$scope.munic)) return;

			if ((c.CCOM ===  $scope.comunidad.CCOM) && (c.CPRO ===  $scope.provincia.CPRO) && (c.CMUM ===  $scope.munic.CMUM)){
					return c;
			}else{
				return;
			}
		};
	};

	$scope.clean = function(opt){
		switch (opt){
			case 'comunidad':
				$scope.calle = {};
				$scope.cp = {};
				$scope.nucleo = {};
				$scope.poblacion = {};
				$scope.munic = {};
				$scope.provincia = {};
				break;
			case 'provincia':
				$scope.calle = {};
				$scope.cp = {};
				$scope.nucleo = {};
				$scope.poblacion = {};
				$scope.munic = {};
				break;
			case 'munic':
				$scope.calle = {};
				$scope.cp = {};
				$scope.nucleo = {};
				$scope.poblacion = {};
				break;
			case 'poblacion':
				$scope.calle = {};
				$scope.cp = {};
				$scope.nucleo = {};
				break;
			case 'nucleo':
				$scope.calle = {};
				$scope.cp = {};
				break;
			case 'cp':
				$scope.calle = {};
				break;
		}

	};


	//Seleción de uno de los registros encontrados
	$scope.selCalle = function(v){
		$scope.busqueda = v;

		//Recorro el scope de poblaciones para encontrar el NENTSI50 exacto de v.NENTSI50
		$.each($scope.poblaciones, function( index, obj ) {
			if (obj.NENTSI50 === v.NENTSI50){
				$scope.poblacion = obj;
			}
		});
	}


	// Handler para mostrar la ultima peticion y los ultimos datos recibidos
	/*$scope.$watch(GeoAPI.getLastQuery, function(v){
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
	});*/

});
