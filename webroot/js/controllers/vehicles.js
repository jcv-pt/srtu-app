'use strict';

/* Controllers */

// bootstrap controller
app.controller('addController', ['$scope', 'restHandler', function ($scope, restHandler) {

    $scope.add = function () {

	//Save request

	restHandler.process('post', '/vehicles/add.json', $scope.postData);

    }

}]);

app.controller('manageController', ['$scope', 'restHandler', function ($scope, restHandler) {

	//Datatable default setup

	$scope.dataTablesSetup = function () {

	    return restHandler.getDataTablesSetup('/vehicles/get/list.json');

	}

	$scope.delete = function (id) {

	    //Delete request

	    restHandler.process('get', '/vehicles/delete/do/' + id + '.json');

	}

}]);

app.controller('positionController', ['$scope','restHandler','$stateParams','$http', '$interval', '$timeout', function($scope, restHandler, $stateParams, $http, $interval, $timeout) {
    
    //Datatable init setup
    
    $scope.init = function(){
	
	//Get coordinates & build map
	
	$http.get('/vehicles/get/location/'+$stateParams.vehicleId+'.json').then(function(response) {

	    $scope.locationDetails = response.data.data.results;
	    
	    if(typeof $scope.locationDetails.id === 'undefined')
	    {
		alert('No location data yet!');
		return false;
	    }
	    
	    $http.get('/stops/get/path/'+$scope.locationDetails.route+'/'+$scope.locationDetails.direction+'.json').then(function(response) {

		$scope.pathCoordinates = response.data.data.results;
		$scope.routeColor = response.data.data.color;
		$scope.routeNumber = response.data.data.number;

		//Init map
		
		$scope.initMap();
		
		//Init vehicle tracking
		
		$scope.initTracking();

	    });
    
	});
	
	//Load vehicle info
	
	$http.get('/vehicles/get/info/'+$stateParams.vehicleId+'.json').then(function(response) {
	    
	    $scope.vehicleDetails = response.data.data.results;
	    
	});

	
    }
    
    $scope.mapOptions = {
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    $scope.initMap = function(){

	$scope.lat_lng = Array();

	var latlngbounds = new google.maps.LatLngBounds();

	for (var i = 0; i < $scope.pathCoordinates.length; i++) {
	//for (var i = 0; i < 4; i++) {

	    var data = {
		title: $scope.pathCoordinates[i][1],
		lat: $scope.pathCoordinates[i][2],
		lng: $scope.pathCoordinates[i][3],
		description: 'Marcador :' + $scope.pathCoordinates[i][1],

	    }

	    var curPoint = new google.maps.LatLng(data.lat, data.lng);
	    
	    $scope.lat_lng.push(curPoint);

	    var marker = new google.maps.Marker({
		position: curPoint,
		map: $scope.myMap,
		icon: 'http://cp.srtu.pt/img/marker_blue.png',
	    });
  
	    latlngbounds.extend(marker.position);
	    (function (marker, data) {
		
		var infowindow = new google.maps.InfoWindow({
		    content: '<strong>#'+(i+1)+'</strong> - '+data.title
		});
	    
		google.maps.event.addListener(marker, 'mouseover', function() {
		    infowindow.open($scope.myMap, marker);
		});

		google.maps.event.addListener(marker, 'mouseout', function() {
		    infowindow.close();
		});
		
	    })(marker, data);
	}
	
	$scope.myMap.setCenter(latlngbounds.getCenter());
	$scope.myMap.fitBounds(latlngbounds);

	$scope.runner = $interval($scope.markPoints, 2000);
	
	//Set view vars
	
	$scope.lineNumber = $stateParams.routeId;
	$scope.numberStops = $scope.pathCoordinates.length;

	
    }
    
    $scope.markPoints = function(){
	
	//Init scope point
	
	if(typeof $scope.curPoint === 'undefined')
	    $scope.curPoint = 0;
	
	//Init scope length
	
	if(typeof $scope.totalKms === 'undefined')
	    $scope.totalKms = 0;
	
	if(typeof $scope.estimatedTime === 'undefined')
	    $scope.estimatedTime = 0;
	
	//Intialize the Path Array
	var path = new google.maps.MVCArray();

	//Intialize the Direction Service
	var service = new google.maps.DirectionsService();

	//Set the Path Stroke Color
	var poly = new google.maps.Polyline({
	    map: $scope.myMap,
	    strokeColor: $scope.routeColor
	});

	var src = $scope.lat_lng[$scope.curPoint];
	var des = $scope.lat_lng[$scope.curPoint + 1];

	poly.setPath(path);
	service.route({
	    origin: src,
	    destination: des,
	    travelMode: google.maps.DirectionsTravelMode.DRIVING
	}, function (result, status) {
	    if (status == google.maps.DirectionsStatus.OK) {

		for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++)
		    path.push(result.routes[0].overview_path[i]);

		for (var i2 = 0; i2 < result.routes[0].legs.length; ++i2) {
		    $scope.totalKms = parseFloat(parseFloat($scope.totalKms) + (result.routes[0].legs[i2].distance.value/1000)).toFixed(2);
		    $scope.estimatedTime += Math.round((result.routes[0].legs[i2].duration.value+30)/60);
		}

	    }
	});

	if ($scope.curPoint + 1 < $scope.lat_lng.length - 1)
	    $scope.curPoint++;
	else
	    $interval.cancel($scope.runner);

    }
    
    $scope.initTracking = function(){
	
	//Init marker

	$scope.vehicleMarker = new google.maps.Marker({
	    position: new google.maps.LatLng($scope.locationDetails.lat, $scope.locationDetails.lon),
	    map: $scope.myMap,
	    zIndex:99999999,
	    icon: 'http://cp.srtu.pt/img/marker_vehicle.png',
	});
	
	//Run it
	
	$timeout($scope.trackingVehicle, 5000);
	
    }
        
    $scope.trackingVehicle = function(){
	
	$http.get('/vehicles/get/location/'+$stateParams.vehicleId+'.json').then(function(response) {
	    
	    $scope.locationDetails = response.data.data.results;
	    
	    //Update marker point
	    
	    $scope.moveVehicle();
	    
	});
	
    }
    
    $scope.moveVehicle = function(){
	
	var numDeltas = 100;
	
	$scope.vehicleCurPos = {
	    lat : $scope.vehicleMarker.position.lat(), 
	    lon : $scope.vehicleMarker.position.lng()
	}
	
	if($scope.vehicleNoDeltas == null)
	    $scope.vehicleNoDeltas = 0;

	if($scope.vehicleCurDelta == null)
	    $scope.vehicleCurDelta = {
		lat : ($scope.locationDetails.lat - $scope.vehicleCurPos.lat)/numDeltas, 
		lon : ($scope.locationDetails.lon - $scope.vehicleCurPos.lon)/numDeltas
	    }

	$scope.vehicleCurPos.lat += $scope.vehicleCurDelta.lat;
	$scope.vehicleCurPos.lon += $scope.vehicleCurDelta.lon;

	var latlng = new google.maps.LatLng($scope.vehicleCurPos.lat, $scope.vehicleCurPos.lon);
	
	$scope.vehicleMarker.setPosition(latlng);
	
	$scope.vehicleNoDeltas++;
	
	if($scope.vehicleNoDeltas>= numDeltas)
	{
	    //Request new location
	    
	    $scope.vehicleCurDelta = null;
	    $scope.vehicleNoDeltas = null;
	    
	    $timeout($scope.trackingVehicle, 3000);
	}
	else
	{
	    //Update next delta
	    
	    $timeout($scope.moveVehicle, 100);
	}
	
    }
    
  }]);